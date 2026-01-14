# 3eyadaty

مشروع إدارة عيادات طبية متكامل (PHP 8.2 + MySQL) جاهز للرفع على InfinityFree.

## المتطلبات
- PHP 8.2+
- MySQL 5.7+

## خطوات التشغيل على InfinityFree
1) ارفع محتويات مجلد `htdocs` بالكامل إلى مجلد `htdocs` على الاستضافة.
2) أنشئ قاعدة بيانات جديدة من لوحة InfinityFree.
3) استورد ملف `sql/schema.sql` ثم `sql/seed.sql` من phpMyAdmin.
4) افتح ملف `config/database.php` وعدّل بيانات الاتصال:
   - `host`
   - `dbname`
   - `user`
   - `pass`
5) افتح المتصفح على رابط موقعك.

## بيانات تسجيل الدخول (كلمة المرور: 123456)
- Super Admin: super@3eyadaty.com
- Admin: admin@3eyadaty.com
- Doctor: doctor@3eyadaty.com
- Receptionist: reception@3eyadaty.com
- Patient: patient@3eyadaty.com

## ملاحظات مهمة
- الراوت الافتراضي: `index.php?route=home`
- الراوت بالـ Query مدعوم بالكامل (بدون Rewrite).
- يمكن تشغيل Rewrite عند تفعيل `.htaccess` (اختياري).
