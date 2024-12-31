<?php

$username = 'sammy';
$password = 'password';
$host = 'localhost';
$dbname = 'admin';

// الاتصال بقاعدة البيانات باستخدام PDO
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // تعيين وضع الأخطاء
    echo 'Connected to database successfully';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();  // التعامل مع الأخطاء
}

?>
