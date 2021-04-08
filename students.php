<?php
//tạo biến kết nối toàn cục
global  $conn;
function connect_db(){
    global $conn;
    if(!$conn){
        $conn=mysqli_connect('localhost','root','huytu291168','new_schema','3306') or die('Can\' connect to database');
        //thiet lap font chu ket noi
        mysqli_set_charset($conn,'utf-8');

    }
}
function disconect_db()
{
    global $conn;
    if($conn){
        mysqli_close($conn);
    }
}
function getAllStudents(){
    global $conn;
    connect_db();
    $sql="select * from sinhvien ";
    //thuc hien cau tury van
    $query=mysqli_query($conn,$sql);
    $result=array();
    if($query){
        while($row=mysqli_fetch_assoc($query)) //tra ve tung associated row
            $result[]=$row;
    }
//    $i=0;
//    while($i<mysqli_num_fields($query)){
//        echo "information for column $i:";
//        $meta=mysqli_fetch_field($query);
//        echo $meta->name."<br>";
//        $i++;
//
//    }
    return $result;
}
//echo "<pre>";
//var_dump(getAllStudents());
//echo addslashes("Trần Huy ''Tú");
function get_student($student_id){
    global $conn;
    connect_db();
    $sql="select * from sinhvien where sinhvien_id=$student_id";
    $query=mysqli_query($conn,$sql);
    $result=array();
    if(mysqli_num_rows($query)>0){
        $row=mysqli_fetch_assoc($query);
        $result=$row;
    }
    return $result;
}
function add_student($student_name, $student_gender, $student_birthday)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $student_name = addslashes($student_name);
    $student_gender = addslashes($student_gender);
    $student_birthday = addslashes($student_birthday);

    // Câu truy vấn thêm
    $sql = "INSERT INTO sinhvien(sinhvien_name, sinhvien_gender, sinhvien_birthday) VALUES
            ('$student_name','$student_gender','$student_birthday') ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}


// Hàm sửa sinh viên
function edit_student($student_id, $student_name, $student_gender, $student_birthday)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $student_name       = addslashes($student_name);
    $student_gender        = addslashes($student_gender);
    $student_birthday   = addslashes($student_birthday);

    // Câu truy sửa
    $sql = "
            UPDATE sinhvien SET
            sinhvien_name = '$student_name',
            sinhvien_gender = '$student_gender',
            sinhvien_birthday = '$student_birthday'
            WHERE sinhvien_id = $student_id
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}


// Hàm xóa sinh viên
function delete_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy sửa
    $sql = "
            DELETE FROM sinhvien
            WHERE sinhvien_id = $student_id
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}