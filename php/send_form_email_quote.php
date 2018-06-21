<?php
if(isset($_POST['email'])) {

    $email_to = "janman74@gmail.com";
    $email_subject = "Quote Request Form Submission";

    function died($error) {
        // your error code can go here
        echo "We are sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    // validation expected data exists
    if( !isset($_POST['name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['city_state']) ||
    !isset($_POST['subject']) ||
    !isset($_POST['monthly']) ||
    !isset($_POST['message']) ) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // required
    $city_state = $_POST['city_state']; // required
    $subject = $_POST['subject']; // required
    $monthly = $_POST['monthly']; // required
    $message = $_POST['message']; // not required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Quote request.\n\n";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }

    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($phone)."\n";
    $email_message .= "City & State: ".clean_string($city_state)."\n";
    $email_message .= "Subject: ".clean_string($subject)."\n";
    $email_message .= "Monthly Kw/hr usage: ".clean_string($monthly)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    // Email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    ?>

    <!-- Personal success message -->

    Thank you for contacting us. We will be in touch with you soon.

    <?php
}
?>
