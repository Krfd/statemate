<?php

include("config/config.php");

if (isset($_POST['addCustomer'])) {
    try {

        $card_code = $_POST['card_code'];
        $card_name = $_POST['card_name'];
        $mdn = $_POST['mdn'];
        $customer = $_POST['customer'];
        $address = $_POST['address'];
        $inv = $_POST['inv'];
        $branch = $_POST['branch'];
        $ddate = $_POST['ddate'];
        $dp = $_POST['dp'];
        $terms = $_POST['terms'];
        $mi = $_POST['mi'];
        $repo_status = $_POST['repo_status'];
        $uds = $_POST['uds'];
        $uds_no = $_POST['uds_no'];
        $rdate = $_POST['rdate'];
        $area = $_POST['area'];
        $mbranch = $_POST['mbranch'];


        $addCustomer = $conn->prepare("INSERT INTO customers (cardCode, cardName, mdn, customer, address, inv_num, branch, deliveryDate, down, terms, installment, repo_status, uds_date, uds_no, redeem_date, area, mainBranch, created, modified) 
        VALUES (:cardCode, :cardName, :mdn, :customer, :address, :inv_num, :branch, NULL, :down, :terms, :installment, :repo_status, NULL, :uds_no, NULL, :area, :mainBranch, NOW(), NULL)");
        $addCustomer->bindParam(":cardCode", $card_code);
        $addCustomer->bindParam(":cardName", $card_name);
        $addCustomer->bindParam(":mdn", $mdn);
        $addCustomer->bindParam(":customer", $customer);
        $addCustomer->bindParam(":address", $address);
        $addCustomer->bindParam(":inv_num", $inv);
        $addCustomer->bindParam(":branch", $branch);
        $addCustomer->bindParam(":down", $dp);
        $addCustomer->bindParam(":terms", $terms);
        $addCustomer->bindParam(":installment", $mi);
        $addCustomer->bindParam(":repo_status", $repo_status);
        $addCustomer->bindParam(":uds_no", $uds_no);
        $addCustomer->bindParam(":area", $area);
        $addCustomer->bindParam(":mainBranch", $mbranch);

        if ($addCustomer->execute()) {
            echo 'Added';
            exit();
        } else {
            echo 'Something went wrong';
            exit();
        }
    } catch (PDOException $e) {
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <label for="card_code">Card Code:</label>
        <input type="text" name="card_code" id="card_code" required>
        <br>
        <br>
        <label for="card_name">Card Name:</label>
        <input type="text" name="card_name" id="card_name" required>
        <br>
        <br>
        <label for="mdn">MDN/SI #:</label>
        <input type="text" name="mdn" id="mdn" required>
        <br>
        <br>
        <label for="customer">Customer:</label>
        <input type="text" name="customer" id="customer" required>
        <br>
        <br>
        <label for="add">Address:</label>
        <input type="text" name="address" id="add" required>
        <br><br>
        <label for="inv">Manual Inv #:</label>
        <input type="text" name="inv" id="inv" required>
        <br>
        <br>
        <label for="branch">Branch:</label>
        <input type="text" name="branch" id="branch" required>
        <br>
        <br>
        <label for="ddate">Delivery Date:</label>
        <input type="date" name="ddate" id="ddate" required>
        <br>
        <br>
        <label for="dp">Down Payment:</label>
        <input type="text" name="dp" id="dp" required>
        <br>
        <br>
        <label for="terms">Terms:</label>
        <input type="text" name="terms" id="terms" required>
        <br>
        <br>
        <label for="mi">Monthly Installment:</label>
        <input type="text" name="mi" id="mi" required>
        <br>
        <br>
        <label for="repo_status">Repo Status:</label>
        <input type="text" name="repo_status" id="repo_status" required>
        <br>
        <br>
        <label for="uds">UDS Date:</label>
        <input type="date" name="uds" id="uds" required>
        <br>
        <br>
        <label for="uds_no">UDS No:</label>
        <input type="text" name="uds_no" id="uds_no" required>
        <br>
        <br>
        <label for="r_date">Redeem Date:</label>
        <input type="date" name="rdate" id="rdate" required>
        <br>
        <br>
        <label for="area">Area:</label>
        <input type="text" name="area" id="area" required>
        <br>
        <br>
        <label for="mbranch">Main Branch:</label>
        <input type="text" name="mbranch" id="mbranch" required>
        <br>
        <br>
        <button type="submit" name="addCustomer">Add</button>
    </form>
</body>

</html>