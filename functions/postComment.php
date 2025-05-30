<?php


include("../config/config.php");

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

    $post = $conn->prepare("INSERT INTO posts (customerId, customerCardCode, customerCardName, customerBranch, author, remarks, branch, postingDate, createdDate) 
    VALUES (:customerId, :customerCardCode, :customerCardName, :customerBranch, :author, :remarks, :branch, :postingDate, :createdDate)");
    $post->bindParam(":customerId", $customerId);
    $post->bindParam(":customerCardCode", $customerCardCode);
    $post->bindParam(":customerCardName", $customerCardName);
    $post->bindParam(":customerBranch", $customerBranch);
    $post->bindParam(":author", $author);
    $post->bindParam(":remarks", $remarks);
    $post->bindParam(":branch", $branchName);
    $post->bindParam(":postingDate", $postingDate);
    $post->bindParam(":createdDate", $createdDate);
    $post->execute();

    echo "posted";
    exit();
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
}
