<?php

session_start();
require_once('PHPMailer.php');

$dbc = mysqli_connect('localhost', 'root', 'root', 'trial') or die('Error connecting to MySQL server.');

    if(isset($_FILES['cv']) && isset($_FILES['grade_card'])) {
      $file_name_cv = $_FILES['cv']['name'];
      $file_tmp_cv = $_FILES['cv']['tmp_name'];
        
    $file_name_grade_card = $_FILES['grade_card']['name'];
    $file_tmp_grade_card = $_FILES['grade_card']['tmp_name'];
    


$name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
$cgpa = $_SESSION['cgpa'];

$to['email'] = "thecompany@gmail.com";      
$to['name'] = "name";   
$subject = "Application for Placement";
$str = <<<MULTI_LINE_STRING
Name: $name<br />
CGPA: $cgpa</br />
MULTI_LINE_STRING;
$mail = new PHPMailer;
$mail->IsSMTP();                                     
$mail->SMTPAuth = false;
$mail->SMTPDebug = 0;
$mail->Host = 'localhost';
$mail->Port = 6666;
$mail->Username = 'suhas';
$mail->Password = '#password';
$mail->From = $_SESSION['email'];
$mail->FromName = "Any Name";
$mail->AddReplyTo($_SESSION['email'], $_SESSION['first_name'] . ' ' . $_SESSION['last_name']); 
$mail->AddAddress($to['email'], $to['name']);
$mail->Priority = 1;
$mail->AddCustomHeader("X-MSMail-Priority: High");
$mail->WordWrap = 50;    
$mail->IsHTML(true);  
$mail->Subject = $subject;
$mail->Body    = $str;
           
$mail->AddAttachment($file_tmp_cv, $file_name_cv);
$mail->AddAttachment($file_tmp_grade_card, $file_name_grade_card);
 
if(!($x = $mail->Send())) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;                        

}
$mail->ClearAddresses();

        }
header('Location: user_company.php?message=applied')
        
?>