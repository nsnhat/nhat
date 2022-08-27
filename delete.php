<?php
$user_name = "root";
$pass = "";
$host = "localhost";
$dbname = "bai4";
$conn = new mysqli($host, $user_name, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
if(isset($_POST['deletedata']))
{

    $delete = $_POST['delete'];
    $fullName = $_POST['fullName'];
    $birth = $_POST['birth'];
    $identity = $_POST['identity'];
    $certificate = $_POST['certificate'];
    $image = $_FILES['image'];

    $term = mysqli_real_escape_string($conn, $_REQUEST["term"]);
    $query = "DELETE FROM student WHERE delete='$delete'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Data Updated"); </script>';
        header("Location:index.php");
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>