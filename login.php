<?php 
require "database.php";
$t = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$t->setTimezone($tz);

$massage=new stdClass();

$user=json_decode(file_get_contents("php://input"));

$mobile=$user->mobile;
$password=$user->password;


if(empty($mobile)){
    $massage->status="Empty Value";
    $massage->massage="Enter Mobile Number";
}else if(empty($password)){
    $massage->status="Empty Value";
    $massage->massage="Enter Password";
}else{

    $squery=Database::getPrepareStatement("SELECT * FROM `user` WHERE `mobile`=? AND `password`=?");
    $squery->bind_param('ss',$mobile,$password);
    $squery->execute();
    $sexq=$squery->get_result();
    $sitems = $sexq->num_rows;

    if($sitems==1){
        $massage->status="Sucess";
        $massage->massage="User Log In Sucess";
        $massage->user=$sexq->fetch_assoc();
    }else{
        $massage->status="Error";
        $massage->massage="Invalid User Details";
        
    }




}

echo json_encode($massage);

?>