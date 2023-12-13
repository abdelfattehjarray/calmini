<?php
$id=$_GET["id"];
$prix=$_GET["prix"];
        $email = "abdelmonam.jarray@esprit.tn";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'mail/Exception.php';
    require 'mail/PHPMailer.php';
    require 'mail/SMTP.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'abdelmonam.jarray@esprit.tn';                     // SMTP username
        $mail->Password   = "vppgwdyiodshfyoi";                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('abdelmonam.jarray@esprit.tn', 'Pharmacie Calmini ');
        $mail->addAddress($email);     // Add a recipient

       
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Produit ';
        $mail->Body    =  "your commande has been recommended prix:$prix DT";
       $mail->send();
            echo '';
         
          
          header("Location: medicamentClient.php?id=$id");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }    
          
?>