<?php  
session_start();
$GLOBALS['dbip'] = '****';
$GLOBALS['usn'] = '****';
$GLOBALS['psw'] = '****';
$GLOBALS['dbname'] = 'xcxcketest_com';

$username=$_SESSION["username"];
  if(!$username){
    echo "<script>self.location='../login.html'</script>";  
  }
  else{
    $searchcontents = $_POST["searchcontents"];    
    $con = new mysqli($dbip,$usn,$psw,$dbname);
    mysqli_query($con, "set names UTF8");
    $result = mysqli_query($con,"SELECT qus2id from qus2 where title like '%{$searchcontents}%';"); 
    $qusnum = mysqli_num_rows($result);
    // echo $qusnum;
    $temp=array();
    while($res=mysqli_fetch_assoc($result)) {
            $_SESSION[temp]=$res[qus2id];
        }
        echo $_SESSION[temp];
  }
return ;

?>  