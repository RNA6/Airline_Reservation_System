<?php
session_start();

// مسح كل بيانات الجلسة
session_unset();
session_destroy();

// إعادة التوجيه لصفحة الرئيسية أو صفحة تسجيل الدخول
header("Location: ../home/home.php");
exit;
?>
