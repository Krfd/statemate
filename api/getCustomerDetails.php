<?php

include("../config/config.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cardCode = $_POST['cardcode'] ?? '';
    $cardName = $_POST['cardname'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $mdn = $_POST['mdn'] ?? '';

    try {
        $query = "SELECT id, cardCode, cardName, mdn, repo_status FROM customers";
        $conditions = [];
        $params = [];

        if ($cardCode !== '') {
            $conditions[] = "cardCode = :cardCode";
            $params[':cardCode'] = $cardCode;
        }

        if ($cardName !== '') {
            $conditions[] = "cardName = :cardName";
            $params[':cardName'] = $cardName;
        }

        if ($branch !== '') {
            $conditions[] = "branch = :branch";
            $params[':branch'] = $branch;
        }

        if ($mdn !== '') {
            $conditions[] = "mdn = :mdn";
            $params[':mdn'] = $mdn;
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        } else {
            echo json_encode([]);
            exit;
        }

        // Log the query and parameters for debugging
        file_put_contents("debug_sql.log", $query . "\n" . json_encode($params), FILE_APPEND);

        $stmt = $conn->prepare($query);
        $stmt->execute($params);

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        // Optional: Log the number of results returned
        file_put_contents("debug_sql.log", "\nRows returned: " . count($results) . "\n", FILE_APPEND);

        echo json_encode($results);
    } catch (PDOException $e) {
        $logMessage = "Error: " . $e->getMessage() . "\n";
        file_put_contents("debug_sql.log", $logMessage, FILE_APPEND); // Log to same file
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
