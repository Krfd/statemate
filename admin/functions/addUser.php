<?php

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

try {
    $conn = new PDO("sqlsrv:server=$servername;database=$db;TrustServerCertificate=true", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    die("Connection failed: " . $e->getMessage());
}

$dept = trim(htmlspecialchars($_POST['dept']));
$uname = trim(htmlspecialchars($_POST['uname']));
$branch  = trim(htmlspecialchars($_POST['branch']));

try {
    $ifExists = $conn->prepare("SELECT name FROM users WHERE name = :name AND dept = :dept AND branch = :branch");
    $ifExists->bindParam(":name", $uname);
    $ifExists->bindParam(":dept", $dept);
    $ifExists->bindParam(":branch", $branch);
    $ifExists->execute();

    $res = $ifExists->fetchAll(PDO::FETCH_OBJ);

    if (!$res) {
        $password = password_hash('Password', PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO users (isAdmin, branch, dept, name, profile, password, firstLogin, reset, disabled, created, modified, rememberToken, tokenExpiry)
        VALUES (0, :branch, :dept, :name, NULL, :password, 1, 1, 0, SYSDATETIME(), SYSDATETIME(), NULL, NULL)");
        $insert->bindParam(":branch", $branch);
        $insert->bindParam(":dept", $dept);
        $insert->bindParam(":name", $uname);
        $insert->bindParam(":password", $password);
        $insert->execute();

        if ($insert) {
            echo 'added';
            exit();
        } else {
            echo 'invalid';
            exit();
        }
    } else {
        echo "invalid";
        exit();
    }
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
}
