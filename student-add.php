<?php
require ("students.php");
// Nếu người dùng submit form
if (!empty($_POST['add_student']))
{
    // Lay data
    $data['sinhvien_name']        = isset($_POST['name']) ? $_POST['name'] : '';
    $data['sinhvien_gender']         = isset($_POST['gender']) ? $_POST['gender'] : '';
    $data['sinhvien_birthday']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';

    // Validate thong tin
    $errors = array();
    if (empty($data['sinhvien_name'])){
        $errors['sinhvien_name'] = 'Chưa nhập tên sinh vien';
    }

    if (empty($data['sinhvien_gender'])){
        $errors['sinhvien_gender'] = 'Chưa nhập giới tính sinh vien';
    }
    if (empty($data['sinhvien_birthday'])){
        $errors['sinhvien_birthday'] = 'Chưa nhập năm sinh sinh vien';
    }

    // Neu ko co loi thi insert
    if (!$errors){
        add_student($data['sinhvien_name'], $data['sinhvien_gender'], $data['sinhvien_birthday']);
        // Trở về trang danh sách
        header("location: student-list.php");
    }
}
?>
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
        <form method="post" action="student-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" value="<?php echo !empty($data['sinhvien_name']) ? $data['sinhvien_name'] : ''; ?>"/>
                        <?php if (!empty($errors['sinhvien_name'])) echo $errors['sinhvien_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="gender">
                            <option value="Nam">Nam</option>
                            <option value="Nữ" <?php  echo 'selected'; ?>>Nu</option>
                        </select>
                        <?php if (!empty($errors['sinhvien_gender'])) echo $errors['sinhvien_gender']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td>
                        <input type="text" name="birthday" value="<?php echo !empty($data['sinhvien_birthday']) ? $data['sinhvien_birthday'] : ''; ?>"/>
                        <?php if (!empty($errors['sinhvien_birthday'])) echo $errors['sinhvien_birthday']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>