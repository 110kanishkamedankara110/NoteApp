<?php

require "database.php";
$id=$_GET["id"];
$query=Database::getPrepareStatement("DELETE FROM `note` WHERE `id`=?");
$query->bind_param('s',$id);
$query->execute();

$massage=new stdClass();

    $massage=new stdClass();


    $massage->status="Sucess";
    $massage->massage="Note Deleted";

echo json_encode($massage);

?>