<?php

include("config/config.php");

if (isset($_POST['create'])) {

    try {

        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $hashed = password_hash("Password", PASSWORD_DEFAULT);

        $add = $conn->prepare("INSERT INTO users (isAdmin, dept, name, profile, password, firstLogin, reset, disabled, q1, q2, q3, created, modified) 
        VALUES (0, :dept, :name, '', :password, 1, 1, 0, '', '', '', NOW(), NULL)");
        $add->bindParam(":dept", $dept);
        $add->bindParam(":name", $name);
        $add->bindParam(":password", $hashed);
        // $add->execute();

        if ($add->execute()) {
            echo "Added";
            exit();
        } else {
            echo "Something went wrong";
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
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" required>
        <label for="dept">Department</label>
        <input type="text" name="dept" id="dept" required>
        <button type="submit" name="create">Create</button>
    </form>
</body>

</html>