<?php

function errorHandler($errno, $errstr, $errfile, $errline)
{
    date_default_timezone_set('Asia/Manila');
    $logMessage = "[" . date("Y-m-d H:i:s") . "] Error: [$errno] $errstr in $errfile on line $errline" . PHP_EOL;
    file_put_contents('error_log.txt', $logMessage, FILE_APPEND);
}

set_error_handler("errorHandler");

// ORIGINAl
function sortByDocDate(&$array)
{
    usort($array, function ($a, $b) {
        // If DocDate exists, convert it to timestamp for comparison
        $dateA = isset($a->DocDate) ? strtotime($a->DocDate) : 0;
        $dateB = isset($b->DocDate) ? strtotime($b->DocDate) : 0;
        return $dateA <=> $dateB;
    });
}

function formatTransDates(&$array)
{
    foreach ($array as &$item) {
        if (isset($item->TransDate)) {
            $item->TransDate = str_replace('-', '/', $item->TransDate); // Replaces hyphens with slashes
        }

        if (isset($item->DocDate)) {
            $item->DocDate = formatDocDate($item->DocDate); // Format DocDate and replace hyphens with slashes
        }
    }
}

// Helper function to format DocDate to MM/DD/YYYY
function formatDocDate($docDate)
{
    // Replace hyphens with slashes
    $docDate = str_replace('-', '/', $docDate);

    // Check if the format is already MM/DD/YYYY
    $dateParts = explode('/', $docDate);
    if (count($dateParts) == 3 && strlen($dateParts[0]) == 2 && strlen($dateParts[1]) == 2 && strlen($dateParts[2]) == 4) {
        return $docDate; // Already in MM/DD/YYYY format
    }

    // If format is YYYY/MM/DD, change it to MM/DD/YYYY
    $dateParts = explode('/', $docDate);
    if (count($dateParts) == 3 && strlen($dateParts[0]) == 4 && strlen($dateParts[1]) == 2 && strlen($dateParts[2]) == 2) {
        return $dateParts[1] . '/' . $dateParts[2] . '/' . $dateParts[0]; // Convert to MM/DD/YYYY
    }

    return $docDate;
}

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

    try {
        $u_mdn = $_POST['u_mdn'] ?? null;
        $cardCode = $_POST['cardCode'] ?? null;
        $docEntry = $_POST['docEntry'] ?? null;

        // INVOICE 
        $inv = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER] @mCardName_ = '', @mCardCode_ = :cardCode, @mBranch_ = '', @mSalesInvoiceNo_ = :mdn";
        $inv = $conn->prepare($inv);
        $inv->bindValue(":cardCode", $cardCode);
        $inv->bindValue(":mdn", $u_mdn);
        $inv->execute();

        $invResult = $inv->fetchAll(PDO::FETCH_OBJ);
        foreach ($invResult as &$item) {
            $item->source = 'invoice'; // Add source field
        }
        formatTransDates($invResult);

        // DOWN PAYMENT
        $down = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_TransDR_ODPI] @mCardCode_ = :cardCode, @mU_MDN_ = :u_mdn";
        $dp = $conn->prepare($down);
        $dp->bindValue(":cardCode", $cardCode);
        $dp->bindValue(":u_mdn", $u_mdn);
        $dp->execute();

        $dpResult = $dp->fetchAll(PDO::FETCH_OBJ);
        foreach ($dpResult as &$item) {
            $item->source = 'down_payment'; // Add source field
        }
        formatTransDates($dpResult);

        // CREDIT
        $payment = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_TransCR_ORCT] @mCardCode_ = :cardCode, @mU_MDN_ = :u_mdn, @mDocEntry_ = :docentry";
        $payment = $conn->prepare($payment);
        $payment->bindValue(":cardCode", $cardCode);
        $payment->bindValue(":u_mdn", $u_mdn);
        $payment->bindValue(":docentry", $docEntry);
        $payment->execute();

        $paymentResult = $payment->fetchAll(PDO::FETCH_OBJ);
        foreach ($paymentResult as &$item) {
            $item->source = 'credit'; // Add source field
        }
        formatTransDates($paymentResult);

        // REVERSAL
        $reversal = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_TransCR_JE_Reversal] @mCardCode_ = :cardCode, @mU_MDN_ = :u_mdn";
        $reversal = $conn->prepare($reversal);
        $reversal->bindValue(":cardCode", $cardCode);
        $reversal->bindValue(":u_mdn", $u_mdn);
        $reversal->execute();

        $reversalResult = $reversal->fetchAll(PDO::FETCH_OBJ);
        foreach ($reversalResult as &$item) {
            $item->source = 'reversal'; // Add source field
        }
        formatTransDates($reversalResult);

        // PENALTY
        $penalty = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_TransDR_Penalty] @mCardCode_ = :cardCode, @mU_MDN_ = :u_mdn";
        $penalty = $conn->prepare($penalty);
        $penalty->bindValue(":cardCode", $cardCode);
        $penalty->bindValue(":u_mdn", $u_mdn);
        $penalty->execute();

        $penaltyResult = $penalty->fetchAll(PDO::FETCH_OBJ);
        foreach ($penaltyResult as &$item) {
            $item->source = 'penalty'; // Add source field
        }
        formatTransDates($penaltyResult);

        // DPM
        $dpm = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_TransCR_ORCT_DPM] @mCardCode_ = :cardCode, @mU_MDN_ = :u_mdn";
        $dpm = $conn->prepare($dpm);
        $dpm->bindValue(":cardCode", $cardCode);
        $dpm->bindValue(":u_mdn", $u_mdn);
        $dpm->execute();

        $dpmResult = $dpm->fetchAll(PDO::FETCH_OBJ);
        foreach ($dpmResult as &$item) {
            $item->source = 'dpm'; // Add source field
        }
        formatTransDates($dpmResult);

        // DEBIT
        $debit = "EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_TransDR_JE] @mCardCode_ = :cardCode, @mU_MDN_ = :u_mdn";
        $debit = $conn->prepare($debit);
        $debit->bindValue(":cardCode", $cardCode);
        $debit->bindValue(":u_mdn", $u_mdn);
        $debit->execute();

        $debitResult = $debit->fetchAll(PDO::FETCH_OBJ);
        foreach ($debitResult as &$item) {
            $item->source = 'debit'; // Add source field
        }
        formatTransDates($debitResult);

        // MERGE AND FINAL SORT + FORMAT
        $merged = array_merge(
            $invResult,
            $dpResult,
            $reversalResult,
            $penaltyResult,
            $debitResult,
            $dpmResult,
            $paymentResult
        );

        // Sort by DocDate after merging
        sortByDocDate($merged);

        // Return the merged data
        $response = [
            'inv' => $invResult,
            'dp' => $dpResult,
            'reversal' => $reversalResult,
            'penalty' => $penaltyResult,
            'debit' => $debitResult,
            'dpm' => $dpmResult,
            'credit' => $paymentResult,
            'merged' => $merged
        ];

        echo json_encode($response);
        exit();
    } catch (PDOException $e) {
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
