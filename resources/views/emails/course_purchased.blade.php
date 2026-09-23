<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Course Purchase Notification</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background-color: #f8fafc; padding: 20px; color: #1e293b;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <div style="background-color: #0b2545; color: #ffffff; padding: 24px; text-align: center;">
            <h2 style="margin: 0; font-size: 22px;">Shree Mangalam Spoken English</h2>
            <p style="margin: 4px 0 0; font-size: 14px; color: #67e8f9;">New Course Purchase Confirmed</p>
        </div>
        <div style="padding: 24px;">
            <p style="font-size: 16px; margin-top: 0;">Hello Administrator,</p>
            <p>A new student has enrolled and completed payment for a course:</p>

            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background: #f8fafc; border-radius: 8px;">
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: bold; width: 35%;">Course:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">{{ $order->course->title }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: bold;">Student Name:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">{{ $order->user->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: bold;">Student Email:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">{{ $order->user->email }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: bold;">Amount Paid:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; color: #059669; font-weight: bold;">₹{{ number_format($order->amount) }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: bold;">Transaction ID:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-family: monospace;">{{ $order->transaction_id }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; font-weight: bold;">Payment Method:</td>
                    <td style="padding: 12px;">Mock Stripe (Instant Approval)</td>
                </tr>
            </table>

            <p style="margin-bottom: 0;">You can view detailed records in your <a href="{{ route('admin.dashboard') }}" style="color: #2563eb; font-weight: bold;">Admin Dashboard</a>.</p>
        </div>
    </div>
</body>
</html>
