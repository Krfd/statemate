<?php

function logs($conn, $pcName, $author, $action)
{
    try {
        date_default_timezone_set('Asia/Manila');

        $transDate = date('Y-m-d');
        $timestrt = date('H:i:s');
        $software = "STATEMATE";

        $log = $conn->prepare("INSERT INTO logs (PcName, TransDate, TimeStrt, Software, UserName, Action) 
            VALUES(:PcName, :TransDate, :TimeStrt, :Software, :UserName, :Action)");
        $log->bindParam(":PcName", $pcName);
        $log->bindParam(":TransDate", $transDate);
        $log->bindParam(":TimeStrt", $timestrt);
        $log->bindParam(":Software", $software);
        $log->bindParam(":UserName", $author);
        $log->bindParam(":Action", $action);
        $log->execute();
    } catch (PDOException $e) {
        errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
        echo "PDO ERROR: " . $e->getMessage(); // TEMP for debugging
        exit();
    }
}
