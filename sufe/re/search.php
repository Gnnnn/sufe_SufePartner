<?php  
 session_start();
     $username=$_SESSION["username"];
      if(!$username){
        echo "<script>self.location='../login.html'</script>";  
      }
      else{
        $searchcontents = $_POST["searchcontents"];    
        $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");//连接数据库
        mysqli_query($con, "set names UTF8");
        $result = mysqli_query($con,"SELECT qus2id from qus2 where title like '%{$searchcontents}%';"); 
        $qusnum = mysqli_num_rows($result);
        // echo $qusnum;
        $temp=array();
        while($res=mysqli_fetch_assoc($result)) {
                $_SESSION[temp]=$res[qus2id];
            }
            echo $_SESSION[temp];
    //       while($res=mysqli_fetch_assoc($result)) {
    //             $temp[]=$res[qus2id];
    //         }
    //       foreach ($temp as $value) {
    //       $result = mysqli_query($con,"SELECT `username`,`title`,`details`,`picurl`,`time`,`helper` from qus2 where qus2id = {$value};");
    //       $row = mysqli_fetch_array($result);
    //       if(!$row){
    //         $oq["username"]=null;   
    //         $oq["title"]=null;
    //         $oq["details"]=null;
    //         $oq["picurl"]=null;
    //         $oq["time"]=null;
    //         $oq["helper"]=null;
    //       }
    //       else{
    //         $oq["username"]=$row["username"];   
    //         $oq["title"]=$row["title"];
    //         $oq["details"]=$row["details"];
    //         $oq["qusinfo"]=$row["qusinfo"];
    //         $oq["helper"]=$row["helper"];
    //         $oq["time"]=$row["time"];
    //       }
    //       $listJson[]=$oq;
    //       } 
    //     echo json_encode($listJson);
    // }
      }
    return ;

?>  