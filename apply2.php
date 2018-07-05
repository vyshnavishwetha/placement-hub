<?php



$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$name = $_POST['name'];
$id= $_POST['id'];
$company = $_POST['company'];

//$query = "SELECT COUNT(*) as count from login where name='$name'";
//$result = mysqli_query($dbc, $query) or die ('Error querying database.');
$row = mysqli_fetch_array($result);

if ($row['count'] > 0) {
    echo 'Error: User name or email address already exists.';
}
else {
    mysqli_query($dbc, "INSERT INTO apply VALUES ('$name', '$id', '$company')");
    header('Location: display.php');
}
mysqli_close($dbc);
?>
