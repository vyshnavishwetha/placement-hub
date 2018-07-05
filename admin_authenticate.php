<?php



$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * from admin where username='$username'";
$result = mysqli_query($dbc, $query) or die ('Error querying database.');
$row = mysqli_fetch_array($result);

session_start();
if($row['username'] == $username && $row['password'] == $password){
    header('location: admin_company.php');
    $_SESSION['admin_logged_in']=true;
}else {
    header('Location: admin_login.php?error=invalid_creds');
    }

echo "<br />";




mysqli_close($dbc); 
?>
    

