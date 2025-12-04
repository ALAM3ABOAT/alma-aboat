<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عالم ابوات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        img {
            max-width: 80%;
            height: auto;
            border: 2px solid #333;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            margin-top: 20px;
        }
        input[type="file"], input[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>مرحباً بك في عالم ابوات</h1>
    <p>اختر صورة لرفعها على الموقع:</p>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <br>
        <input type="submit" name="upload" value="رفع الصورة">
    </form>

    <?php
    if(isset($_POST['upload'])) {
        $folder = "images/";
        if(!is_dir($folder)) {
            mkdir($folder, 0755, true); // إنشاء المجلد إذا لم يكن موجود
        }

        $file = $_FILES['image'];
        $fileName = basename($file['name']);
        $targetFile = $folder . $fileName;

        // تحقق من نوع الملف
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if(in_array($file['type'], $allowedTypes)) {
            if(move_uploaded_file($file['tmp_name'], $targetFile)) {
                echo "<p style='color:green;'>تم رفع الصورة بنجاح!</p>";
                echo "<img src='$targetFile' alt='صورة مرفوعة'>";
            } else {
                echo "<p style='color:red;'>حدث خطأ أثناء رفع الصورة.</p>";
            }
        } else {
            echo "<p style='color:red;'>صيغة الملف غير مدعومة!</p>";
        }
    }
    ?>
</body>
</html>