<?php
//thiết lập charset-utf8
session_start();
header('Content-type:text/html;charset=utf-8');
$data=array();
$error=array();
$_SESSION['error']=array();
// Vì tên button submit là do-register nên ta sẽ kiểm tra nếu
// tồn tại key này trong biến toàn cục $_POST thì nghĩa là người
// dùng đã click register(submit)
$conn=mysqli_connect('localhost','root','huytu291168','new_schema','3306');
mysqli_set_charset($conn, "utf8");
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}
if(isset($_POST['register'])){
    $data['username']=isset($_POST['username'])?$conn->escape_string($_POST['username']):'';
    $data['password']=isset($_POST['password'])?md5($_POST['password']):'';
    $data['email']=isset($_POST['email'])?$conn->escape_string($_POST['email']):'';
    $data['phone']=isset($_POST['phone'])?$conn->escape_string($_POST['phone']):'';
    $data['level']=isset($_POST['level'])?(int)$_POST['level']:'';

    if(empty($data['username'])){
         $error['username']="Chua nhap vao username";
    }
    if(empty($_POST['password'])){
         $error['password']="Chua nhap vao password";
    }
    if(empty($data['email'])){
        $error['email']="Chua nhap vao email";
    }
    if(empty($data['phone'])){
        $error['phone']="Chua nhap vao sdt";
    }
    $_SESSION['error']=$error;
    if(empty($error)){
    $sql="select * from member where username='$data[username]'";
    echo $sql;
    $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0) {
            echo '<script language="javascript">alert("Thông tin đăng nhập bị sai"); window.location="register.php";</script>';
            // Dừng chương trình
            die ();
        }
        else{
            $sql = "INSERT INTO member (username, password, email, phone, level) VALUES ('$data[username]','$data[password]','$data[email]','$data[phone]', '$data[level]')";

            if (mysqli_query($conn, $sql)){
                echo '<script language="javascript">alert("Đăng ký thành công"); window.location="register.php";</script>';
            }
            else {
                echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
            }
        }
    }
}