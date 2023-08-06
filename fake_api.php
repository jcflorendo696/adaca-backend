<?php
header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');
// $jsonData = null;
$data = json_decode($jsonData);

if ($jsonData === null) {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid JSON data"));
    exit;
}else{
    $conversation_id    = $data->conversation_id;
    $message            = $data->message;
    
    $lowercaseMessage   = strtolower(trim($message));

    $wordsArr = array('goodbye','bye','hi','hello');
    $wordsPos = array();

    foreach($wordsArr as $item){
        if(strpos($lowercaseMessage, $item) || strpos($lowercaseMessage, $item) === 0 ){
            $wordsPos[strpos($lowercaseMessage, $item)] = $item;
        }
    };

    ksort($wordsPos);
    $firstword = array_values(array_slice($wordsPos, 0, 1));

    if($firstword[0] === 'hello' || $firstword[0] === 'hi'){
        $response_msg = "Welcome to Station Five";
    }else if($firstword[0] === 'bye' || $firstword[0] === 'goodbye'){
        $response_msg = "Thank you and see you around";
    }else{
        $response_msg = "Sorry, I do not understand";
    }

    $responsedata = [ 
        "response_id"   => $conversation_id,
        "message"       => $response_msg
    ];

    echo json_encode($responsedata);
}

opcache_reset();