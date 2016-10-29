<?php

include_once './PageFetch.class.php';
include_once './DB.php';
include './Response.php';

$word = filter_input(INPUT_GET, "word");



$db = new DB();
$res = $db->query("SELECT id,base_url,fetched,data FROM words WHERE LOWER(word)='$word'");
$data = $res->fetchAll(PDO::FETCH_ASSOC);

$response = new Response();
if (!$data) {
    $response->error = Response::ERROR_DATABASE;
    echo json_encode($response);
    die();
}

$base_url = $data[0]['base_url'];
$id = $data[0]['id'];
$fetched = $data[0]['fetched'];
$motionData = $data[0]['data'];

if ($fetched == TRUE) {
    $videoURL = "videos/$id." . (strlen($word) != 1 ? "mp4" : "gif");
    error_log($videoURL);
    $response->error = Response::SUCCESS;
    $response->payload = $videoURL;
    $response->id = $id;
    $response->data = $motionData;
    echo json_encode($response);
    die();
}
//if video is not in the db
$pageFetch = new PageFetch();
$page = $pageFetch->get($base_url);

$url = $page->filter('#mySign')->attr('src'); //text();

if ($url == '') {
    $response->error = Response::ERROR_SERVICE;
    echo json_encode($response);
} else {
    if (strlen($word) != 1) {

        $url = "http://www.handspeak.com" . $url;
        $data = file_get_contents($url);
        $videoURL = "videos/$id.mp4";
        $handle = fopen($videoURL, "w");

        fwrite($handle, $data);
        fclose($handle);
        $response->payload = $videoURL;
    } else {
        $data = file_get_contents("http://www.medword.com//pics/asl_sign_$word.gif");
        $videoURL = "videos/$id.gif";
        $handle = fopen($videoURL, "w");

        fwrite($handle, $data);
        fclose($handle);
        $response->payload = $videoURL;
    }

    $response->error = Response::SUCCESS;
    $response->id = $id;
    $db->query("UPDATE words SET fetched=TRUE WHERE id=$id");
    echo json_encode($response);
}

