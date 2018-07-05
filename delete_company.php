<?php

session_start();

if (!(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true)) {
    header('Location: admin_login.php');
}

?>
<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$id = $_GET['id'];
$query = "DELETE FROM companies WHERE id='$id'";
mysqli_query($dbc, $query);
echo 'Companies was deleted successfully.';

mysqli_close($dbc); 

?>