<?php
session_start();
$GLOBALS['dbip'] = '****';
$GLOBALS['usn'] = '****';
$GLOBALS['psw'] = '****';
$GLOBALS['dbname'] = 'xcxcketest_com';

header("Content-type: text/html; charset=utf-8");
$username=$_SESSION["username"];

if(!$username){
    echo "<script>self.location='../login.html'</script>";  
    }
else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
     mysqli_query($con, "set names UTF8"); 
    $username = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];
    $d=strtotime("2017-12-14 10:38pm");
    $time = date("Y-m-d h:i:sa", $d);

    $res_insert = mysqli_query($con,"INSERT into contact SET `username` = '{$username}',`email`= '{$email}',`time` = '{$time}',message = '{$message}';");  
    $result = mysqli_query($con,"select message from contact where username = '$username'");  
      if(!mysqli_num_rows($result)){
      // echo json_encode(array("isUpdate"=>0));
      echo "<script>alert('发布失败！'); history.go(-1);window.location.reload();</script>";
      return;
      } 
      else{
      // echo json_encode(array("isUpdate"=>1));
      echo "<script>alert('发布成功！'); history.go(-1);window.location.reload();</script>";
      // echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
      return;
      }   
    }

?>