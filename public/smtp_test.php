
<?php

$host = 'smtp.zeptomail.com';
$port = 465;

$username = 'emailappsmtp.3f75947dd69b1f88';
$password = 'ctK2dw1j49Mj';

$from = 'noreply@pllohide.ca';
$to   = 'web.lokesh@gmail.com';

$subject = 'ZeptoMail SMTP Test';
$message = '
<html>
<body>
    <h2>SMTP Test Successful!</h2>
    <p>Your ZeptoMail SMTP configuration is working correctly.</p>
</body>
</html>
';

function getResponse($socket)
{
    $response = '';

    while (($line = fgets($socket, 515)) !== false) {
        $response .= $line;

        if (preg_match('/^\d{3} /', $line)) {
            break;
        }
    }

    return $response;
}

function smtpCommand($socket, $command, $expected)
{
    fwrite($socket, $command . "\r\n");
    $response = getResponse($socket);

    if (substr($response, 0, 3) !== (string)$expected) {
        throw new Exception("SMTP Error: " . $response);
    }

    return $response;
}

try {

    // Connect using SSL
    $socket = fsockopen(
        "ssl://" . $host,
        $port,
        $errno,
        $errstr,
        30
    );

    if (!$socket) {
        throw new Exception("Connection failed: $errstr ($errno)");
    }

    stream_set_timeout($socket, 30);

    echo "Connected to SMTP server<br>";

    getResponse($socket);

    smtpCommand($socket, "EHLO localhost", 250);

    // Authentication
    smtpCommand($socket, "AUTH LOGIN", 334);
    smtpCommand($socket, base64_encode($username), 334);
    smtpCommand($socket, base64_encode($password), 235);

    echo "SMTP Authentication successful<br>";

    // Sender
    smtpCommand($socket, "MAIL FROM:<$from>", 250);

    // Recipient
    smtpCommand($socket, "RCPT TO:<$to>", 250);

    // Email Data
    smtpCommand($socket, "DATA", 354);

    $headers  = "From: $from\r\n";
    $headers .= "To: $to\r\n";
    $headers .= "Subject: $subject\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $email = $headers . "\r\n" . $message;

    // Escape SMTP dot-stuffing
    $email = preg_replace('/(?m)^\./', '..', $email);

    fwrite($socket, $email . "\r\n.\r\n");

    $response = getResponse($socket);

    if (substr($response, 0, 3) !== '250') {
        throw new Exception("Email sending failed: " . $response);
    }

    echo "<h3 style='color:green;'>Email sent successfully!</h3>";

    smtpCommand($socket, "QUIT", 221);

    fclose($socket);

} catch (Exception $e) {

    echo "<h3 style='color:red;'>SMTP Failed!</h3>";
    echo htmlspecialchars($e->getMessage());

    if (isset($socket) && is_resource($socket)) {
        fclose($socket);
    }
}
?>
