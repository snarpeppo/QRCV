<?php

header('Content-Type: application/json');

require_once 'config.php';

session_start();

function getClientIp() {
    $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'];
    foreach ($ipKeys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = explode(',', $_SERVER[$key])[0];
            return trim($ip);
        }
    }
    return 'unknown';
}

function checkRateLimit($ip, $maxRequests = 5, $windowSeconds = 60) {
    $rateFile = sys_get_temp_dir() . '/qrcv_ratelimit_' . md5($ip);
    $now = time();
    
    if (file_exists($rateFile)) {
        $data = json_decode(file_get_contents($rateFile), true);
        if ($data && $data['expires'] > $now) {
            if ($data['count'] >= $maxRequests) {
                return false;
            }
            $data['count']++;
        } else {
            $data = ['count' => 1, 'expires' => $now + $windowSeconds];
        }
    } else {
        $data = ['count' => 1, 'expires' => $now + $windowSeconds];
    }
    
    file_put_contents($rateFile, json_encode($data));
    return true;
}

function sanitizeString($str, $maxLength = 100) {
    $str = trim($str);
    $str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    return substr($str, 0, $maxLength);
}

$clientIp = getClientIp();

if (!checkRateLimit($clientIp)) {
    echo json_encode(['success' => false, 'message' => 'Too many requests. Please try again later.']);
    exit;
}

$csrfToken = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
$sessionToken = $_SESSION['csrf_token'] ?? '';
if (empty($csrfToken) || empty($sessionToken) || !hash_equals($sessionToken, $csrfToken)) {
    echo json_encode(['success' => false, 'message' => 'Invalid request', 'debug' => [
        'csrf_received' => !empty($csrfToken),
        'csrf_session' => !empty($sessionToken),
        'match' => !empty($csrfToken) && !empty($sessionToken) && hash_equals($sessionToken, $csrfToken)
    ]]);
    exit;
}

$yourEmail = filter_var($config['email'], FILTER_SANITIZE_EMAIL);
$yourName = sanitizeString($config['name']);
$cvFile = filter_var($config['cv_path'], FILTER_SANITIZE_URL);

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$timestamp = date('Y-m-d H:i:s');

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

if (file_exists($cvFile)) {
    $requesterSubject = 'Here is my CV - ' . $yourName;
    $requesterMessage = "Hi,\n\nThank you for your interest! Please find my CV attached.\n\nBest regards,\n" . $yourName;
    $requesterHeaders = 'From: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n";
    
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

// echo json_encode([
//     'success' => true,
//     'message' => 'Email sent successfully',
//     'debug' => [
//         'file_written' => $fileWritten ?? false,
//         'mail_sent' => $mailSent,
//         'requester_sent' => $requesterSent,
//         'cv_file_exists' => file_exists($cvFile),
//         'cv_file_path' => $cvFile,
//         'requester_error' => $requesterSent ? null : error_get_last(),
//         'server' => $_SERVER['HTTP_HOST']
//     ]
// ]);
