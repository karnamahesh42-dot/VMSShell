<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visitor Pass | Ramoji Film City</title>
</head>

<body style="margin:0; padding:0; background:#eef2f7; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:25px; background:#eef2f7;">
<tr>
<td align="center">
    <!-- Email Card -->
    <table width="600" cellpadding="0" cellspacing="0"
           style="background:#ffffff; border-radius:14px;
           box-shadow:0 8px 25px rgba(0,0,0,0.15); overflow:hidden;">

        <!-- HEADER WITH LOGO + THEME -->
        <tr>
            <td style="
                background: linear-gradient(135deg, #001f3f, #0056a6);
                padding:20px 20px;
                text-align:center;
            ">
                <img src="https://www.nicepng.com/png/detail/37-376583_ramoji-film-city-hyderabad-logo.png"
                     alt="Ramoji Logo"
                     style="width:160px; margin-bottom:5px;">

                <h2 style="margin:0; font-size:20px; color:#ffffff;">
                    Visitor Pass Confirmation
                </h2>

                <p style="margin:6px 0 0; font-size:14px; color:#dde7f7;">
                    Your visit has been officially registered
                </p>
            </td>
        </tr>

        <!-- BODY CONTENT -->
        <tr>
            <td style="padding:30px;">

                <p style="font-size:16px; color:#222; margin-top:0;">
                    Hello <strong> <?= esc($name) ?></strong>,
                </p>

                <p style="font-size:12px; color:#555; line-height:1.6;">
                    Thank you for scheduling your visit. Please find your
                    appointment details and QR code below. Present this QR code
                    at the security gate for seamless entry into
                    <strong>Ramoji Film City</strong>.
                </p>

                <!-- DETAILS BOX -->
               <table width="100%" cellpadding="12" cellspacing="0"
       style="background:#f7f9fc; border:1px solid #dde3ee;
       border-radius:8px; margin-top:18px;">

    <!-- Visitor Name -->
    <tr>
        <td style="font-weight:bold; color:#001f3f; width:40%; text-align:right; padding-right:15px;">
            Name :
        </td>
        <td style="color:#333; text-align:left;">
           <?= esc($name) ?>
        </td>
    </tr>

    <!-- Phone -->
    <tr>
        <td style="font-weight:bold; color:#001f3f; text-align:right; padding-right:15px;">
            Phone :
        </td>
        <td style="color:#333; text-align:left;">
           <?= esc($phone) ?>
        </td>
    </tr>

    <!-- Purpose -->
    <tr>
        <td style="font-weight:bold; color:#001f3f; text-align:right; padding-right:15px;">
            Purpose :
        </td>
        <td style="color:#333; text-align:left;">
           <?= esc($purpose) ?>
        </td>
    </tr>

    <!-- Visitor Code -->
    <tr>
        <td style="font-weight:bold; color:#001f3f; text-align:right; padding-right:15px;">
            V-Code :
        </td>
        <td style="color:#333; text-align:left;">
          <?= esc($v_code) ?>
        </td>
    </tr>

</table>


                <!-- QR CODE SECTION -->
                <div style="text-align:center; margin-top:28px;">
                    <h3 style="color:#001f3f; margin-bottom:6px;">
                        Entry QR Code
                    </h3>

                    <p style="font-size:13px; color:#777; margin-top:0;">
                        Please show this QR at the entrance
                    </p>

                    <img src="https://quickchart.io/qr?text=TEST123&size=200"
                         alt="QR Code"
                         style="width:180px; height:180px; border-radius:10px;
                         border:2px solid #0056a6; padding:6px; background:white;">
                </div>

            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td style="
                background:#e53935;
                padding:14px;
                text-align:center;
                color:#ffffff;
                font-size:12px;
            ">
                © 2025 Ramoji Film City • Visitor Management System
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
