<?php

$connection=mysqli_connect('localhost','root','root','it');
if (!$connection)
{
    die("Connection error: ".mysqli_connect_error());
}



        echo("<table><tr><th>name of the student </th><th>ID Number</th><th>COMPANY</th></tr>");

$query="select name,id,company from apply";
$run=mysqli_query($connection,$query);
while($td=mysqli_fetch_array($run))
{


    echo("<tr><td>".$td['name']."</td><td>".$td['id']."</td><td>".$td['company']."</td>");
}
echo("</table>");
?>
