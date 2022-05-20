<?php

$servername = "localhost";
$username = "xkuflik";
$password = "xkuflikwebte2";
$dbname = "skuskove1";


try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
    ]);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT * FROM logy");
    $stmt->execute();


    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"export.csv\"");

    while ($row = $stmt->fetch()) {
        echo implode(",", [$row["id"], $row["log_time"], $row["log"], $row["log_err"]]);
        echo "\r\n";
    }
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;


