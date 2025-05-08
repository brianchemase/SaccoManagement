<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacco Savings Statement</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background-color: #2c3e50;
            padding: 30px 20px;
            text-align: center;
        }
        
        .logo {
            max-width: 200px;
            height: auto;
            margin: 0 auto;
            display: block;
        }
        
        .content {
            padding: 30px;
        }
        
        h1 {
            color: #2c3e50;
            margin-top: 0;
            font-size: 24px;
            text-align: center;
            font-weight: 600;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: 500;
        }
        
        .message {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            border-left: 4px solid #3498db;
        }
        
        .highlight {
            font-weight: bold;
            color: #3498db;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
            font-size: 14px;
            color: #7f8c8d;
        }
        
        .download-section {
            text-align: center;
            margin: 30px 0;
        }
        
        .download-text {
            display: inline-block;
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .download-text:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img class="logo" src="{{$message->embed(public_path().'/logo/logo1.png')}}" alt="Company Logo">
        </div>
        
        <div class="content">
            <h1>Sacco Savings Statement</h1>
            
            <p class="greeting">Dear <span class="highlight">{{ $member->full_name }}</span>,</p>
            
            <div class="message">
                <p>Please review your statement carefully. Contact us if you have any questions.</p>
                <p>Here's your detailed savings statement covering all transactions.</p>
            </div>
            
            <div class="download-section">
                <span class="download-text">Download Statement Below</span>
            </div>
        </div>
        
        <div class="footer">
            <p>© 2023 Your Sacco. All rights reserved.</p>
        </div>
    </div>
</body>
</html>