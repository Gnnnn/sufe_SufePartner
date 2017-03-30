<?php  
 session_start();
$request=$_GET["request"];

if($request=="login"){
  $user = $_POST["username"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
        }  
        else  
        { 
            $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");  
             mysqli_query($con, "set names UTF8"); 
            $result = mysqli_query($con,"select username,password from user where username = '$_POST[username]' and password = '$_POST[password]'");  
            if (!$result) {
            printf("Error:%s\n",mysqli_error($con));
            exit();
            }
            $num = mysqli_num_rows($result);  
            if($num)  
            {  
                $row = mysqli_fetch_array($result);  //将数据以索引方式储存在数组中  
                $_SESSION["username"]= $user;
                // echo "this is session";
                // echo $_SESSION["username"];  
                echo "<script>self.location='../index.html';</script>"; 
            }  
            else  
            {  
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
            }  
        }  
}

if($request=="register"){
  $user = $_POST["username"];  
  $psw = $_POST["password"];  
  $tel = $_POST["tel"];  
  if($username == "" || $password == ""|| $usertel=="")  
    {  
        echo "<script>alert('请确认信息完整性'); </script>";  
    }  //请确认信息完整性history.go(-1);
  else
  {   
      $con = new mysqli("59.110.139.81","root","Pypy0101","SufePartner");//连接数据库
      mysqli_query($con, "set names UTF8");
      $res_insert = mysqli_query($con,"insert into user(username,password,usertel) values('$_POST[username]','$_POST[password]','$_POST[usertel]')");  
      if($res_insert)  
      {   
          $_SESSION["username"]= $username;
          echo "<script>alert('注册成功');self.location='../index.html';</script>"; 
      }  //注册成功
      else  
          {  
              echo "<script>alert('系统繁忙，请稍候！'); </script>";  
          }  //系统繁忙，请稍候！  
  } 
        
}

?>  