<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if ( isset($_POST['email'])) {
        
        $email = $_POST['email'];
        
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "benabbes.mohamedaziz@esprit.tn";
        $mail->Password = '211JMT8737';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("benabbes.mohamedaziz@esprit.tn");
        $mail->Subject = $subject;
        $mail->Body =$htmlContent = file_get_contents("vu.html");


        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
