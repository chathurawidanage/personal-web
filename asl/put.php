<?php

/*
 * chathura widanage <chathurawidanage@gmail.com>
 */
include_once './DB.php';

$data = filter_input(INPUT_POST, 'data');
$id = filter_input(INPUT_POST, 'id');

$qry = "UPDATE words SET data='$data' WHERE id=$id";
$db = new DB();
$db->query($qry);

