<?php  
 session_start();
$request=$_GET["request"];

if($request=="tpublish"){
  $username=$_SESSION["username"];
  // echo "session: ".$username;
  if(!$username){
    echo "<script>self.location='../login.html'</script>";  
  }
  else{
      $title = $_POST["title"];  
      $loca = $_POST["loca"];
      $tag = $_POST["tag"];
      $tel = $_POST["tel"];
      $info = $_POST["info"];
      $timee = $_POST["timee"];
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
    $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
    $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
    $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
      $qustitle = strtolower($qustitle);
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
    echo "<script>self.location='../index.html'</script>";  
  }
  else{
    $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");
      mysqli_query($con,"SET NAMES 'UTF8'");
    $result = mysqli_query($con,"select qustitle,qusinfo,qustime,qusloca,username,qustel from qus where qusid = {$thisqusid};");
      $row = mysqli_fetch_array($result);
      echo json_encode(array("qustitle"=>$row[qustitle],"qusinfo"=>$row[qusinfo],"qustel"=>$row[qustel],"qusloca"=>$row[qusloca],"qustime"=>$row[qustime],"username"=>$row[username]));
      return ;

  }
}

?>  