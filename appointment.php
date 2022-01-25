<?php
include "admin_gt7751/pages/__includes/config.php";
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;
//
//require 'vendor/autoload.php';
//require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
//require 'vendor/phpmailer/phpmailer/src/SMTP.php';
//require 'vendor/phpmailer/phpmailer/src/Exception.php';


$response = json_encode(array("code"=>0, "content" => "Error system", "err_param" => ''));

if($_POST)
{
    $_POST = array_map("strip_tags", $_POST);
    extract($_POST);

    $appointment = intval($appointment);

    if(strlen($name)<2)
        $response = json_encode(array("code"=>0, "content" => "Error name", "err_param" => 'name'));
    elseif(strlen($phone)<4 || !filter_var($phone, FILTER_SANITIZE_NUMBER_INT))
        $response = json_encode(array("code"=>0, "content" => "Error phone", "err_param" => 'phone'));
    elseif(!$appointment_type > 1)
        $response = json_encode(array("code"=>0, "content" => "Error appointment_type", "err_param" => 'appointment_type'));
    elseif(!$checkup_type > 1)
        $response = json_encode(array("code"=>0, "content" => "Error checkup_type", "err_param" => 'checkup_type'));
    elseif(strlen($message)<10)
            $response = json_encode(array("code"=>0, "content" => "Error mesagge", "err_param" => 'message'));
    else
    {
        //Create a new PHPMailer instance
//        $mail = new PHPMailer();                              // Passing `true` enables exceptions
        try {

            //Server settings
//            $mail->SMTPDebug = 3;                                 // Enable verbose debug output
//            $mail->isSMTP();                                      // Set mailer to use SMTP
//            $mail->Host = 'smtp.yandex.com';  // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                               // Enable SMTP authentication
//            $mail->Username = 'fuad.hasanli@yandex.com';                 // SMTP username
//            $mail->Password = '159357fh!)(';                           // SMTP password
//            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//            $mail->Port = 587;                                    // TCP port to connect to
//
//            //Recipients
//            $mail->setFrom('fuad.hasanli@yandex.com', 'Contact');
//            $mail->addAddress('fhesenli92@gmail.com', 'Vusal');     // Add a recipient
//            $mail->addReplyTo($email, $name);
//
//            //Content
//            $mail->isHTML(true);                                  // Set email format to HTML
//            $mail->Subject = $subject;
//            $mail->AltBody = 'Test message.';
//
//            $message = "Ad : ".$name."<br />
//                        Email : ".$email."<br />
//                        Phone : ".$phone."<br />
//                        Title : ".$subject."<br />
//                        Mesaj : ".$message."<br /><br />";
//
//            $mail->Body    = $message;
            $date = date("Y-m-d H:i:s");

            $insert = mysqli_query($db,"insert into `appointment_users` (`name`,`phone`,`subject`,`email`,`message`,`datetime`,`checkup_id`, `appointment_type`) values ('$name','$phone','$subject','$email','$message', '$date', '$checkup_type', '$appointment_type')");

            if(/*$mail->send()*/ $insert)
            {
                $response = json_encode(array("code"=>1, "content" => "Success", "err_param" => ''));
            }
            else
            {
//                echo $mail->ErrorInfo;
                $response = json_encode(array("code"=>0, "content" => "Error", "err_param" => ''));
            }
            

        } catch (Exception $e) {
            echo $e->getMessage(); exit;
            $response = json_encode(array("code"=>-1, "content" => "Try again", "err_param" => ''));
        }
    }
}

echo $response;
?>
