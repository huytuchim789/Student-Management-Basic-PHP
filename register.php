<!DOCTYPE html>
<html>
<head>
    <title>Login form</title>
</head>
<body>
<?php require ("registerController.php"); ?>
<form  method="post">
    <table>
        <tr>
            <td>Username</td>
            <td> <input type="text" name="username"></td>
            <td> <?php echo isset($_POST['username'])?$_SESSION['error']['username']:'' ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td> <input type="password" name="password"></td>
            <td> <?php echo isset($_POST['password'])?$_SESSION['error']['password']:'' ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td> <input type="text" name="email"></td>
            <td> <?php echo isset($_POST['email'])?$_SESSION['error']['email']:'' ?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td> <input type="text" name="phone"></td>
            <td> <?php echo isset($_POST['phone'])?$_SESSION['error']['phone']:'' ?></td>
        </tr>
        <tr>
            <td>Level</td>
            <td>
                <select name="level">
                    <option value="1">Quản trị</option>
                    <option value="0">Thành viên</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="register" value="Đăng ký" style="alignment: center" onsubmit=" <?php echo empty($_SESSION['error']?true:false)?>"></td>
        </tr>
    </table>

</form>
</body>
</html>
