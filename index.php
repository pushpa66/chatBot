<?php
$accessToken = "EAAc1rZCVCsX0BAAiIWUfZAoCPg9LwEQJAbkJpH5Veov4ZAjbUjqUZAri4ZCxTao1BEIa5ZA4XtH6NZBxOZBAu8ZCFQD1TfkZCCbHkC6aTASmNyXI6j4wqaaoUdKg58k6rWTkU88dCvHkjsECKwVc70bEXzBlAFEhMgRXUa01G6Sa07Kp4YVrAFiJyh";
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
// Set this Verify Token Value on your Facebook App
if ($verify_token === 'abcd1234') {
    echo $challenge;
}
$input = json_decode(file_get_contents('php://input'), true);
// Get the Senders Graph ID
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
// Get the returned message
$message = $input['entry'][0]['messaging'][0]['message']['text'];
//API Url and Access Token, generate this token value on your Facebook App Page
$url = "https://graph.facebook.com/v2.6/me/messages?access_token=$accessToken";
//Initiate cURL.
$ch = curl_init($url);

//$message_type = "text";
$message_type = "image";

if ($message_type == "text"){
    $jsonData = '{
        "recipient":{
            "id":"' . $sender . '"
        }, 
        "message":{
            "text":"It works bro..."
        }
    }';
} else if ($message_type == "image"){
    $jsonData = '{
        "recipient":{
            "id":"' . $sender . '"
        }, 
        "message":{
            "attachment":{
                "type" : "image",
                "payload":{
                    "url" : "http://www.dogster.com/wp-content/uploads/2015/05/husky-puppies-06.jpg",
                    "is_reusable" : true
                }
            }
        }
    }';
}

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//Execute the request but first check if the message is not empty.
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
?>