<?php

include("../config/config.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_POST['id'] ?? '';

    try {
        // Start the query
        $query = "SELECT id, cardCode, cardName, customer, mdn, repo_status, address, inv_num, deliveryDate, terms, 
                         uds_no, branch, down, installment, uds_date, redeem_date, area, mainBranch 
                  FROM customers WHERE id = :id";

        // Prepare and execute the query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (empty($results)) {
            echo json_encode([]);
        } else {
            echo json_encode($results);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "An error occurred while fetching data"]);
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
