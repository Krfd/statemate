<?php

include("../config/connection.php");

header('Content-Type: application/json');

$docEntry = $_POST['docEntry'] ?? null;

if ($docEntry) {
    try {
        $stmt = $conn->prepare("EXEC [IAP_SOA].[dbo].[SEARCH_CUSTOMER_Ledger] @mDocEntry_ = :docEntry");
        $stmt->bindParam(":docEntry", $docEntry);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        $upTo30 = 0;
        $upTo30Balance =  0;

        $upTo60 = 0;
        $upTo60Balance = 0;

        $upTo90 = 0;
        $upTo90Balance = 0;

        $over360 = 0;
        $over360Balance = 0;

        $totalArrears = 0;

        $totalPenalty = 0;

        $balance = 0;

        $overallTotal = 0;
        $overallPaid = 0;

        foreach ($res as $row) {
            $paid = floatval($row->PaidToDate);
            $total = floatval($row->InsTotal);
            $days = intval($row->mDays);

            // 30 DAYS
            if ($days <= 30 && $days != 0) {
                if ($paid == 0 || $paid == 0.00) {
                    $upTo30 += $total;
                } else {
                    if ($paid > 0 && $paid < $total) {
                        $upTo30Balance = $upTo30 + ($total - $paid);
                    }
                }
            }

            // 60 DAYS
            if ($days <= 60 && $days >= 31) {
                if ($paid == 0 || $paid == 0.00) {
                    $upTo60 += $total;
                } else {
                    if ($paid > 0 && $paid < $total) {
                        $upTo60Balance = $upTo60 + ($total - $paid);
                    }
                }
            }

            // 90 DAYS
            if ($days <= 90 && $days >= 61) {
                if ($paid == 0 || $paid == 0.00) {
                    $upTo90 += $total;
                } else {
                    if ($paid > 0 && $paid < $total) {
                        $upTo90Balance = $upTo90 + ($total - $paid);
                    }
                }
            }

            // > 360 DAYS
            if ($days >= 360) {
                if ($paid == 0 || $paid == 0.00) {
                    $over360 += $total;
                } else {
                    if ($paid > 0 && $paid < $total) {
                        $over360Balance = $over360 + ($total - $paid);
                    }
                }
            }

            $overallTotal += $total;
            $overallPaid += $paid;
        }

        $upTo30 = $upTo30 + $upTo30Balance;
        $upTo60 = $upTo60 + $upTo60Balance;
        $upTo90 = $upTo90 + $upTo90Balance;
        $over360 = $over360 + $over360Balance;

        $totalArrears = $upTo30 + $upTo60 + $upTo90 + $over360;
        $balance = $overallTotal - $overallPaid;

        echo json_encode([
            'upTo30' => $upTo30,
            'upTo60' => $upTo60,
            'upTo90' => $upTo90,
            'over360' => $over360,
            'totalArrears' => $totalArrears,
            'balance' => $balance,
            'total' => $overallTotal,
            'overallPaid' => $overallPaid
        ]);
    } catch (PDOException $e) {
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
