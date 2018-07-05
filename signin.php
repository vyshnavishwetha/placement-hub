<?php



$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$cgpa = $_POST['cgpa'];
$username = $_POST['username'];
$password = $_POST['password'];
$branch = $_POST['branch'];

$query = "SELECT COUNT(*) as count from login where username='$username' or email='$email'";
$result = mysqli_query($dbc, $query) or die ('Error querying database.');
$row = mysqli_fetch_array($result);

if ($row['count'] > 0) {
    echo 'Error: User name or email address already exists.';
}
else {
    mysqli_query($dbc, "INSERT INTO login VALUES ('$firstname', '$lastname', '$email','$cgpa', '$username', '$password','$branch')");
    header('Location: login.php');
}
mysqli_close($dbc);
?>