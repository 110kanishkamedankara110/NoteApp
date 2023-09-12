<?php 
require "database.php";
$t = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$t->setTimezone($tz);

$massage=new stdClass();

$note=json_decode(file_get_contents("php://input"));
$title=$note->title;
$description=$note->description;
$category=$note->category;
$date_time =$t->format("Y-m-d H:i:s");
$id=$note->user;
if(empty($title)){
    $massage->status="Empty Value";
    $massage->massage="Enter Title";
}else if(empty($description)){
    $massage->status="Empty Value";
    $massage->massage="Enter Description";
}else if(empty($category)){
    $massage->status="Empty Value";
    $massage->massage="Select Category";
}else{
    
    
        $query=Database::getPrepareStatement("INSERT INTO `note` (`title`,`description`,`date`,`category_id`,`user_id`) VALUES (?,?,?,?,?)");
        $query->bind_param("sssss",$title,$description,$date_time,$category,$id);
        $query->execute();

        $massage->status="Sucess";
        $massage->massage="Note Saved";
    




}

echo json_encode($massage);

?>