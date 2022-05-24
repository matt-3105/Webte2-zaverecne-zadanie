<?php

require_once "config.php";
use PHPMailer\PHPMailer\PHPMailer;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
    ]);
} catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $csvFile = "file.csv";
    $handle = fopen($csvFile, 'w');
    if ($handle === false) {
        exit("Error creating $csvFile");
    }

    $stmt = $conn->prepare("SELECT * FROM logy");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        fputcsv($handle, [$row["id"], $row["log_time"], $row["log"], $row["log_err"]]);
    }

    fclose($handle);

    require_once 'phpmailer/PHPMailer.php';
    require_once 'phpmailer/SMTP.php';
    require_once 'phpmailer/Exception.php';

    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "smtp.azet.sk";
    $mail->SMTPAuth = true;
    $mail->Username = "tym13webte2@azet.sk";
    $mail->Password = 'Tym13heslo2';
    $mail->Port = 465; //587
    $mail->SMTPSecure = "ssl"; //tls

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom('tym13webte2@azet.sk', 'Webte team 13');
    $mail->addAddress($receiveMail);
    $mail->Subject = 'Logs';
    $mail->Body = "V prilohe je vypis tabulky zo zoznamom logov";
    $mail->AddAttachment($csvFile);
    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
    }

$conn = null;

header('Location: ' . $_SERVER['HTTP_REFERER']);