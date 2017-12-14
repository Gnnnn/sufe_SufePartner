<?php  
 session_start();
$GLOBALS['dbip'] = '**';
$GLOBALS['usn'] = '**';
$GLOBALS['psw'] = '**';
$GLOBALS['dbname'] = '**';

        $username = $_POST["username"];  
        $password = $_POST["password"];  
        $usertel = $_POST["usertel"];  
        // echo $username." ".$password." ".$usertel;
        if($username == "" || $password == ""|| $usertel=="")  
        {  
            echo "<script>alert('请确认信息完整性'); </script>";  
        }  //请确认信息完整性history.go(-1);
        else
        {   
                $con = new mysqli($dbip,$usn,$psw,$dbname);
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
?>  