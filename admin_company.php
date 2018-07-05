<?php

session_start();

if (!(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true)) {
    header('Location: admin_login.php');
}

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="company.css" />
    <style>
        table {
    margin: auto;
    width: 50%;
    border: 3px solid black;
    padding: 10px;
            display:block;
}

        table, th, td {
   border:none;
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
            background-color: #f5f5f5;
        }
        body {
        background-color:darkgrey;
         }
        body {
        background-image: url("admin.jpg");
        background-repeat: no-repeat;
         background-size: cover;
            background-attachment: fixed;
         }

    </style>

<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'it') or die('Error connecting to MySQL server.');

$branches = [
    'MEC',
    'CSE',
    'ECE',
    'PET',
    'EEE',
    'CIV'
];

if (!isset($_GET['brn'])) {

    echo '<ul>';
    foreach ($branches as $branch) {
        echo "<form method='post' action='admin_company.php?brn=$branch'>
    <button class='button'>$branch</button></form></div>";
    }
    echo '</ul>';
}
else {
    $branch = $_GET['brn'];
    $query = "SELECT * from companies where branch='$branch'";
    $result = mysqli_query($dbc, $query) or die ('Error querying database.');
    $rows = mysqli_fetch_all($result);

        echo <<<MULTI_LINE_STRING
    <div style="display: block;">
        <h3 style="background: #fafafa; padding: 8px; margin-bottom: 0px;">$branch</h3>
        <table style="margin-top: 0px;">
        <tr>
        <th>Logo</th>
        <th>Company</th>
        <th>Min. CGPA</th>
        <th>Action</th>
        </tr>
MULTI_LINE_STRING;
        foreach ($rows as $company) {
            $companyId = $company[0];
            $companyTitle = $company[1];
            $companyPath = $company[2];
            $companyBranch = $company[3];
            $mincgpa = $company[4];
            echo <<<MULTI_LINE_STRING
            <tr>
            <td><img width="24px" height="24px" src="uploads/$companyPath" /></d>
            <td><h3>$companyTitle</h3></td>
            <td>$mincgpa</td>
            <td><a href=//"delete_company.php?id=$companyId"><button>Delete</button></a></td>
            </tr>
MULTI_LINE_STRING;
        }
        echo <<<MULTI_LINE_STRING
        </table><fieldset>
        <form enctype="multipart/form-data" action="//add_company.php" method="POST">
            <input style="display: none" value="$branch" name="branch" />
            <label>Title</label>
            <input type="text" name="title" /><br />
            <label>Min CGPA</label>
            <input type="text" name="mincgpa" /><br />
            <input type="file" name="notice" />
            <button class="myButton" type="submit">Add</button>
        </fieldset></form>
    </div>
MULTI_LINE_STRING;
}

mysqli_close($dbc);


?>
