<?php
require ("students.php");
$students=getAllStudents();
disconect_db();
?>
<html>
<header>
    <title>
        Danh sách sinh viên
    </title>
    <meta charset="UTF-8">
</header>
<body>
<h1>Danh sách sinh viên</h1>
<a href="student-add.php">Thêm</a><br> <br>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Gender</td>
        <td>BirthDay</td>
        <td>Options</td>
    </tr>
    <tr>
    <?php foreach ($students as $student){?>
    <td><?php echo $student['sinhvien_id']?></td>
    <td><?php echo $student['sinhvien_name']?></td>
    <td><?php echo $student['sinhvien_gender']?></td>
    <td><?php echo $student['sinhvien_birthday']?></td>
    <td>
        <form method="post" action="student-delete.php">
            <input onclick="window.location='student-edit.php?id=<?php echo $student['sinhvien_id']?>'" type="button" value="Sửa">
            <input type="hidden" name="id" value="<?php echo $student['sinhvien_id']?>">
            <input onclick="return confirm('Bạn có chắc muốn xóa không?')" type="submit" name="delete" value="Xóa">
        </form>
    </td>
    </tr>
    <?php } ?>

</table>
</body>
</html>
