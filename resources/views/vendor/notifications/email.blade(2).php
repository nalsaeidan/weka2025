<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            margin: 0 auto;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            margin-bottom: 30px;
            border-bottom: 2px solid #2d3748;
        }
        .header h1 {
            color: #2d3748;
            font-size: 26px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #2d3748;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            text-transform: uppercase;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #a0aec0;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        .footer a {
            color: #a0aec0;
            text-decoration: none;
        }
        /* تحسين تنسيق الروابط */
        a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>نظام وِكاء المحاسبي</h1>
        </div>
        <div class="content">
            <!-- هنا نستخدم المتغيرات التي تم تمريرها -->
            <p>مرحبًا {{ $notifiable->name }}،</p>
            <p>لقد طلبت إعادة تعيين كلمة المرور لحسابك في نظام وِكاء المحاسبي. إذا كنت لم تطلب ذلك، يمكنك تجاهل هذه الرسالة.</p>
            <p>لإعادة تعيين كلمة المرور، يرجى الضغط على الرابط أدناه:</p>
            <a href="{{ $resetUrl }}" class="btn">إعادة تعيين كلمة المرور</a>
        </div>
        <div class="footer">
            <p>إذا كنت تواجه مشكلة في النقر على الزر أعلاه، يمكنك نسخ الرابط التالي ولصقه في متصفحك:</p>
            <p><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
            <p>© 2025 نظام وِكاء المحاسبي. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</body>
</html>
