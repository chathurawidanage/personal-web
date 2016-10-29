<?php

include_once './DB.php';
include 'Response.php';
include './word.class.php';
$string = filter_input(INPUT_GET, "str");
$words = explode(" ", trim($string));
$db = new DB();
define("NO_SUCH_WORD", 0);
define("NO_DATA_FOR_WORD", 1);

$motions = array();
$response = new Response();
$response->data = array();
foreach ($words as $word) {
    $mData = getData($word);
    $wordObj = new Word();
    $wordObj->word = $word;
    if ($mData == NO_DATA_FOR_WORD || $mData == NO_SUCH_WORD) {
        $wordObj->data = array();
        $wordObj->type = Word::TYPE_CHAR;
        for ($i = 0; $i < strlen($word); $i++) {
            $char = $word[$i];
            $mData2 = getData($char);
            array_push($wordObj->data, $mData2['data']);
        }
    } else {
        $wordObj->data = $mData['data'];
        $wordObj->type = Word::TYPE_WORD;
    }
    array_push($response->data, $wordObj);
}
$response->error = Response::SUCCESS;
echo json_encode($response);

function getData($word) {
    global $db;
    $result = $db->query("SELECT id,data,word FROM words WHERE LOWER(word)='$word'")->fetchAll(PDO::FETCH_ASSOC);
    if (sizeof($result) == 0) {
        return NO_SUCH_WORD;
    } else if ($result[0]['data'] == NULL) {
        return NO_DATA_FOR_WORD;
    } else {
        return $result[0];
    }
}
