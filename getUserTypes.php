<?php

require "database.php";

$query=Database::getPrepareStatement("SELECT * FROM `user_type`");
$query->execute();
$exq=$query->get_result();
$items = $exq->num_rows;
$types=[];

for($i=0;$i<$items;$i++){
    $res = $exq->fetch_assoc();
    $data=new stdClass();
    $data->value=$res["id"];
    $data->label=$res["user_type"];
    $types[$i]=$data;
}

echo json_encode($types);

?>