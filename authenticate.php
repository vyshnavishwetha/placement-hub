


<?php



$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * from login where username='$username'";
$result = mysqli_query($dbc, $query) or die ('Error querying database.');
$row = mysqli_fetch_array($result);

session_start();

if($row['username'] == $username && $row['password'] == $password) {
    header('location: user_company.php');
    $_SESSION['user_logged_in'] = true;
    $_SESSION['cgpa'] = $row['cgpa'];
    $_SESSION['first_name'] = $row['firstname'];
    $_SESSION['last_name'] = $row['lastname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['branch'] =$row['branch'];
}
    else {
    header('Location: login.php?error=invalid_creds');
    }

echo "<br />";




mysqli_close($dbc);
?>
