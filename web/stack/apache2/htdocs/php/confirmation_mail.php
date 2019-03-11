<?php
require('../include/connect.php');
if(isset($_POST["email"]))
{
    //session_cache_limiter('nocache');
    //header('Expires: ' . gmdate('r', 0));
    //header('Content-type: application/json');
    require_once('../include/PHPMailer/PHPMailerAutoload.php');
        
    $name=$_POST["name"];

    $email=$_POST["email"];
    $password = $_POST["password"];
    $subject="OKAYSWISS booking confirmation";
    $pickup_area = $_POST['pickup_area'];
    $drop_area = $_POST['drop_area'];
    $pickup_date_time = $_POST['pickup_date_time'];
    $taxi_type = $_POST['taxi_type'];
    $km = $_POST['km'];
    $approx_time = $_POST['approx_time'];
    $amount = $_POST['amount'];
    $person = $_POST['person'];
    $adult = $_POST['adult_13plus'];
    $child_13 = $_POST['child_13less'];
    $child_7 = $_POST['child_7less'];
    $infant = $_POST['infant_1less'];

    $body='<table width="100%" style="background-color:#FFF8DC"><tr><th colspan="8" align="center" style="background-color:#FFB94E;"><img src="http://okayswiss.ch/cms/upload/email-logo.png"/></th><tr><td colspan="8" style="padding:10px">Hello '.$name.',<br/><br/>Your booking has been successfully confirmed.</td></tr><tr><td colspan="8" style="background-color:#eee;padding:10px;">A summary of your confirmed booking is shown below.</td></tr><tr><td colspan="8" style="padding:10px"><table width="100%"><tr><th align="left" style="with:50%;display:inline-block;">Pickup Address</th><th align="left" style="width:49%;">Destination Address</th></tr><tr><td style="display:inline-block;width:50%;">'.$pickup_area.'</td><td style="width:49%;">'.$drop_area.'</td></tr></table></td></tr><tr><td colspan="8" style="padding:10px"><table width="100%"><tr style="background-color:#FFB94E"><th style="width:20%">Pickup Date and Time</th><th style="width:10%">Taxi Type</th><th style="width:5%">KM</th><th style="width:15%">Approx Time</th><th style="width:10%">Total Person</th><th style="width:8%">Adult(13+)</th><th style="width:8%">Child(-13)</th><th style="width:8%">Child(-7)</th><th style="width:8%">Infant(-1)</th><th style="width:8%">Amount</th></tr><tr><td align="center" style="width:20%">'.$pickup_date_time.'</td><td align="center" style="width:10%">'.$taxi_type.'</td><td align="center" style="width:5%">'.$km.'</td><td align="center" style="width:15%">'.$approx_time.'</td><td align="center" style="width:10%">'.$person.'</td><td align="center" style="width:8%">'.$adult.'</td><td align="center" style="width:8%">'.$child_13.'</td><td align="center" style="width:8%">'.$child_7.'</td><td align="center" style="width:8%">'.$infant.'</td><td align="center" style="width:8%">'.$amount.'</td></tr></table></td></tr><tr><td colspan="8" align="right" style="padding:10px">Sub Total: '.$amount.'<br/>Total: '.$amount.'</td></tr><tr><td colspan="8" style="padding:10px">If you are facing any problems let us know on noreplyokayswiss@gmail.com<br/></td></tr><tr><td colspan="8" align="center" style="background-color:#FFB94E;padding:10px;">www.okayswiss.ch<br/>For any further assistance please contact us on noreplyokayswiss@gmail.com</td></tr></table>';

    $mail = new PHPMailer();
    $mail->IsSMTP(); // we are going to use SMTP
    //$mail->SMTPDebug = 3;
    $mail->SMTPAuth   = true; // enabled SMTP authentication
    $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
    $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
    $mail->Port       = 587;                   // SMTP port to connect to GMail
    $mail->Username   = "noreplyokayswiss@gmail.com";  // user email address
    $mail->Password   = "Welcometis1";            // password in GMail
    $mail->SetFrom('noreplyokayswiss@gmail.com', 'Ok Swiss');  //Who is sending the email
    $mail->AddReplyTo("noreplyokayswiss@gmail.com","OK Swiss");  //email address that receives the response
    $mail->Subject    = $subject;
    $mail->Body      = $body;
    $mail->AltBody    = "OKSWISS New Mail";
    $mail->AddAddress($email, $name);

    //$mail->AddAttachment("images/phpmailer.gif");      // some attached files
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
    if(!$mail->Send()) {
        echo '{"message":"Email Not Sent Successfully","data":'.json_encode($mail->ErrorInfo).',"success":' . json_encode('false') .'}';
    } else {
        $sql ="SELECT * FROM userdetails where email='".$_POST['email']."'";
        $query = mysql_query($sql) or die("query failed");
        if (mysql_num_rows($query) == 0) {
            $email=$_POST["email"];
            $subject="OKAYSWISS Username and Password";
            $body='<table width="100%" style="background-color:#FFF8DC"><tr><th align="center" style="background-color:#FFB94E;"><img src="http://okayswiss.ch/cms/upload/email-logo.png"/></th><tr><td colspan="8" style="padding:10px">Hello '.$name.',<br/><br/>Your account with OKAYSWISS has been successfully created.</td></tr><tr><td style="background-color:#eee;padding:10px;">A summary of your account is shown below.</td></tr><tr><td style="padding:10px"><table width="100%" style="border:1px solid #000"><tr><td style="padding:10px;border:1px solid #000" align="right"><strong>Email ID:</strong></td><td style="padding:10px;border:1px solid #000"><strong>'.$email.'</strong></td></tr><tr><td style="padding:10px;border:1px solid #000" align="right"><strong>Password:</strong></td><td style="padding:10px;border:1px solid #000">'.$password.'</td></tr></table></td></tr><tr><td align="center" style="background-color:#FFB94E;padding:10px;">www.okayswiss.ch<br/>For any further assistance please contact us on noreplyokayswiss@gmail.com</td></tr></table>';
            $mail = new PHPMailer();
            $mail->IsSMTP(); // we are going to use SMTP
            //$mail->SMTPDebug = 3;
            $mail->SMTPAuth   = true; // enabled SMTP authentication
            $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
            $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
            $mail->Port       = 587;                   // SMTP port to connect to GMail
            $mail->Username   = "noreplyokayswiss@gmail.com";  // user email address
            $mail->Password   = "Welcometis1";            // password in GMail
            $mail->SetFrom('noreplyokayswiss@gmail.com', 'Okay Swiss');  //Who is sending the email
            $mail->AddReplyTo("noreplyokayswiss@gmail.com","Okay Swiss");  //email address that receives the response
            $mail->Subject    = $subject;
            $mail->Body      = $body;
            $mail->AltBody    = "OKSWISS New Mail";
            $mail->AddAddress($email, $name);
            if(!$mail->Send()) {
                echo '{"message":"Email Not Sent Successfully","data":'.json_encode($mail->ErrorInfo).',"success":' . json_encode('false') .'}';
            }
            else{
                echo '{"message":"Email Sent Successfully","success":' . json_encode('true') .'}';
            }
        }
        else{
            echo '{"message":"Email Sent Successfully","success":' . json_encode('true') .'}';
        }
    }
}
else
{
    echo '{"message":"Email Sent Not Successfully","success":' . json_encode('false') .'}';
}
?>