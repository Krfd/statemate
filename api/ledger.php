<?php

include("../config/connection.php");

$docEntry = $_POST['docEntry'] ?? null;

if ($docEntry) {
    try {
        $stmt = $conn->prepare("EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_Ledger] @mDocEntry_ = :docEntry");
        $stmt->bindParam(":docEntry", $docEntry);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($res as $row) {

            echo '<tr>
            <td>' . $row->InstlmntID . '</td>
            <td>' . $row->DueDate . '</td>
            <td>' . number_format($row->InsTotal, 2) . '</td>
            <td>' . number_format($row->PaidToDate, 2) . '</td>
            <td>' . $row->mDays . '</td>
            </tr>';
        }
    } catch (PDOException $e) {
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
