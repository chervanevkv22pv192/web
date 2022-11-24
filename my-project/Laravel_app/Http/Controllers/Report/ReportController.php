<?php

namespace App\Http\Controllers\Report;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'D:/Programm Files/OSPanel/vendor/phpmailer/phpmailer/src/Exception.php';
require 'D:/Programm Files/OSPanel/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'D:/Programm Files/OSPanel/vendor/phpmailer/phpmailer/src/SMTP.php';


use App\Http\Controllers\Controller;
use App\Models\Account\Account;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportController extends Controller
{
    public function check_email($email){
         $account = Account::query()
             ->where('mail',$email)
             ->first();

         if($account === null){
             return '0';
         }


$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
// Íàñòðîéêè SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$mail->Host = "smtp.mail.ru";
//$mail->Port = 465;
$mail->Username = '@mail.ru';            
$mail->Password = '';            
// Îò êîãî
$mail->setFrom('magastik@mail.ru', 'Pixourse');		
// Êîìó
$mail->addAddress($email, $email);
// Òåìà ïèñüìà
$mail->Subject = 'Notification: No reply';
// Òåëî ïèñüìà
$body = '<b><h4>Âàøà æàëîáà ïðèíÿòà è ñêîðî áóäåò ðàññìîòðåíà!</h4></b>';
$mail->msgHTML($body);
$mail->send();

         return '1';
    }
}
