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

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cardCode = $_POST['cardcode'] ?? '';
    $cardName = $_POST['cardname'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $mdn = $_POST['mdn'] ?? '';

    try {
        $query = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER] 
                    @mCardCode_ = :cardCode, 
                    @mCardName_ = :cardName, 
                    @mBranch_ = :branch, 
                    @mSalesInvoiceNo_ = :mdn";

        $stmt = $conn->prepare($query);

        $stmt->bindValue(':cardCode', $cardCode ?: '', PDO::PARAM_STR);
        $stmt->bindValue(':cardName', $cardName ?: '', PDO::PARAM_STR);
        $stmt->bindValue(':branch', $branch ?: '', PDO::PARAM_STR);
        $stmt->bindValue(':mdn', $mdn ?: '', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($results);
    } catch (PDOException $e) {
        $logMessage = "Error: " . $e->getMessage() . "\n";
        file_put_contents("debug_sql.log", $logMessage, FILE_APPEND); // Log to same file
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
