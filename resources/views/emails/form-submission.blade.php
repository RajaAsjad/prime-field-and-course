<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Form Submission</title>
</head>
<body style="margin:0;padding:0;background:#f3f6f4;font-family:Arial,Helvetica,sans-serif;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f6f4;padding:28px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;background:#ffffff;border-radius:14px;overflow:hidden;border:1px solid #d7e3da;">
          <tr>
            <td style="background:#0f3d1c;padding:28px 28px 22px;text-align:left;">
              <div style="font-size:12px;letter-spacing:1.5px;text-transform:uppercase;color:#c9a84c;font-weight:700;margin-bottom:8px;">{{ $siteName }}</div>
              <h1 style="margin:0;font-size:24px;line-height:1.3;color:#ffffff;font-weight:700;">New {{ $formLabel }}</h1>
              <p style="margin:10px 0 0;font-size:14px;color:rgba(255,255,255,.72);">Someone just submitted a form on your website.</p>
            </td>
          </tr>

          <tr>
            <td style="padding:24px 28px 8px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f7faf8;border:1px solid #e2ece5;border-radius:12px;">
                <tr>
                  <td style="padding:18px 20px;">
                    <div style="font-size:12px;color:#6b7c71;text-transform:uppercase;letter-spacing:1px;font-weight:700;margin-bottom:6px;">Email</div>
                    <a href="mailto:{{ $email }}" style="font-size:18px;color:#1a5c28;font-weight:700;text-decoration:none;">{{ $email }}</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          @if (!empty($rows))
            <tr>
              <td style="padding:8px 28px 8px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                  @foreach ($rows as $label => $value)
                    <tr>
                      <td style="padding:12px 0;border-bottom:1px solid #e8efe9;width:120px;vertical-align:top;font-size:13px;color:#6b7c71;font-weight:700;">{{ $label }}</td>
                      <td style="padding:12px 0;border-bottom:1px solid #e8efe9;vertical-align:top;font-size:14px;color:#243028;">{!! $value !!}</td>
                    </tr>
                  @endforeach
                </table>
              </td>
            </tr>
          @endif

          <tr>
            <td style="padding:20px 28px 28px;">
              <a href="mailto:{{ $email }}" style="display:inline-block;background:#c9a84c;color:#0d1e10;text-decoration:none;font-weight:800;font-size:14px;padding:12px 18px;border-radius:999px;">Reply to lead</a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
