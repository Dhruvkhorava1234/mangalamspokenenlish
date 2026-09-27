<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Admission Inquiry</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            padding: 24px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: #ffffff;
            padding: 24px 30px;
            text-align: center;
        }
        .header h2 {
            margin: 0 0 6px 0;
            font-size: 22px;
            font-weight: 700;
        }
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .body {
            padding: 30px;
        }
        .detail-row {
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .detail-label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
        }
        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: #0f172a;
        }
        .message-box {
            background: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 14px 18px;
            border-radius: 4px;
            margin-top: 8px;
            white-space: pre-line;
            color: #334155;
            font-size: 15px;
        }
        .footer {
            background-color: #f8fafc;
            padding: 16px 30px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
        .action-btn {
            display: inline-block;
            background: #2563eb;
            color: #ffffff !important;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Inquiry Received</h2>
            <p>Mangalam Spoken English & Grammar Website</p>
        </div>
        <div class="body">
            <div class="detail-row">
                <div class="detail-label">Full Name</div>
                <div class="detail-value">{{ $data['name'] }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Phone Number</div>
                <div class="detail-value">
                    <a href="tel:{{ $data['phone'] }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">
                        {{ $data['phone'] }}
                    </a>
                </div>
            </div>

            @if(!empty($data['email']))
            <div class="detail-row">
                <div class="detail-label">Email Address</div>
                <div class="detail-value">
                    <a href="mailto:{{ $data['email'] }}" style="color: #2563eb; text-decoration: none;">
                        {{ $data['email'] }}
                    </a>
                </div>
            </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">Category / Student Type</div>
                <div class="detail-value">{{ ucfirst($data['category'] ?? 'Not specified') }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Interested Course</div>
                <div class="detail-value" style="color: #1d4ed8; font-weight: 600;">
                    {{ $data['course'] }}
                </div>
            </div>

            <div class="detail-row" style="border-bottom: none;">
                <div class="detail-label">Message / Preferred Timing</div>
                <div class="message-box">
                    {{ !empty($data['message']) ? $data['message'] : 'No message provided.' }}
                </div>
            </div>

            <div style="text-align: center; margin-top: 24px;">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data['phone']) }}" class="action-btn" target="_blank">
                    Message on WhatsApp
                </a>
            </div>
        </div>
        <div class="footer">
            Sent automatically from Mangalam Spoken English Porbandar contact inquiry form.
        </div>
    </div>
</body>
</html>
