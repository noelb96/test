<?php
function sendAdminMail($to, $name, $email, $phone)
{

    require_once "Mail1.php";

    $from = 'Master of the world <noelboci.nb@gmail.com>';
    $subject="Master of the world";

    $body = "Hi,".$name."\n\n Noel just did the email configuration \n\nThis are your data \n\nUsername: ".$email." Password: ".$phone.".
    Please visit Noel at home and thank him!";


    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );

    $smtp = Mail::factory('smtp', array(
        'host' => 'mail.thewatchshopllc.com',
        'port' => '465',
        'auth' => true,
        'username' => 'stripe@thewatchshopllc.com',
        'password' => 'Polo1951,,,'
    ));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo('<p>' . $mail->getMessage() . '</p>');
//        phpinfo();
    } else {
        echo('<p>Message successfully sent!</p>');
    }
}

?>
