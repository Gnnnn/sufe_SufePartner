<?php
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
      // php pic start
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);     // 获取文件后缀名
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2048000)   // 
        && in_array($extension, $allowedExts)) //in_array（1,2）函数，判断1是否在2里
        {
          if ($_FILES["file"]["error"] > 0)
          {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
          }
          else
          {
            // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
            // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
            // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
            
            // 判断当期目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("../upload/" . $_FILES["file"]["name"]))
            {
              $picurl = "upload/" . $_FILES["file"]["name"];
              // echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
              // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
              move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
              $picurl = "upload/" . $_FILES["file"]["name"];
              // echo $picurl."  ";
              // echo "文件存储在: " . "../upload/" . $_FILES["file"]["name"];
            }
          }
        }
        else
        {
          // echo "非法的文件格式";
        }
            $con = new mysqli($dbip,$usn,$psw,$dbname);
             mysqli_query($con, "set names UTF8"); 
            $title = $_POST['Title'];
            $details = $_POST['details'];
            $result = mysqli_query($con,"select title,details from qus2 where title = '$title'");  
            if (!$result) {
            printf("Error:%s\n",mysqli_error($con));
            exit();
            }
            $num = mysqli_num_rows($result); 
            if(!$num)  
            {  
                $d=strtotime("2017-12-14 10:38pm");
                $showtime = date("Y-m-d h:i:sa", $d);
                $res_insert = mysqli_query($con,"INSERT into qus2 SET `picurl` = '{$picurl}',`username`= '{$username}',`time` = '{$showtime}',title = '{$title}',details = '{$details}';");  
                $result = mysqli_query($con,"select qus2id from qus2 where title = '$title'");  
                  if(!mysqli_num_rows($result)){
                  // echo json_encode(array("isUpdate"=>0));
                  echo "<script>alert('发布失败！'); history.go(-1);window.location.reload();</script>";
                  return;
                  } 
                  else{
                  // echo json_encode(array("isUpdate"=>1));
                  echo "<script>alert('发布成功！'); history.go(-1);window.location.reload();</script>";
                  // echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                  return;
                  } 
            }  
            else  
            {  
                echo "<script>alert('题目重复,请先搜索.');window.location.reload();</script>";  
                return;
            }  
}  

?>