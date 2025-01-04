<?php
include("connect.php"); 
if(isset($_REQUEST["submit"]))
{
    $id = $_REQUEST["id"];
    $uname = $_REQUEST["username"];
    $pass = $_REQUEST["password"];

    $sel = "SELECT * FROM reg where id='$id'";
    $qry = sqlsrv_query($conn, $sel,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    $row_count = sqlsrv_num_rows( $qry);
    if($row_count==1)
    {
        header("location:reg.php?msg");
    }
    else
    {
    $params1 = array($id,$uname,$pass);
    $sql1 = "INSERT INTO reg(id, username, password)VALUES (?, ?, ?)";
    $qry = sqlsrv_query($conn,$sql1,$params1);
    header("location:reg.php");
    }
}
if(isset($_REQUEST["ed"]))
{
    $id = $_REQUEST["ed"];
    $sel = "SELECT * FROM reg where id='$id'";
    $qry = sqlsrv_query($conn, $sel);
    $row = sqlsrv_fetch_array( $qry, SQLSRV_FETCH_ASSOC);
}
if(isset($_REQUEST["update"]))
{
    $id = $_REQUEST["id"];
    $uname = $_REQUEST["username"];
    $pass = $_REQUEST["password"];

    $params1 = array($uname,$pass,$id);

    $sql1 = "UPDATE reg SET username=?, password=? WHERE id=?";
    $qry = sqlsrv_query($conn,$sql1,$params1);
    header("location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 align="center">
        <?php
            if(isset($_REQUEST["msg"]))
            {
                echo "Record Id already exists,please try another";
                header("refresh:3;url='reg.php'");
            } 
        ?>
    </h3>
    <form action="" method="post">
        <table border="1" cellpadding="5" cellspacing="0" align="center">
            <tr>
                <th colspan="2">
                    <?php
                        if(isset($_REQUEST["ed"]))
                        {
                            echo "Update Here";
                        }
                        else
                        {
                            echo "Register Here";
                        } 
                    ?>

                </th>
            </tr>
            <tr>
                <th>Enter Id</th>
                <td><input type="text" name="id" value="<?php if(isset($_REQUEST["ed"])){ echo $row["id"];} ?>"></td>
            </tr>
            <tr>
                <th>Enter Username</th>
                <td><input type="text" name="username" value="<?php if(isset($_REQUEST["ed"])){ echo $row["username"];} ?>"></td>
            </tr>
            <tr>
                <th>Enter Password</th>
                <td><input type="password" name="password" value="<?php if(isset($_REQUEST["ed"])){ echo $row["password"];} ?>"></td>
            </tr>
            <tr>                
                <td colspan="2" align="center">
                    <?php
                        if(isset($_REQUEST["ed"]))
                        { 
                    ?>
                    <input type="submit" name="update" value="Update">
                    <?php
                        }
                        else
                        { 
                    ?>
                    <input type="submit" name="submit" value="Submit">
                    <?php
                        } 
                    ?>
                </td>
            </tr>    
        </table>
    </form>
</body>
</html>