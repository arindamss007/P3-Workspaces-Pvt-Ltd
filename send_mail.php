<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = htmlspecialchars($_POST['full_name'] ?? '');
    $email     = htmlspecialchars($_POST['email'] ?? '');
    $phone     = htmlspecialchars($_POST['phone'] ?? '');
    $company   = htmlspecialchars($_POST['company'] ?? '');
    $city      = htmlspecialchars($_POST['city'] ?? '');
    $service   = htmlspecialchars($_POST['service'] ?? '');
    $message   = htmlspecialchars($_POST['message'] ?? '');

    // Admin Email
    $adminEmail = "contact@p3workspaces.com";

    // Logo URL (Must be public URL)
    $logoURL = "https://p3workspaces.com/assets/images/logow.png";  
    // Change logo path if needed


    // ============================
    // REQUIRED FIELD VALIDATION
    // ============================
    if (empty($full_name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
        echo "<script>
                alert('Please fill all required fields.');
                window.location.href='contact.html';
              </script>";
        exit();
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Invalid email address.');
                window.location.href='contact.html';
              </script>";
        exit();
    }


    // ============================
    // ADMIN EMAIL (Premium HTML)
    // ============================
    $adminSubject = "New Inquiry Received - P3 Workspaces Website";

    $adminBody = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body style='margin:0; padding:0; font-family: Arial, sans-serif; background:#f3f4f6;'>

        <div style='max-width:600px; margin:20px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0px 8px 25px rgba(0,0,0,0.12);'>

            <div style='background:#111827; padding:20px; text-align:center;'>
                <img src='$logoURL' alt='P3 Workspaces Logo' style='max-width:160px; margin-bottom:10px;'>
                <h2 style='color:#facc15; margin:0;'>New Inquiry Received</h2>
                <p style='color:#ffffff; margin:5px 0 0; font-size:14px;'>P3 Workspaces Website Contact Form</p>
            </div>

            <div style='padding:25px;'>
                <h3 style='color:#111827; margin-top:0;'>Inquiry Details</h3>

                <table style='width:100%; border-collapse:collapse; font-size:15px;'>
                    <tr>
                        <td style='padding:10px; background:#f9fafb; font-weight:bold;'>Full Name</td>
                        <td style='padding:10px;'>$full_name</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; background:#f9fafb; font-weight:bold;'>Email</td>
                        <td style='padding:10px;'>$email</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; background:#f9fafb; font-weight:bold;'>Phone</td>
                        <td style='padding:10px;'>$phone</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; background:#f9fafb; font-weight:bold;'>Company</td>
                        <td style='padding:10px;'>$company</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; background:#f9fafb; font-weight:bold;'>City</td>
                        <td style='padding:10px;'>$city</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; background:#f9fafb; font-weight:bold;'>Service</td>
                        <td style='padding:10px;'>$service</td>
                    </tr>
                </table>

                <div style='margin-top:20px; padding:15px; background:#f3f4f6; border-radius:10px;'>
                    <h4 style='margin:0 0 10px; color:#111827;'>Message</h4>
                    <p style='margin:0; color:#374151; line-height:1.6;'>$message</p>
                </div>

                <p style='margin-top:25px; font-size:13px; color:#6b7280;'>
                    This inquiry was submitted from P3 Workspaces Contact Form.
                </p>
            </div>

            <div style='background:#111827; text-align:center; padding:12px;'>
                <p style='margin:0; font-size:13px; color:#9ca3af;'>
                    © " . date("Y") . " P3 Workspaces. All Rights Reserved.
                </p>
            </div>

        </div>

    </body>
    </html>
    ";


    // ============================
    // USER CONFIRMATION EMAIL
    // ============================
    $userSubject = "Thank You for Contacting P3 Workspaces";

    $userBody = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body style='margin:0; padding:0; font-family: Arial, sans-serif; background:#f3f4f6;'>

        <div style='max-width:600px; margin:20px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0px 8px 25px rgba(0,0,0,0.12);'>

            <div style='background:#111827; padding:20px; text-align:center;'>
                <img src='$logoURL' alt='P3 Workspaces Logo' style='max-width:160px; margin-bottom:10px;'>
                <h2 style='color:#facc15; margin:0;'>Thank You!</h2>
                <p style='color:#ffffff; margin:5px 0 0; font-size:14px;'>We received your inquiry successfully</p>
            </div>

            <div style='padding:25px;'>
                <h3 style='color:#111827; margin-top:0;'>Hello $full_name,</h3>

                <p style='color:#374151; font-size:15px; line-height:1.7;'>
                    Thank you for contacting <b>P3 Workspaces</b>.  
                    We have received your inquiry and our team will connect with you shortly.
                </p>

                <div style='margin-top:20px; padding:15px; background:#f9fafb; border-left:5px solid #facc15; border-radius:10px;'>
                    <h4 style='margin:0 0 10px; color:#111827;'>Your Message</h4>
                    <p style='margin:0; color:#374151; line-height:1.6;'>$message</p>
                </div>

                <p style='margin-top:20px; font-size:14px; color:#6b7280;'>
                    If you did not submit this request, please ignore this email.
                </p>

                <p style='margin-top:25px; color:#111827; font-weight:bold;'>
                    Regards,<br>
                    P3 Workspaces Team
                </p>

                <hr style='margin-top:20px;'>

                <p style='color:#374151; font-size:14px; line-height:1.7;'>
                    <b>Address:</b><br>
                    2066, 2nd Floor, Nazarbaug Palace,<br>
                    Near Mandvi Gate, Mandvi,<br>
                    Vadodara - 390001
                </p>

                <p style='color:#374151; font-size:14px; line-height:1.7;'>
                    <b>Phone:</b> +91 88495 67124 / +91 95102 88972<br>
                    <b>Email:</b> contact@p3workspaces.com
                </p>

            </div>

            <div style='background:#111827; text-align:center; padding:12px;'>
                <p style='margin:0; font-size:13px; color:#9ca3af;'>
                    © " . date("Y") . " P3 Workspaces. All Rights Reserved.
                </p>
            </div>

        </div>

    </body>
    </html>
    ";


    // ============================
    // HEADERS (IMPORTANT FIX)
    // ============================
    $adminHeaders  = "MIME-Version: 1.0\r\n";
    $adminHeaders .= "Content-type:text/html;charset=UTF-8\r\n";
    $adminHeaders .= "From: P3 Workspaces Website <contact@p3workspaces.com>\r\n";
    $adminHeaders .= "Reply-To: $email\r\n";
    $adminHeaders .= "Return-Path: contact@p3workspaces.com\r\n";

    $userHeaders  = "MIME-Version: 1.0\r\n";
    $userHeaders .= "Content-type:text/html;charset=UTF-8\r\n";
    $userHeaders .= "From: P3 Workspaces <contact@p3workspaces.com>\r\n";
    $userHeaders .= "Reply-To: contact@p3workspaces.com\r\n";
    $userHeaders .= "Return-Path: contact@p3workspaces.com\r\n";


    // ============================
    // SEND BOTH EMAILS (FIXED)
    // ============================
    $adminMailSent = mail($adminEmail, $adminSubject, $adminBody, $adminHeaders, "-f contact@p3workspaces.com");
    $userMailSent  = mail($email, $userSubject, $userBody, $userHeaders, "-f contact@p3workspaces.com");


    // ============================
    // SUCCESS / ERROR RESPONSE
    // ============================
    if ($adminMailSent && $userMailSent) {
        echo "<script>
                alert('Thank you! Your inquiry has been sent successfully.');
                window.location.href='contact.html';
              </script>";
    } else {
        echo "<script>
                alert('Oops! Message could not be sent. Please try again later.');
                window.location.href='contact.html';
              </script>";
    }

} else {
    header("Location: contact.html");
    exit();
}
?>