<?php

include './DB.php';
set_time_limit(0);

//$json=$pageFetch->get("http://www.handspeak.com/word/search/app/autocomplete.php");
//$file=fopen("http://www.handspeak.com/word/search/app/autocomplete.php", 'r');
$file_handle = fopen("http://www.handspeak.com/word/search/app/autocomplete.php", "r");
$data = '';
while (!feof($file_handle)) {
    $line = fgets($file_handle);
    $data = $data . $line;
}
fclose($file_handle);
//$data = readfile("http://www.handspeak.com/word/search/app/autocomplete.php");

$db = new DB();
$arr = json_decode($data, true);
for ($i = 0; $i < sizeof($arr); $i++) {
    $url = $arr[$i]['id'];
    $value = $arr[$i]['value'];
    $db->query("INSERT INTO words(base_url,word) VALUES('$url','$value')");
}