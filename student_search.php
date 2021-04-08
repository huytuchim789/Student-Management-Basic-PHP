
<html>
<title>This is</title>
<body>
<form action="student_search.php" method="get">
    <input type="text" name="name">
    <input type="submit" name="click" value="CLICK" onsubmit="<?php echo !empty($_POST['name']?true:false);?>">
    <?php echo !empty($error['notfound'])?$error['notfound']:'';?>

</form>
</body>
<?php
if(isset($_REQUEST['click'])){
    $error[]=array();
    $name=isset($_GET['name'])?addslashes($_GET['name']):'';
    if(empty($name)){
        $error['empty']="RỖng";
    }
    else{
        $conn=mysqli_connect('localhost','root','huytu291168','new_schema','3306');
        $query="select * from member where username like '%$name%'";
        $result=mysqli_query($conn,$query);
        $num=mysqli_num_rows($result);
        if($num==0){
            $error['notfound']="Ko tìm thấy";
        }
        else{

            echo "$num phần tử $name;"."<br>";
            echo "<table width='100%' border='1'>";
            while($rows=mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>";
                echo "$rows[id]"."<br>";
                echo "</td>";
                echo "<td>";
                echo "$rows[phone]"."<br>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}?>
</html>
