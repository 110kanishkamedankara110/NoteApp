<?php 
require "database.php";
$t = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$t->setTimezone($tz);

$massage=new stdClass();

$user=json_decode(file_get_contents("php://input"));
$firstName=$user->firstName;
$lastName=$user->lastName;
$mobile=$user->mobile;
$userType=$user->type;
$password=$user->password;
$date_time =$t->format("Y-m-d H:i:s");

if(empty($mobile)){
    $massage->status="Empty Value";
    $massage->massage="Enter Mobile Number";
}else if(!preg_match("/\b07[0-8][0-9]{7}\b/",$mobile)){
    $massage->status="Invalid Value";
    $massage->massage="Invalid Number";
}else if(empty($firstName)){
    $massage->status="Empty Value";
    $massage->massage="Enter First Name";
}else if(empty($lastName)){
    $massage->status="Empty Value";
    $massage->massage="Enter Last Name";
}else if(empty($password)){
    $massage->status="Empty Value";
    $massage->massage="Enter Password";
}else if(empty($userType)){
    $massage->status="Empty Value";
    $massage->massage="Select User Type";
}else{

    $squery=Database::getPrepareStatement("SELECT * FROM `user` WHERE `mobile`=?");
    $squery->bind_param('s',$mobile);
    $squery->execute();
    $sexq=$squery->get_result();
    $sitems = $sexq->num_rows;
    if($sitems>=1){
        $massage->status="User Error";
        $massage->massage="User Alredy Exsists";
    }else{
       

        $massage->status="Sucess";
        $massage->massage="User Sign Up Sucess";


    }




}

echo json_encode($massage);

?>