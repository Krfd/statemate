<?php


include("../config/connection.php");


try {

    $password = password_hash("Password", PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (isAdmin, branch, dept, name, profile, password, firstLogin, reset, disabled, q1, q2, q3, created, modified) 
        VALUES (1, 'HEAD OFFICE', 'ADMINISTRATOR', 'Karlalooo', NULL, :password, 0, 0, 0, NULL, NULL,NULL, SYSDATETIME(), SYSDATETIME())");
    $insert->bindParam(":password", $password);
    if ($insert->execute()) {
        echo 'inserted';
        exit();
    } else {
        echo 'not inserted';
        exit();
    }
} catch (PDOException $e) {
    errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
}
