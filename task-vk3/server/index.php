<?php

require_once 'settings/db.php';

date_default_timezone_set("Europe/Moscow");

$data = array();
$code = 500;

$path = explode('/', trim($_SERVER['REDIRECT_URL'], '/'));

if($path[0] == 'save_event'){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $dataInput = json_decode(file_get_contents('php://input'), true);
        if (isset($dataInput['event_name']) && isset($dataInput['user_status']) && $dataInput['event_name'] != '' 
            && $dataInput['user_status'] != ''){
            try{
                $status = $dataInput['user_status'] == 'authorized';
                $mysqli = openMysqli();
                $stmt = $mysqli->prepare("INSERT INTO events VALUES (NULL, ?, ?, ?, NOW())");
                $stmt->bind_param("sis", $dataInput["event_name"], $status, $_SERVER['REMOTE_ADDR']);
                $stmt->execute();
                $stmt->close();
                $code = 200;
                $data = ['SUCCESS' => 'Удачно'];
            }catch(Exception $e){
                $data = ['SQL_INPUT_ERROR' => 'Ошибка работы sql: '. $e];
            }
        }else{
            $code = 400;
            $data = ['NOT_CORRECT_DATA' => 'Не правильно переданы параметры (требуется event_name типа varchar и user_status типа varchar)'];
        }
    }
    else {
        $code = 400;
        $data = ['NOT_POST' => 'Не является POST-запросом'];
    }



}elseif($path[0] == 'get_statistics'){

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if (isset($_GET['event_name']) && isset($_GET['start_date']) && isset($_GET['end_date']) && isset($_GET['aggregate_by']) 
            && $_GET['event_name'] != '' && $_GET['start_date'] != '' && $_GET['end_date'] != '' && $_GET['aggregate_by'] != ''){
            
        
            $mysqli = openMysqli();
            $event_name = $mysqli->real_escape_string($_GET['event_name']);
            $start_date = $mysqli->real_escape_string($_GET['start_date']);
            $end_date = $mysqli->real_escape_string($_GET['end_date']);
            $code = 200;
            switch ($_GET['aggregate_by']) {
                case "event":
                    $result = $mysqli->query("SELECT COUNT(event_name) AS count FROM events WHERE event_name = '$event_name' AND event_date >= '$start_date' AND event_date <= '$end_date'");
                    $data = ['count' => $result->fetch_assoc()['count']];
                    break;
                case "user":
                    $result = $mysqli->query("SELECT ip_address, COUNT(ip_address) AS count FROM events WHERE event_name = '$event_name' AND event_date >= '$start_date' AND event_date <= '$end_date' GROUP BY ip_address");
                    foreach ($result as $kay){
                        $finalData = [$kay['ip_address'] => $kay['count']];
                        $data += $finalData;
                    }
                    break;
                case "status":
                    $result = $mysqli->query("SELECT user_status, COUNT(user_status) AS count FROM events WHERE event_name = '$event_name' AND event_date >= '$start_date' AND event_date <= '$end_date' GROUP BY user_status");
                    foreach ($result as $kay){
                        $finalData = [$kay['user_status'] == 1 ? 'authorized' : 'noauthorized' => $kay['count']];
                        $data += $finalData;
                    }
                    break;
                default:
                    $code = 400;
                    $data = ['NOT_CORRECT_DATA' => 'Не является аргументом aggregate_by'];
                    break;
            }
            $mysqli->close();

        }else{
            $code = 400;
            $data = ['NOT_CORRECT_DATA' => 'Не правильно переданы параметры (требуется event_name типа varchar, start_date и end_date вида YYYY-MM-DD, aggregate_by типа varchar)'];
        }
    }
    else {
        $code = 400;
        $data = ['NOT_GET' => 'Не является GET-запросом'];
    }

}else{
    $code = 404;
    $data = ['NOT_API_METHOD' => 'Не является api методом'];
}

http_response_code($code);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);