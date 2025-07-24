<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            direction: rtl;
            text-align: right;
            background-color: #f4f4f4;
        }
        .container {
            padding: 20px;
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
        }
        .header {
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .message {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- شعار النظام -->
        <div class="header">
            <img src="{{ asset('business_logos/weka-logo.png') }}" alt="شعار النظام">
        </div>
        <div class="message">
            <h2>مرحبًا!</h2>
            <p>لقد طلبت رابطًا لإعادة تعيين كلمة المرور.</p>
            <p>إذا لم تطلب ذلك، فلا داعي لأي إجراء.</p>
            <p>
                <a href="{{ $link }}" class="button">إعادة تعيين كلمة المرور</a>
            </p>
        </div>
        <footer>
            <p>إذا كنت تواجه صعوبة في النقر على الزر "إعادة تعيين كلمة المرور"، انسخ الرابط التالي والصقه في متصفحك:</p>
            <p><a href="{{ $link }}">{{ $link }}</a></p>
            <p>&copy; 2025 نظام وكا المحاسبي. جميع الحقوق محفوظة.</p>
        </footer>
    </div>
</body>
</html>
