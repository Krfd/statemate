<?php

session_start();

function errorHandler($errno, $errstr, $errfile, $errline)
{
    date_default_timezone_set('Asia/Manila');
    $logMessage = "[" . date("Y-m-d H:i:s") . "] Error: [$errno] $errstr in $errfile on line $errline" . PHP_EOL;
    file_put_contents('error_log.txt', $logMessage, FILE_APPEND);
}

set_error_handler("errorHandler");

$servername = "192.168.101.68";
$db = "SOA";
$username = "sa";
$password = "SB1Admin";

include("logs.php");

$ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
$hostname = gethostbyaddr($ip) ?: 'UNKNOWN';
$deviceInfo = $hostname;

try {
    $conn = new PDO("sqlsrv:server=$servername;database=$db;TrustServerCertificate=true", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    die("Connection failed: " . $e->getMessage());
}

if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['loginKey']) || !isset($_POST['loginToken'])) {
    header("Location: ./index.php");
    exit();
}

$name = htmlspecialchars($_POST['username']);
$pass = htmlspecialchars($_POST['password']);
$remember = isset($_POST['remember']);
$loginKey = htmlspecialchars($_POST['loginKey']);
$loginToken = hash_hmac('sha256', 'For login', $loginKey);

function keepMe($conn, $token, $expiry, $userId)
{
    $keepMe = $conn->prepare("UPDATE users SET rememberToken = ?, tokenExpiry = ? WHERE id = ?");
    $keepMe->execute([$token, $expiry, $userId]);

    setcookie('rememberToken', $token, [
        'expires' => time() + (86400 * 30),
        'path' => "/",
        'httponly' => true,
        'secure' => true,
        'samesite' => 'Strict'
    ]);
}

try {
    $query = $conn->prepare("SELECT id, isAdmin, name, password, disabled FROM users WHERE name = :name");
    $query->bindParam(":name", $name);
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_OBJ);

    if ($rows) {
        foreach ($rows as $row) {
            if (hash_equals($loginToken, $_POST['loginToken'])) {
                if (password_verify($pass, $row->password)) {
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        $expiry = date('Y-m-d H:i:s', time() + (86400 * 30));
                        keepMe($conn, $token, $expiry, $row->id);
                    }

                    if ($row->disabled == 1) {
                        echo "banned";
                        exit();
                    } else {
                        if ($row->isAdmin == 1 && $row->name == $name) {
                            $_SESSION['id'] = $row->id;
                            echo "admin";
                            logs($conn, $deviceInfo, $name, "LOGGED IN - " . $name);
                            exit();
                        } elseif ($row->isAdmin && $row->name != $name) {
                            echo "invalid";
                            exit();
                        } else {
                            if ($row->isAdmin == 0 && $row->name == $name) {
                                $_SESSION['id'] = $row->id;
                                echo "user";
                                logs($conn, $deviceInfo, $name, "LOGGED IN - " . $name);
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
