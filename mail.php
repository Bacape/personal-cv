<?php

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $fname = strip_tags(trim($_POST["first-name"]));
    $lname = strip_tags(trim($_POST["last-name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["contact-text"]);

    // Check that data was sent to the mailer.
    if (empty($fname) OR empty($lname) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Zkontrolujte prosím všechny vyplněné údaje a opakujte odeslání.";
        exit;
    }

    // Set the recipient email address.
    $recipient = "petrbacov@gmail.com";

    // Set the email subject.
    $subject = "Nová zpráva z webu pbacovsky.cz od $fname $lname ";

    // Build the email content.
    $email_content = "Jméno: $fname\n";
    $email_content .= "Přijmení: $lname\n";
    $email_content .= "E-mail: $email\n\n";
    $email_content .= "Zpráva:\n$message\n";

    // Build the email headers.

    $email_headers = 'From:' . $email;
    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Zpráva byla odeslána! Ozvu se Vám.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Chyba, zpráva nebyla odeslána.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "Chyba, zpráva nebyla odeslána.";
}

?>