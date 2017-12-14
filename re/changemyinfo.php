<?
session_start();

$GLOBALS['dbip'] = '**';
$GLOBALS['usn'] = '**';
$GLOBALS['psw'] = '**';
$GLOBALS['dbname'] = '**';

header("Content-type: text/html; charset=utf-8");  

$username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../login.html'</script>";  
  }
  else{
      $usertel = $_POST["usertel"];
      $usermail = $_POST["usermail"];
      $usertag = $_POST["usertag"];
      $usergender = $_POST["usergender"];
      // echo $usermail."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      // return ;
      //file start
      $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);     // 获取文件后缀名
        echo $_FILES["file"]["type"]."  ".$_FILES["file"]["size"];
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2048000)   
        && in_array($extension, $allowedExts))
        {
          if ($_FILES["file"]["error"] > 0)
          {
              $picurl = null;
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
          }
          else
          {
            if (file_exists("../upload/" . $_FILES["file"]["name"]))
            {
              $picurl = "upload/" . $_FILES["file"]["name"];
              echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
              move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
              $picurl = "upload/" . $_FILES["file"]["name"];
            }
          }
        }
        else{
          // echo "格式或大小不对";
          $picurl = null;
        }
      //file end
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      //bug start 
      $result1 = mysqli_query($con,"SELECT usertel,usermail,usertag,usergender,userpic from user where username = '{$username}';"); //get the old information
      $row1 = mysqli_fetch_array($result1);
      $old_usertel = $row1[usertel];
      $old_usermail = $row1[usermail];
      $old_usergender = $row1[usergender];
      $old_usertag = $row1[usertag];
      $old_userpic = $row1[userpic];
      // echo $old_usermail."  ".$old_userpic."  ".$old_usertag."  ".$old_usertel."  ".$old_usergender."  ";
      if($usermail == null){
        $usermail = $old_usermail;
      }
      if($usertel == null){
        $usertel = $old_usertel;
      }
      if($usergender == null){
        $usergender = $old_usergender;
      }
      if($usertag == null){
        $usertag = $old_usertag;
      }
      if($uerpic == null){
        $userpic = $old_userpic;
      }
      // echo "  ".$usermail."  ".$userpic."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      //bug end;I worte = ! It should be == !shit
      $result = mysqli_query($con,"UPDATE user SET `usertel` = '{$usertel}', `usermail`= '{$usermail}' ,`usertag`= '{$usertag}' ,`usergender` = '{$usergender}' ,`userpic` = '{$picurl}' where `username` = '{$username}';");
      $result = mysqli_query($con,"SELECT username from user where usertel = '{$usertel}';");
      if(!mysqli_num_rows($result)){
      echo json_encode(array("isUpdate"=>0));
      return;
      } 
      else{
      echo json_encode(array("isUpdate"=>1));
      return;
      }
  }

?>