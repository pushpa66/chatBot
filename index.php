<?php

$accessToken = "EAACVyPw6FJoBAFAcdTEPDrruWBykdeLgwivYwH1GCGWSZCQETLekDP63HJlQ5EeExDaRMNI5UczQaHaa4C25aeWFEMNnF9mHc6BOq3AcjawGEQZBDSHCZCH43YH2k8YneWXxgxDrZB5NZAUYWfbBZBASydcdYevfZCtaRfKsZCJq5S7UsSMrITsZB";
if (isset($_GET['hub_mode']) && isset($_GET['hub_challenge']) && isset($_GET['hub_verify_token'])){
    if($_GET['hub_verify_token'] == "abcd1234") {
        echo $_GET['hub_challenge'];
    } else {
        $feedData = file_get_contents('php://input');
        $handle = fopen('test.txt','w');
        fwrite($handle, "How are you");
        fclose($handle);
    }

    http_response_code(200);
}
