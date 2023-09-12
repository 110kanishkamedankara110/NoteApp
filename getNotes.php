<?php

require "database.php";
$id=$_GET["id"];
$query=Database::getPrepareStatement("SELECT `title`,`note`.`id`,`description`,`date`,`user_id`,`category`.`category` FROM `note` INNER JOIN `category` ON `category`.`id`=`note`.`category_id`  WHERE `user_id`=?");
$query->bind_param('s',$id);
$query->execute();
$exq=$query->get_result();
$items = $exq->num_rows;
$types=[];

for($i=0;$i<$items;$i++){
    $res = $exq->fetch_assoc();
    $data=new stdClass();
    $data->date=$res["date"];
    $data->type=$res["category"];
    $data->title=$res["title"];
    $data->description=$res["description"];
    $data->id=$res["id"];
    
    $types[$i]=$data;
}

echo json_encode($types);

?>