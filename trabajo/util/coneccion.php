<?php
include('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';
//resivo datos del frm
$msg = $_POST['Mensaje'];
$correo = $_POST['correo'];
$nombre = $_POST['nombre'];

$conectar = conn();
$sql = "INSERT INTO mensaje (nombre,correo,mensaje) VALUES ('$nombre', '$correo', '$msg')";
$resul = mysqli_query($conectar, $sql) or trigger_error("query faild! SQL - Error:" . mysqli_error($conectar), E_USER_ERROR);
/////////////////////////////////////////////
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'trabajoejem@gmail.com';
    $mail->Password   = 'xijqotbqpbsupagu';
    //Recipients
    $mail->setFrom('trabajoejem@gmail.com', 'trabajo');
    $mail->addAddress('maricelakinder3@gmail.com', $nombre);
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'mensage enviado desde la pagina';
    $mail->Body    = $msg;

    $mail->send();
    echo 'se envio corretamente';
    header("Location: ../index.html");
    exit;
} catch (Exception $e) {
    echo "no se envio hay un erro: {$mail->ErrorInfo}";
}
