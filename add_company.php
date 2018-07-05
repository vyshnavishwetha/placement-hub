<?php

session_start();

if (!(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true)) {
    header('Location: admin_login.php');
}

?>
<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

    if(isset($_FILES['notice'])) {
      $file_name = $_FILES['notice']['name'];
    $file_tmp = $_FILES['notice']['tmp_name'];
      $title = $_POST['title'];
        $branch = $_POST['branch'];
        $mincgpa = $_POST['mincgpa'];
$query = "INSERT INTO companies VALUES (NULL, '$title', '$file_name', '$branch', '$mincgpa')";
mysqli_query($dbc, $query) or die ('Error querying database.');        
        move_uploaded_file($file_tmp, "uploads/".$file_name);
         echo "Successfully uploaded file!";
      }
    else {
        echo "Please specify a file!";
    }

mysqli_close($dbc); 
?>