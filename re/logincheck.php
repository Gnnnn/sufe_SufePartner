<?
session_start();

$GLOBALS['dbip'] = '**';
$GLOBALS['usn'] = '**';
$GLOBALS['psw'] = '**';
$GLOBALS['dbname'] = '**';

header("Content-type: text/html; charset=utf-8");  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
        }  
        else  
        { 
            $con = new mysqli($dbip,$usn,$psw,$dbname);
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
                // echo "<script>$(".login").hide();</script>"; 
                // echo "this is session";
                // echo $_SESSION["username"];  
                echo "<script>self.location='../index.html';</script>"; 
            }  
            else  
            {  
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
            }  
        }  
 
  
?>  