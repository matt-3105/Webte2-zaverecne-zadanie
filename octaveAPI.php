<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');

$error = '';
$octaveCmd = '';


if(isset($_GET['key']) and strcmp($key, $_GET['key']) == 0){
    if(isset($_GET['r']) and is_numeric($_GET['r'])){
        $r = $_GET['r'];
        $offset = 0;
        if(!empty($_GET['start'])){
            $start = explode(',', $_GET['start']);
            if(count($start) == 6){
                $offset = $start[5];
                $octaveCmd = "\"m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;pkg load control;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;initX1=0; initX1d=0;initX2=0; initX2d=0;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[$start[0];$start[1];$start[2];$start[3];$start[4]]);output_precision(7);[t x]\"";
            }else{
                $error = 'Bad request';
                databaseLogging($r,$error);
                http_response_code(400);
                exit();
            }
        }else {
            $octaveCmd = "\"m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;pkg load control;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;initX1=0; initX1d=0;initX2=0; initX2d=0;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);output_precision(7);[t x]\"";

        }
        $cmd = "octave-cli --eval $octaveCmd 2>&1";
        exec($cmd, $output, $return);
        if($return != 0){
            if(count($output) > 1){
                $error = $output[0] . $output[2];
            }else{
                $error = $output[0];
            }
            databaseLogging($r,$error);
            http_response_code(400);
            exit();
        }else{
            $output = array_slice($output, 2, 501);
            databaseLogging($r,$error);
            echo json_encode(parse($output, $offset, $r));
        }
    }else if(isset($_GET['command'])) {
        $octaveCmd = $_GET['command'];
        $cmd = "octave-cli --eval \"$octaveCmd\" 2>&1";
        exec($cmd, $output, $return);
        if($return != 0){
            if(count($output) > 1){
                $error = $output[0] . $output[2];
            }else{
                $error = $output[0];
            }
            databaseLogging($octaveCmd,$error);
            http_response_code(400);
            exit();
        }else{
            echo json_encode($output);
        }
    }else {
        $error = 'Bad request';
        databaseLogging($octaveCmd,$error);
        http_response_code(400);
        exit();
    }
}else{
    $error = 'Unauthorized';
    http_response_code(401);
    exit();
}

//TODO log $octaveCmd, $error

function parse($output, $offset, $r){
    for($i = 0; $i < 501; $i++){
        $row = preg_replace('/\s+/', ',', $output[$i]);
        $row = explode(',', $row);
        $t[$i] = round(floatval($row[1]) + $offset, 2);
        $x[$i] = [floatval($row[2]), floatval($row[3]), floatval($row[4]), floatval($row[5]), floatval($row[6])];
    }
    return ['t' => $t, 'x' => $x, 'r' => [floatval($r)]];
}

function databaseLogging($r,$error){
    $servername = "localhost";
    $username = "xkuflik";
    $password = "xkuflikwebte2";
    $dbname = "skuskove1";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $sql = "INSERT INTO logy (log_time,log,log_err) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([date("Y-m-d H:i:s"),$r,$error]);
    //sadasdas
}