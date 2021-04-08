<?php

require ("students.php");

// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id){
    $data = get_student($id);
}

// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
    header("location: student-list.php");
}

// Nếu người dùng submit form
if (!empty($_POST['edit_student']))
{
    // Lay data
    $data['sinhvien_name']        = isset($_POST['name']) ? $_POST['name'] : '';
    $data['sinhvien_gender']      = isset($_POST['gender']) ? $_POST['gender'] : '';
    $data['sinhvien_birthday']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['sinhvien_id']          = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate thong tin
    $errors = array();
    if (empty($data['sinhvien_name'])){
        $errors['sinhvien_name'] = 'Chưa nhập tên sinh vien';
    }

    if (empty($data['sinhvien_gender'])){
        $errors['sinhvien_gender'] = 'Chưa nhập giới tính sinh vien';
    }

    // Neu ko co loi thi insert
    if (!$errors){
        edit_student($data['sinhvien_id'], $data['sinhvien_name'], $data['sinhvien_gender'], $data['sinhvien_birthday']);
        // Trở về trang danh sách
        header("location: student-list.php");
    }
}

disconect_db();?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm sinh vien</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Thêm sinh vien </h1>
<a href="student-list.php">Trở về</a> <br/> <br/>
<form method="post" action="student-edit.php?id=<?php echo $data['sinhvien_id']; ?>">
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="name" value="<?php echo $data['sinhvien_name']; ?>"/>
                <?php if (!empty($errors['sinhvien_name'])) echo $errors['sinhvien_name']; ?>
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <select name="gender">
                    <option value="Nam">Nam</option>
                    <option value="Nữ" >Nu</option>
                </select>
                <?php if (!empty($errors['sinhvien_gender'])) echo $errors['sinhvien_gender']; ?>
            </td>
        </tr>
        <tr>
            <td>Birthday</td>
            <td>
                <input type="text" name="birthday" value="<?php echo $data['sinhvien_birthday']; ?>"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="hidden" name="id" value="<?php echo $data['sinhvien_id']; ?>"/>
                <input type="submit" name="edit_student" value="Lưu"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>