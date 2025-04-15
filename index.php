<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bulk Email Sender</title>
  <style>
    body { font-family: sans-serif; padding: 2rem; max-width: 600px; margin: auto; }
    textarea, input[type="text"], input[type="email"] {
      width: 100%; padding: 0.5rem; margin-bottom: 1rem;
    }
    button { padding: 0.5rem 1rem; }
  </style>
</head>
<body>
  <h1>Wusu Bulk Emails </h1>
  <form method="post" action="send.php">
    <h3>Recipient Emails</h3>
    <input type="text" name="emails" placeholder="foo@example.com, bar@example.com" required>

    <h3>Subject</h3>
    <input type="text" name="subject" placeholder="Subject" required>

    <h3>HTML Body</h3>
    <textarea name="body" placeholder="<h1>Hello</h1><p>Welcome to our newsletter...</p>" rows="10" required></textarea>

    <button type="submit">Send Emails</button>
  </form>
</body>
</html>
