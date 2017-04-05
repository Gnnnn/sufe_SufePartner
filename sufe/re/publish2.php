<?php  
 session_start();
$request=$_GET["request"];

if($request=="view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");

      $result=mysqli_query($con,"SELECT `qus2id` FROM qus2");
      $qusnum = mysqli_num_rows($result);
      //$qusnum是题目总数
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qus2id];
        }
        //$temp[]是一个数组，里面有所有（还在的）题目的题号
      $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `username`,`title`,`details`,`picurl`,`time` from qus2 where qus2id = {$value};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `helper` from qus2 where qus2id = {$value};");
      if(!result2){
        $helpernum = 0;
      }
      else{
      $helpernum = mysqli_num_rows($result2);
      }
      if(!$row){
        $oq["title"]=null;   
        $oq["details"]=null;
        $oq["picurl"]=null;
        $oq["username"]=null;
        $oq["helpernum"]=0;
        $oq["time"]=0;
      }
      else{
        $oq["picurl"]=$row["picurl"];
        $oq["title"]=$row["title"];
        $oq["details"]=$row["details"];
        $oq["username"]=$row["username"];
        $oq["time"]=$row["time"];
        $oq["helpernum"]=$helpernum;
      }
      
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="besthelper"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../index.html'</script>";  
    }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT helper,count(qus2id) as count from qus2 group by helper order by count(qus2id) desc;");
      $qusnum = mysqli_num_rows($result);
      $row1 = mysqli_fetch_array($result);
      echo json_encode(array("helper"=>$row1[helper],"count"=>$row1[count]));
        return;
        }
}

if($request=="viewmyinfo"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../index.html'</script>";  
    }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT usertel,usermail,usergender,usertag,userpic from user where username = '{$username}';");
      $row1 = mysqli_fetch_array($result);
      echo json_encode(array("usertel"=>$row1[usertel],"usermail"=>$row1[usermail],"usergender"=>$row1[usergender],"usertag"=>$row1[usertag],"userpic"=>$row1[userpic],"username"=>$username));
        return;
        }
}


if($request=="myinfo"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../login.html'</script>";  
  }
  else{
      $usertel = $_POST["usertel"];
      $usermail = $_POST["usermail"];
      $usertag = $_POST["usertag"];
      $usergender = $_POST["usergender"];
      echo $usermail."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      return ;
      //file start
      // $allowedExts = array("gif", "jpeg", "jpg", "png");
      //   $temp = explode(".", $_FILES["file"]["name"]);
      //   $extension = end($temp);     // 获取文件后缀名
      //   echo $_FILES["file"]["type"]."  ".$_FILES["file"]["size"];
      //   if ((($_FILES["file"]["type"] == "image/gif")
      //   || ($_FILES["file"]["type"] == "image/jpeg")
      //   || ($_FILES["file"]["type"] == "image/jpg")
      //   || ($_FILES["file"]["type"] == "image/pjpeg")
      //   || ($_FILES["file"]["type"] == "image/x-png")
      //   || ($_FILES["file"]["type"] == "image/png"))
      //   && ($_FILES["file"]["size"] < 2048000)   
      //   && in_array($extension, $allowedExts))
      //   {
      //     if ($_FILES["file"]["error"] > 0)
      //     {
      //         $picurl = null;
      //       echo "错误：: " . $_FILES["file"]["error"] . "<br>";
      //     }
      //     else
      //     {
      //       if (file_exists("../upload/" . $_FILES["file"]["name"]))
      //       {
      //         $picurl = "upload/" . $_FILES["file"]["name"];
      //         echo $_FILES["file"]["name"] . " 文件已经存在。 ";
      //       }
      //       else
      //       {
      //         move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
      //         $picurl = "upload/" . $_FILES["file"]["name"];
      //       }
      //     }
      //   }
      //   else{
      //     echo "格式或大小不对";
      //     $picurl = null;
      //   }
      // //file end
      // // echo $usermail."  ".$userpic."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      // $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      // mysqli_query($con,"SET NAMES 'UTF8'");
      // //bug start 
      // // $result1 = mysqli_query($con,"SELECT usertel,usermail,usertag,usergender,userpic from user where username = '{$username}';"); //get the old information
      // // $row1 = mysqli_fetch_array($result1);
      // // $old_usertel = $row1[usertel];
      // // $old_usermail = $row1[usermail];
      // // $old_usergender = $row1[usergender];
      // // $old_usertag = $row1[usertag];
      // // $old_userpic = $row1[userpic];
      // // echo $old_usermail."  ".$old_userpic."  ".$old_usertag."  ".$old_usertel."  ".$old_usergender."  ";
      // // if($usermail = null){
      // //   $usermail = $old_usermail;
      // // }
      // // if($usertel = null){
      // //   $usertel = $old_usertel;
      // // }
      // // if($usergender = null){
      // //   $usergender = $old_usergender;
      // // }
      // // if($usertag = null){
      // //   $usertag = $old_usertag;
      // // }
      // // if($uerpic = null){
      // //   $userpic = $old_userpic;
      // // }
      // // echo $usermail."  ".$userpic."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      // //bug end;fuck it
      // $result = mysqli_query($con,"UPDATE user SET `usertel` = '{$usertel}', `usermail`= '{$usermail}' ,`usertag`= '{$usertag}' ,`usergender` = '{$usergender}' ,`userpic` = '{$picurl}' where `username` = '{$username}';");
      // $result = mysqli_query($con,"SELECT username from qus where usertel = '{$usertel}';");
      // if(!mysqli_num_rows($result)){
      // echo json_encode(array("isUpdate"=>0));
      // return;
      // } 
      // else{
      // echo json_encode(array("isUpdate"=>1));
      // return;
      // }
  }
}

if($request=="getsearchcontents"){
  $_SESSION[searchcontents] = $_POST["searchcontents"]; 
  // echo $_SESSION[searchcontents];
  echo "<script>self.location='../quesdetails.html'</script>";  
  return;
}

if($request=="search"){
  $username=$_SESSION["username"];
      if(!$username){
        echo "<script>self.location='../login.html'</script>";  
      }
      else{
        $searchcontents = $_SESSION[searchcontents];    
        $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");//连接数据库
        mysqli_query($con, "set names UTF8");
        $result = mysqli_query($con,"SELECT qus2id from qus2 where title like '%{$searchcontents}%';"); 
        $qusnum = mysqli_num_rows($result);
        // echo $qusnum;
        $temp=array();
          while($res=mysqli_fetch_assoc($result)) {
                $temp[]=$res[qus2id];
            }
          foreach ($temp as $value) {
          $result = mysqli_query($con,"SELECT `username`,`title`,`details`,`picurl`,`time`,`helper` from qus2 where qus2id = {$value};");
          $row = mysqli_fetch_array($result);
          if(!$row){
            $oq["username"]=null;   
            $oq["title"]=null;
            $oq["details"]=null;
            $oq["picurl"]=null;
            $oq["time"]=null;
            $oq["helper"]=null;
          }
          else{
            $oq["username"]=$row["username"];   
            $oq["title"]=$row["title"];
            $oq["details"]=$row["details"];
            $oq["qusinfo"]=$row["qusinfo"];
            $oq["helper"]=$row["helper"];
            $oq["time"]=$row["time"];
          }
          $listJson[]=$oq;
          } 
        echo json_encode($listJson);
    }
    return ;
}

if($request=="goto2details")
{
  $qustitle=$_POST["qustitle"];
  // echo $qustitle;
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
    $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
      $qustitle = strtolower($qustitle);
      // echo $qustitle;
    $result = mysqli_query($con,"SELECT qus2id from qus2 where title = '{$qustitle}';");//根据题目相同找到了题号
    $row = mysqli_fetch_array($result);//题号$row
    // echo $row[qus2id];
    $_SESSION["thisqus2id"]= $row[qus2id];
    // echo $_SESSION["thisqus2id"];
    return ;
  }
}

if($request=="ansview"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");

      $result = mysqli_query($con,"SELECT `username`,`title`,`details`,`picurl`,`time` from qus2 where qus2id = {$_SESSION["thisqus2id"]};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `helper` from qus2 where qus2id = {$value};");
      if(!result2){
        $helpernum = 0;
      }
      else{
      $helpernum = mysqli_num_rows($result2);
      $temp=array();
      while($res=mysqli_fetch_assoc($result2)) {
                $temp[]=$res[qus2id];
        }
        echo $temp;
      }
      if(!$row){
        $oq["title"]=null;   
        $oq["details"]=null;
        $oq["picurl"]=null;
        $oq["username"]=null;
        $oq["helpernum"]=0;
        $oq["time"]=0;
      }
      else{
        $oq["picurl"]=$row["picurl"];
        $oq["title"]=$row["title"];
        $oq["details"]=$row["details"];
        $oq["username"]=$row["username"];
        $oq["time"]=$row["time"];
        $oq["helpernum"]=$helpernum;
      }
      
      $listJson[]=$oq;
      }
      echo json_encode($listJson);

  return;
}


?>