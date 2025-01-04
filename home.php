<?php 
include("connect.php");
if(isset($_REQUEST["del"]))
{
    $id = $_REQUEST["del"];
    $delete = "DELETE FROM reg where id='$id'";
    $qry = sqlsrv_query($conn, $delete);
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
    <table border="1" align="center" cellpadding='5' cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php
            $sel = "SELECT * FROM reg order by username";
            $qry = sqlsrv_query($conn, $sel);
            while($row = sqlsrv_fetch_array( $qry, SQLSRV_FETCH_ASSOC))
            { 
        ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["password"]; ?></td>
            <td><a href="reg.php?ed=<?php echo $row["id"]; ?>">Edit</a>|<a href="home.php?del=<?php echo $row["id"]; ?>">Delete</a></td>
        </tr>
        <?php
            } 
        ?>
    </table>
</body>
</html>