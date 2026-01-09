<?php

include("../config/config.php");

$authorId = $_POST['user_id'];
$customerId = $_POST['customerId'];
$customerCardCode = $_POST['customerCardCode'];
$customerCardName = $_POST['customerCardName'];
$customerBranch = $_POST['customerBranch'];
$author = $_POST['author'];
$branchName = $_POST['branchName'];
$postingDate = (new DateTime($_POST['postingDate']))->format('Y-m-d H:i:s');
$createdDate = (new DateTime($_POST['createdDate']))->format('Y-m-d H:i:s');
$remarks = $_POST['remarks'];

try {

    $post = $conn->prepare("INSERT INTO posts (authorId, author, cust_id, cust_cardCode, cust_cardName, cust_branch, remarks, branch, post_date, created_date, modified) 
    VALUES (:authorId, :author, :cust_id, :cust_cardCode, :cust_cardName, :cust_branch, :remarks, :branch, :post_date, :created_date, SYSDATETIME())");
    $post->bindParam(":authorId", $authorId);
    $post->bindParam(":author", $author);
    $post->bindParam(":cust_id", $customerId);
    $post->bindParam(":cust_cardCode", $customerCardCode);
    $post->bindParam(":cust_cardName", $customerCardName);
    $post->bindParam(":cust_branch", $customerBranch);
    $post->bindParam(":remarks", $remarks);
    $post->bindParam(":branch", $branchName);
    $post->bindParam(":post_date", $postingDate);
    $post->bindParam(":created_date", $createdDate);
    $post->execute();

    echo "posted";
    exit();
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
}
