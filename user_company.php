<?php

session_start();

if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
}

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="company.css" />
    <style>
        table {
    margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}

        table, th, td {
   border: none;
            color: white;
}
        td {
            padding: 8px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            align-self: center;
        }

        tr:hover {
            background-color: grey;
        }
        body {
        background-color:darkgrey;
         }
        body {
        background-image: url("user1.jpg");
        background-repeat: no-repeat;
         background-size: 1220px;
            background-attachment: fixed;
         }
    </style>

<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$branches = [
    'MEC','CSE',

    'ECE',
    'PET',
    'EEE',
    'CIV'
];
//print_r( $_SESSION);
//echo $_SESSION['branch'];
//$branches = [ $_SESSION['branch'] ];

if (!isset($_GET['brn'])) {
    echo '<ul>';
    foreach ($branches as $branch) {
       echo "<form method='post' action='user_company.php?brn=$branch'>
    <button class='button'>$branch</button></form></div>";
    }
    echo '</ul>';
}
else {
    $cgpa = $_SESSION['cgpa'];

    $brn = $_GET['brn'];
    $query = "SELECT * from companies where branch='$brn'";
    $result = mysqli_query($dbc, $query) or die ('Error querying database.');
    $rows = mysqli_fetch_all($result);

    echo <<<MULTI_LINE_STRING
    <div style="display:block;">
        <table style="margin-top: 0px;">
        <tr>
    <th>Logo</th>
    <th>Company</th>
    <th>Min. CGPA</th>
    <th>Action</th>
        </tr>

MULTI_LINE_STRING;
        foreach ($rows as $row) {
            $companyId = $row[0];
            $companyTitle = $row[1];
            $companyPath = $row[2];
            $mincgpa = $row[4];
            //if ($cgpa < $mincgpa) continue;
            echo <<<MULTI_LINE_STRING
            <tr>
            <td><img width="24px" height="24px" src="uploads/$companyPath" /></td>
            <td><h3>$companyTitle</h3></td>
            <td><span>$mincgpa</span></td>
            <td><a href="application.php?company_id=$companyId"><button>APPLY</button></a>
            </tr>
MULTI_LINE_STRING;
        }

        echo <<<MULTI_LINE_STRING
        </table>
    </div>
MULTI_LINE_STRING;
}

if (isset($_GET['message']) && $_GET['message'] == 'applied') {
    echo 'Your application was successfully sent. Please wait for your response.';
}

mysqli_close($dbc);


?>
