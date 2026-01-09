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
if (!isset($_SESSION['id'])) {
    if (basename($_SERVER['PHP_SELF']) !== 'index.php') {
        header("Location: index.php");
        exit();
    }
}

$user_id = isset($_SESSION['id']) ?? null;

try {
    $user = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $user->bindParam(":id", $user_id);
    $user->execute();

    $getUser = $user->fetchAll(PDO::FETCH_OBJ);

    if ($getUser) {
        foreach ($getUser as $row) {
            $user_id = $row->id;
            $name = $row->name;
            $branch = $row->branch;
            $isAdmin = $row->isAdmin;
            $dept = $row->dept;
            $profile = $row->profile;
            $firstLogin = $row->firstLogin;
            $reset = $row->reset;
            $disabled = $row->disabled;
        }
    }
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    session_write_close();

    include("../functions/logs.php");
    logs($conn, $deviceInfo, $name, "LOGGED OUT - " . $name);

    header('Location: ../index.php');
    exit();
}
