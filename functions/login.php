<?php
session_start();
// include("./config/config.php");

function errorHandler($errno, $errstr, $errfile, $errline)
{
    date_default_timezone_set('Asia/Manila');
    $logMessage = "[" . date("Y-m-d H:i:s") . "] Error: [$errno] $errstr in $errfile on line $errline" . PHP_EOL;
    file_put_contents('error_log.txt', $logMessage, FILE_APPEND);
}

set_error_handler("errorHandler");

$db = "mysql:host=localhost;dbname=statemate";
$username = "root";
$password = "";

try {
    $conn = new PDO($db, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    die("Connection failed: " . $e->getMessage());
}


if (!isset($_POST['dept']) || !isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['loginKey']) || !isset($_POST['loginToken'])) {
    header("Location: index.php");
    exit();
}

$dept = htmlspecialchars($_POST['dept']);
$name = htmlspecialchars($_POST['username']);
$pass = htmlspecialchars($_POST['password']);
$loginKey = htmlspecialchars($_POST['loginKey']);
$loginToken = hash_hmac('sha256', 'For login', $loginKey);

try {

    $query = $conn->prepare("SELECT id, isAdmin, name, password, disabled FROM users WHERE name = :name");
    $query->bindParam(":name", $name);
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_OBJ);

    if ($rows) {
        foreach ($rows as $row) {
            if (hash_equals($loginToken, $_POST['loginToken'])) {
                if (password_verify($pass, $row->password)) {
                    if ($row->disabled == 1) {
                        echo "banned";
                        exit();
                    } else {
                        if ($row->isAdmin == 1 && $row->name == $name) {
                            $_SESSION['id'] = $row->id;
                            echo "admin";
                            exit();
                        } elseif ($row->isAdmin && $row->name != $name) {
                            echo "invalid";
                            exit();
                        } else {
                            if ($row->isAdmin == 0 && $row->name == $name) {
                                $_SESSION['id'] = $row->id;
                                echo "user";
                                exit();
                            } else {
                                echo "invalid";
                                exit();
                            }
                        }
                    }
                } else {
                    echo "invalid";
                    exit();
                }
            } else {
                echo "invalidcsrf";
                exit();
            }
        }
    } else {
        echo "unknown";
        exit();
    }
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    echo $e->getMessage();
    exit();
}
