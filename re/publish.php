<?php  
 session_start();
$request=$_GET["request"];

$GLOBALS['dbip'] = '**';
$GLOBALS['usn'] = '**';
$GLOBALS['psw'] = '**';
$GLOBALS['dbname'] = '**';

if($request=="islogin"){
  $username = $_SESSION["username"];
  if(!$username){
    echo json_encode(array("islogin"=>0));
    return ;
  }
  else
    echo json_encode(array("islogin"=>1,"name"=>$username));
    return ;
  }

if($request=="tpublish"){
  $username=$_SESSION["username"];
  // echo "session: ".$username;
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $title = $_POST["title"];  
      $loca = $_POST["loca"];
      $tag = $_POST["tag"];
      $tel = $_POST["tel"];
      $info = $_POST["info"];
      $timee = $_POST["timee"];
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT max(qusid) as maxqusid FROM qus");
      $row1 = mysqli_fetch_array($result);
      // echo $row1[maxqusid];
      $rrow = $row1[maxqusid]+1;
      // echo $tel." ".$timee." ".$title." ".$info." ".$rrow." ".$username." ".$tag." ".$loca;
      $result = mysqli_query($con,"insert into qus SET qustel = '{$tel}', `qustime`= '{$timee}' ,qustitle= '{$title}' ,qusinfo= '{$info}' ,qusid = '{$rrow}' ,username = '{$username}',qustag = '{$tag}',qusloca = '{$loca}',isCom = 0;");
      $result = mysqli_query($con,"SELECT username from qus where qustitle = '{$title}';");
      if(!mysqli_num_rows($result)){
      echo json_encode(array("isUpdate"=>0));
      return;
      } 
      else{
      echo json_encode(array("isUpdate"=>1));
      return;
      }
  }
}

if($request=="view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `isCom`!= 1");
      $qusnum = mysqli_num_rows($result);

      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
        }
      $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
        // echo $value;
      $result = mysqli_query($con,"SELECT `username`,`qustitle`,`qusinfo`from qus where qusid = {$value} and `isCom`!= 1;");
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
        $oq["tel"]=null;   
        $oq["date"]=null;
        $oq["title"]=null;
        $oq["info"]=null;
      }
      else{
        // $oq["tel"]=$row["tel"];   
        // $oq["date"]=$row["date"];
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
        // $oq["isReceived"]=$row["isReceived"];
      }
      
      $listJson[]=$oq;
      }
      // echo json_encode(array("qusnum"=>$qusnum));
      echo json_encode($listJson);
  }
  return;
}

//有Bug,现在只有单行查询，应该增加多行查询，专业课那个不对
if($request=="math_view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `isCom`!= 1 and `qustag` = 'math';");
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
        }
      $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `username`,`qustitle`,`qusinfo`from qus where qusid = {$value} and `isCom`!= 1;");
      $row = mysqli_fetch_array($result);
      if(!$row){
        $oq["qustitle"]=null;
        $oq["qusinfo"]=null;
        $oq["username"]=null;
      }
      else{
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
      }
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="english_view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `isCom`!= 1 and `qustag` = 'english';");
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
        }
      $qusnum = mysqli_num_rows($result);
      // echo $qusnum;
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `username`,`qustitle`,`qusinfo`from qus where qusid = {$value} and `isCom`!= 1;");
      $row = mysqli_fetch_array($result);
      if(!$row){
        $oq["qustitle"]=null;
        $oq["qusinfo"]=null;
        $oq["username"]=null;
      }
      else{
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
      }
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="language_view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `isCom`!= 1 and `qustag` = 'language';");
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
        }
      $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `username`,`qustitle`,`qusinfo`from qus where qusid = {$value} and `isCom`!= 1;");
      $row = mysqli_fetch_array($result);
      if(!$row){
        $oq["qustitle"]=null;
        $oq["qusinfo"]=null;
        $oq["username"]=null;
      }
      else{
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
      }
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="specialized_view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `isCom`!= 1 and `qustag` = 'specialized';");
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
            // echo $res[qusid]."  ";
        }
      // echo $temp[0]."  ".$temp[1];
      $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `username`,`qustitle`,`qusinfo`from qus where qusid = {$value} and `isCom`!= 1;");
      $row = mysqli_fetch_array($result);
      if(!$row){
        $oq["qustitle"]=null;
        $oq["qusinfo"]=null;
        $oq["username"]=null;
      }
      else{
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
      }
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="other_view"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `isCom`!= 1 and `qustag` = 'other';");
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
            // echo $res[qusid]."  ";
        }
      // echo $temp[0]."  ".$temp[1];
      $qusnum = mysqli_num_rows($result);
      foreach ($temp as $value) {
      $result = mysqli_query($con,"SELECT `username`,`qustitle`,`qusinfo`from qus where qusid = {$value} and `isCom`!= 1;");
      $row = mysqli_fetch_array($result);
      if(!$row){
        $oq["qustitle"]=null;
        $oq["qusinfo"]=null;
        $oq["username"]=null;
      }
      else{
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
      }
      $listJson[]=$oq;
      }
      echo json_encode($listJson);
  }
  return;
}

if($request=="accept")
{
  $username=$_SESSION["username"];
  $thisqusid=$_SESSION["thisqusid"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
    $result = mysqli_query($con,"UPDATE qus SET helper = '{$username}' ,isCom = 1 where qusid = {$thisqusid};");
      echo json_encode(array("success"=>1,"error"=>0));
      return ;

  }
}

if($request=="details")
{
  $qustitle=$_POST["qustitle"];
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      echo $qustitle;
      $qustitle = strtolower($qustitle);
      echo $qustitle;
    $result = mysqli_query($con,"SELECT qusid from qus where qustitle = '{$qustitle}';");//根据题目相同找到了题号
    $row = mysqli_fetch_array($result);//题号$row
    echo $row;
    echo $row[qusid];
  }
}

if($request=="gotodetails")
{
  $qustitle=$_POST["qustitle"];
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $qustitle = strtolower($qustitle);
      // echo $qustitle;
    $result = mysqli_query($con,"SELECT qusid from qus where qustitle = '{$qustitle}';");//根据题目相同找到了题号
    $row = mysqli_fetch_array($result);//题号$row
    // echo $row[qusid];
    $_SESSION["thisqusid"]= $row[qusid];
    echo $_SESSION["thisqusid"];
  }
}

if($request=="viewdetails") 
{
  // $qustitle=$_POST["qustitle"];
  $username=$_SESSION["username"];
  $thisqusid=$_SESSION["thisqusid"];
  // echo $thisqusid;
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
    $result = mysqli_query($con,"select qustitle,qusinfo,qustime,qusloca,username,qustel from qus where qusid = {$thisqusid};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$row["username"]}';");
      $row2 = mysqli_fetch_array($result2);
      echo json_encode(array("qustitle"=>$row[qustitle],"qusinfo"=>$row[qusinfo],"qustel"=>$row[qustel],"qusloca"=>$row[qusloca],"qustime"=>$row[qustime],"username"=>$row[username],"pic"=>$row2[userpic]));
      return ;

  }
}


if($request=="mypublish"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid`FROM qus WHERE `username`= '{$username}';");
      $qusnum = mysqli_num_rows($result);
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
        }
      foreach ($temp as $value) {
        // echo $value;
      $result = mysqli_query($con,"SELECT `qustitle`,`qusinfo`,`qustel`,`qusloca`,`over`,`qustime`,`helper` from qus where qusid = {$value};");
      $row = mysqli_fetch_array($result);
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$row["helper"]}';");
      $row2 = mysqli_fetch_array($result2);
      if(!$row2["userpic"]){
        $oq["pic"]="images/f2.jpg";
      }
      else{
        $oq["pic"]=$row2["userpic"];
      }
      if(!$row["helper"]){
        $oq["qustel"]=null;   
        // $oq["qusloca"]=$row["qusloca"];   
        $oq["qustime"]=$row["qustime"];
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]="目前无人接受。";
        $oq["over"]=$row["over"];
      }
      else{
        // echo $row["helper"]." ";
        $result1 = mysqli_query($con,"SELECT `usertel` from user where `username` = '{$row["helper"]}';");
        $row1 = mysqli_fetch_array($result1);
        $oq["qustel"]=$row1["usertel"];  
        // $oq["qusloca"]=$row["qusloca"];   
        $oq["qustime"]=$row["qustime"];
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["helper"];
        $oq["over"]=$row["over"];
      }
      $listJson[]=$oq;
      }
      // echo json_encode(array("qusnum"=>$qusnum));
      echo json_encode($listJson);
  }
  return;
}

if($request=="competeTaskS"){
  $qustitle=$_POST["qustitle"];
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $qustitle = strtolower($qustitle);
    $result = mysqli_query($con,"SELECT qusid from qus where qustitle = '{$qustitle}';");//根据题目相同找到了题号
    $row = mysqli_fetch_array($result);//题号$row
    $thisqusid = $row["qusid"];
    $result = mysqli_query($con,"UPDATE qus SET `over`=1,`succ`=1 where `qusid`={$thisqusid};");//成功完成，积分转移
    $result = mysqli_query($con,"SELECT `over` from qus where `qusid`={$thisqusid};");//成功完成，积分转移
      if(!mysqli_fetch_array($result)){
      echo json_encode(array("isUpdate"=>0));
      return;
      } 
      else{
      echo json_encode(array("isUpdate"=>1));
      return;
      }
  }
}

if($request=="competeTaskE"){
  $qustitle=$_POST["qustitle"];
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
    $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $qustitle = strtolower($qustitle);
    $result = mysqli_query($con,"SELECT qusid from qus where qustitle = '{$qustitle}';");//根据题目相同找到了题号
    $row = mysqli_fetch_array($result);//题号$row
    $thisqusid = $row["qusid"];
    $result = mysqli_query($con,"DELETE FROM qus where qusid = {$thisqusid};");
    $result = mysqli_query($con,"SELECT qusid FROM qus where qusid = {$thisqusid};");
      if(!mysqli_num_rows($result)){
      echo json_encode(array("isUpdate"=>1));
      return;
      } 
      else{
      echo json_encode(array("isUpdate"=>0));
      return;
      }
  }
}

if($request=="myrec"){
  $username=$_SESSION["username"];
  if(!$username){
    echo json_encode(array("isLogin"=>0));  
  }
  else{
      $con = new mysqli($dbip,$usn,$psw,$dbname);
      mysqli_query($con,"SET NAMES 'UTF8'");
      $result=mysqli_query($con,"SELECT `qusid` FROM qus WHERE `helper`= '{$username}';");
      $qusnum = mysqli_num_rows($result);
      $temp=array();
      while($res=mysqli_fetch_assoc($result)) {
            $temp[]=$res[qusid];
        }
      foreach ($temp as $value) {
        // echo $value;
      $result = mysqli_query($con,"SELECT `qustitle`,`qusinfo`,`qustel`,`qusloca`,`over`,`qustime`,`username` from qus where qusid = {$value};");
      $row = mysqli_fetch_array($result);
        // echo $row["helper"]." ";
      $result2 = mysqli_query($con,"SELECT `userpic` from user where username = '{$row["username"]}';");
      $row2 = mysqli_fetch_array($result2);
      if(!$row2["userpic"]){
        $oq["pic"]="images/f2.jpg";
      }
      else{
        $oq["pic"]=$row2["userpic"];
      }
        $oq["qustel"]=$row["qustel"];  
        $oq["qusloca"]=$row["qusloca"];   
        $oq["qustime"]=$row["qustime"];
        $oq["qustitle"]=$row["qustitle"];
        $oq["qusinfo"]=$row["qusinfo"];
        $oq["username"]=$row["username"];
        $oq["over"]=$row["over"];
      $listJson[]=$oq;
      }
      // echo json_encode(array("qusnum"=>$qusnum));
      echo json_encode($listJson);
  }
  return;
}



?>  