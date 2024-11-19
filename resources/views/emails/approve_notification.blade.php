<!-- resources/views/emails/booking_approval.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Booking Approval Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
            border-radius: 8px;
        }
        .header {
            background-color: #098344;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            color: #098344;
        }
        .content p {
            line-height: 1.6;
        }
        .content ul {
            list-style: none;
            padding: 0;
        }
        .content ul li {
            background: #f2f2f2;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
        }
        .content ul li strong {
            color: #098344;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eaeaea;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Approval Notification</h1>
        </div>
        <div class="content">
            <p>Dear Visitor,</p>
            <p>Your booking has been approved with the following details:</p>
            <ul>
                <li><strong>Transaction Number:</strong> {{ $bookingDetails['transaction_number'] }}</li>
                <li><strong>PDL Name:</strong> {{ $bookingDetails['pdl_name'] }}</li>
                <li><strong>Date:</strong> {{ $bookingDetails['date'] }}</li>
                <li><strong>Time:</strong> {{ $bookingDetails['time'] }}</li>
                <li><strong>Type:</strong> {{ $bookingDetails['type'] }}</li>
            </ul>
            <p>We look forward to your visit.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Coco-Spot. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
