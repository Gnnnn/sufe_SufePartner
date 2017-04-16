<?php  
 session_start();
$request=$_GET["request"];

if($request=="view"){
  $username=$_SESSION["username"];
  if(!$username){
    
    echo json_encode(array("isLogin"=>0));  
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
      // $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT distinct `username`,`title`,`details`,`picurl`,`time` from qus2 where qus2id = {$value};");
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
    echo json_encode(array("isLogin"=>0));  
    }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT helper,count(qus2id) as count from qus2 group by helper order by count(qus2id) desc;");
      $row1 = mysqli_fetch_array($result);
      $helper = $row1[helper];
      if($row1[helper]== null){
          $temp=array();
          $temp1=array();
          while($res=mysqli_fetch_assoc($result)) {
                $temp[]=$res[helper];
                $temp1[]=$res[count];
            }
            $helper = $temp[0];
          $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$helper}';");
      $row2 = mysqli_fetch_array($result2);
      echo json_encode(array("helper"=>$helper,"count"=>$temp1[0],"pic"=>$row2["userpic"]));
      return ;
      }
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$helper}';");
      $row2 = mysqli_fetch_array($result2);
      // $helper = $row1[helper];
      // $result2=mysqli_query($con,"SELECT userpic from user where username='{$helper}';");
      // $row2 = mysqli_fetch_array($result2);
      // echo json_encode(array("helper"=>$row1[helper],"count"=>$row1[count],"pic"=>$row2[userpic]));
      echo json_encode(array("helper"=>$helper,"count"=>$row1[count],"pic"=>$row2["userpic"]));
        return;
        }
}

if($request=="viewmyinfo"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
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
      // echo $usermail."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      // return ;
      // echo "fuck it";
      //file start
      $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);     // 获取文件后缀名
        // echo $_FILES["file"]["type"]."  ".$_FILES["file"]["size"];
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
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
      // echo "<script>alert('发布成功！'); history.go(-1);</script>";
      // header("Location: ../myinfor.html"); 
      //确保重定向后，后续代码不会被执行 
      return;
      }
  }
}

if($request=="myinfo1"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../login.html'</script>";  
  }
  else{
      $usertel = $_POST["usertel"];
      $usermail = $_POST["usermail"];
      $usertag1 = $_POST["inst"];
      $usertag = implode(',',$usertag1);
      $usergender = $_POST["sex"];
      // echo $usermail."  ".$usertag."  ".$usertel."  ".$usergender."  ";
      // return ;
      // echo "fuck it";
      //file start
      $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);     // 获取文件后缀名
        // echo $_FILES["file"]["type"]."  ".$_FILES["file"]["size"];
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
              // echo $_FILES["file"]["name"] . " 文件已经存在。 ";
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
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
      // echo "<script>alert('发布成功！'); history.go(-1);</script>";
      header("Location: ../myinfor.html"); 
      //确保重定向后，后续代码不会被执行 
      return;
      }
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
          $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$row["username"]}';");
      $row2 = mysqli_fetch_array($result2);
      if(!$row2["userpic"]){
        $oq["pic"]="images/f2.jpg";
      }
      else{
        $oq["pic"]=$row2["userpic"];
      }
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
    echo json_encode(array("isLogin"=>0));  
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

if($request=="qusview"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");

      $result = mysqli_query($con,"SELECT `username`,`title`,`details`,`picurl`,`time` from qus2 where qus2id = {$_SESSION["thisqus2id"]};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `helper` from qus2 where qus2id = {$_SESSION["thisqus2id"]};");
      $roww = mysqli_fetch_array($result);
      $helpernum = $roww[helper];
      echo $helpernum;
      if(!helpernum){
        $helpernum = 0;
      }
      else{
      $helpernum = mysqli_num_rows($result2);
      $temp=array();
      while($res=mysqli_fetch_assoc($result2)) {
                $temp[]=$res[qus2id];
        }
        // echo $temp;
      }
      $username1 = $row["username"]; 
      // echo $username1;
      $result5 = mysqli_query($con,"SELECT `userpic` from user where username = '{$username1}';");
      $row5 = mysqli_fetch_array($result5);
      if(!$row5["userpic"]){
        $oq["pic"]="images/f2.jpg";
      }
      else{
        $oq["pic"]=$row5["userpic"];
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


if($request=="myans"){
  $username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../login.html'</script>";  
  }
  else{
      $myans = $_POST["myans"];
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result = mysqli_query($con,"SELECT username,title,details,picurl from qus2 where qus2id = '{$_SESSION["thisqus2id"]}';");
      $row = mysqli_fetch_array($result);
      $old_userpic = $row["picurl"];
      $old_title = $row["title"];
      $old_details = $row["details"];
      $old_username = $row["username"];
      $timenow = date('y-m-d h:i:s',time());
      $result = mysqli_query($con,"INSERT into qus2 set username = '{$old_username}',title='{$old_title}',details='{$old_details}',picurl='{$old_userpic}',qus2id = '{$_SESSION["thisqus2id"]}',helper='{$_SESSION[username]}',ans='{$myans}',`time`='{$timenow}';");
      $result = mysqli_query($con,"SELECT ans from qus2 where helper = '{$_SESSION[username]}';");
      $row = mysqli_fetch_array($result);
      // echo $row[ans];
      if($row[ans]!=$myans){
      echo json_encode(array("isUpdate"=>0));
      return;
      } 
      else{
      echo json_encode(array("isUpdate"=>1));
      return;
      }
  }
}

if($request=="ansview"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");

      $result = mysqli_query($con,"SELECT helper from qus2 where qus2id={$_SESSION["thisqus2id"]};");
      $helpernum = mysqli_num_rows($result);
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[helper];
        }
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `ans`from qus2 where helper = '{$value}' and qus2id={$_SESSION["thisqus2id"]};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username ='{$value}';");
      $row2 = mysqli_fetch_array($result2);
        $oq["pic"]=$row2["userpic"];
        $oq["ans"]=$row["ans"];
        $oq["helper"]=$value;      
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}


if($request=="myqus"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");

      $result=mysqli_query($con,"SELECT `qus2id` FROM qus2 where username = '{$username}';");
      $qusnum = mysqli_num_rows($result);
      // echo $qusnum;
      // $qusnum是题目总数
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qus2id];
        }
        //$temp[]是一个数组，里面有所有我发布题目的题号
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `title`,`details`,`picurl`,`time`,username from qus2 where qus2id = {$value};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$row["username"]}';");
      $row2 = mysqli_fetch_array($result2);
      if(!$row2["userpic"]){
        $oq["pic"]="images/f2.jpg";
      }
      else{
        $oq["pic"]=$row2["userpic"];
      }
      if(!$row){
        $oq["title"]=null;   
        $oq["details"]=null;
        $oq["picurl"]=null;
        $oq["username"]=null;
        $oq["time"]=0;
      }
      else{
        $oq["picurl"]=$row["picurl"];
        $oq["title"]=$row["title"];
        $oq["details"]=$row["details"];
        $oq["username"]=$row["username"];
        $oq["time"]=$row["time"];
      }
      
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="myanslist"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");

      $result=mysqli_query($con,"SELECT distinct `qus2id` FROM qus2 where helper = '{$username}';");
      $qusnum = mysqli_num_rows($result);
      // echo $qusnum;
      // $qusnum是题目总数
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qus2id];
        }
        //$temp[]是一个数组，里面有所有我发布题目的题号
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `title`,`details`,`picurl`,`time`,username from qus2 where qus2id = {$value};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$row["username"]}';");
      $row2 = mysqli_fetch_array($result2);
      if(!$row2["userpic"]){
        $oq["pic"]="images/f2.jpg";
      }
      else{
        $oq["pic"]=$row2["userpic"];
      }
      if(!$row){
        $oq["title"]=null;   
        $oq["details"]=null;
        $oq["picurl"]=null;
        $oq["username"]=null;
        $oq["time"]=0;
      }
      else{
        $oq["picurl"]=$row["picurl"];
        $oq["title"]=$row["title"];
        $oq["details"]=$row["details"];
        $oq["username"]=$row["username"];
        $oq["time"]=$row["time"];
      }
      
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

?>