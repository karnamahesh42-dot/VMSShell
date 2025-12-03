<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visitor Pass</title>
</head>
<body style="margin:0; padding:0; background:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px; background:#f4f4f4;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#fff; border-radius:10px; box-shadow:0px 3px 10px rgba(0,0,0,0.1);">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#4A90E2; padding:20px; text-align:center; color:white;">
                            <h2 style="margin:0; font-size:22px;">Visitor Pass Confirmation</h2>
                            <p style="margin:0; font-size:13px;">Thank you for registering your visit</p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:20px;">

                            <p style="font-size:15px; color:#333; margin-top:0;">
                                Hello <strong><?= esc($name) ?></strong>,
                            </p>

                            <p style="font-size:14px; color:#555;">
                                Your visit has been registered. Here are your details:
                            </p>

                            <!-- DETAILS BOX -->
                            <table width="100%" cellpadding="8" cellspacing="0" style="background:#fafafa; border:1px solid #eee; border-radius:6px;">
                                <tr>
                                    <td width="40%" style="font-weight:bold; color:#333;">Visitor Name</td>
                                    <td style="color:#555;"><?= esc($name) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; color:#333;">Phone</td>
                                    <td style="color:#555;"><?= esc($phone) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; color:#333;">Purpose</td>
                                    <td style="color:#555;"><?= esc($purpose) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; color:#333;">V-Code</td>
                                    <td style="color:#555;"><?= esc($v_code) ?></td>
                                </tr>
                            </table>

                            <!-- QR CODE -->
                            <div style="text-align:center; margin-top:20px;">
                                <h3 style="color:#333; margin-bottom:5px;">Your QR Code</h3>
                                <p style="font-size:13px; color:#777;">Show this QR at the security gate</p>

                                <!-- QR Image (FAST) -->
                                <img src="<?= $qr_url ?>" 
                                     alt="QR Code" 
                                     style="width:150px; height:150px; border:1px solid #ccc;">
                            </div>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#4A90E2; padding:12px; text-align:center; color:white; font-size:12px;">
                            Visitor Management System © <?= date("Y") ?>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
