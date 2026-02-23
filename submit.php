<?php

header('Content-Type: application/json');

require_once 'config.php';

$yourEmail = $config['email'];
$yourName = $config['name'];
$cvFile = $config['cv_path'];

$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

$subject = 'Someone requested your CV';
$message = "Someone requested your CV.\n\nEmail: " . $email . "\nTime: " . $timestamp;
$headers = 'From: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n";

$mailSent = @mail($yourEmail, $subject, $message, $headers);

$cvFile = $cvFile;
if (file_exists($cvFile)) {
    $requesterSubject = 'Here is my CV - ' . $yourName;
    $requesterMessage = "Hi,\n\nThank you for your interest! Please find my CV attached.\n\nBest regards,\n" . $yourName;
    $requesterHeaders = 'From: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n";
    
    // Attachment code - commented out for now
    
    $boundary = md5(uniqid(time()));
    $requesterHeaders = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n";
    $requesterHeaders .= "MIME-Version: 1.0\r\n";
    $requesterHeaders .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $requesterMessage . "\r\n\r\n";
    
    $fileContent = chunk_split(base64_encode(file_get_contents($cvFile)));
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: application/pdf; name=\"cv.pdf\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment; filename=\"cv.pdf\"\r\n\r\n";
    $body .= $fileContent . "\r\n\r\n";
    $body .= "--$boundary--";
    
    $requesterSent = @mail($email, $requesterSubject, $body, $requesterHeaders);
} else {
    $requesterSent = false;
}

echo json_encode([
    'success' => true,
    'message' => 'Email sent successfully',
    'debug' => [
        'file_written' => $fileWritten ?? false,
        'mail_sent' => $mailSent,
        'requester_sent' => $requesterSent,
        'cv_file_exists' => file_exists($cvFile),
        'cv_file_path' => $cvFile,
        'requester_error' => $requesterSent ? null : error_get_last(),
        'server' => $_SERVER['HTTP_HOST']
    ]
]);
