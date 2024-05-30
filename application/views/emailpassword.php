<!-- application/views/email/new_password_template.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body>
    <p>Dear <?php echo $username; ?>,</p>
    <p>We have received a request to reset your password. Your new password is:</p>
    <p><strong><?php echo $new_password; ?></strong></p>
    <p>Please change this password after logging in.</p>
    <p>Thank you,<br>The Makeover Guys</p>
</body>
</html>
