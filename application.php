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

}
        td {
            padding: 8px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            align-self: center;
        }
        body{
            background-color: grey;
        }

        tr:hover {background-color: #f5f5f5;}
    </style>

<?php
    $company_id = $_GET['company_id'];
    echo <<<MULTI_LINE_STRING
    </table><br><br><br><br><br><br><br><center>Please Upload your CV and Grade Sheet to apply</center><fieldset>
    <form enctype="multipart/form-data" action="apply2.php" method="POST">
    NAME: <input type="text" name="name" placeholder="name" required><br>
    ID.NO:<input type="text" name="id" placeholder="ID" required><br>
    COMPANY: <input type="text" name="company" placeholder="applying for company" required><br>
        <label>CV</label>
        <input type="file" name="cv" /><br /><br/>
        <label>Grade Card</label>
        <input type="file" name="grade_card" /><br /><br/>
        <button class="myButton" type="submit">Apply</button>
    </fieldset></form>
</div>
MULTI_LINE_STRING;

?>
