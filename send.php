<?php
$apiKey = 're_W9gDRvwU_HrHdqGzKKrvAUkG4wy4tca8y'; // Replace with your real key
$from = 'Acme <onboarding@resend.dev>';

$emailInput = $_POST['emails'] ?? '';
$subject = $_POST['subject'] ?? '';
$body = $_POST['body'] ?? '';

if (empty($emailInput) || empty($subject) || empty($body)) {
    exit("Missing required input.");
}

// Split the string into an array and clean whitespace
$emailArray = array_filter(array_map('trim', explode(',', $emailInput)));

if (empty($emailArray)) {
    exit("No valid email addresses found.");
}

// Build batch
$batch = array_map(function($email) use ($from, $subject, $body) {
    return [
        'from' => $from,
        'to' => [$email],
        'subject' => $subject,
        'html' => $body
    ];
}, $emailArray);

// Send to Resend
$ch = curl_init('https://api.resend.com/emails/batch');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($batch));

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Output
echo "<h2>Response from Resend:</h2>";
if ($error) {
    echo "<p style='color: red;'>cURL Error: $error</p>";
} else {
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
}
?>
