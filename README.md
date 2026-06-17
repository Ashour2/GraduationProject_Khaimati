<div dir="rtl">

# خيمتي — نظام إدارة مخيمات اللاجئين

نظام ويب متكامل لإدارة مخيمات اللاجئين الفلسطينيين، مبني باستخدام إطار عمل Laravel 12.

---

## الميزات والوظائف

### لوحة تحكم المشرف (Admin)
- عرض إحصائيات شاملة: عدد المخيمات، المندوبين، مدخلي البيانات، المؤسسات الداعمة، والرسائل
- إدارة المخيمات: إضافة، تعديل، حذف، وعرض تفاصيل كل مخيم
- إدارة المندوبين: تعيين مندوب لكل مخيم أو استبداله
- مراجعة طلبات الانضمام: قبول أو رفض طلبات إنشاء مخيمات جديدة مع إنشاء الحسابات تلقائياً
- إدارة المستخدمين: تفعيل/تعطيل الحسابات وتغيير كلمات المرور
- إدارة المؤسسات الداعمة: إضافة وتعديل وحذف الداعمين
- إضافة مدخلي بيانات وربطهم بمخيمات محددة
- إدارة بيانات التواصل (بريد إلكتروني، هاتف، فيسبوك، واتساب، لينكدإن)
- استعراض الرسائل الواردة من صفحة التواصل

### لوحة تحكم المندوب (Representative)
- عرض إحصائيات المخيم: عدد العائلات، الأفراد، مدخلي البيانات، والداعمين
- استعراض العائلات المسجلة في المخيم وأفرادها
- إدارة المخزون: تسجيل المواد الواردة من الداعمين وتتبع الكميات الموزعة
- إدارة أنواع المساعدات: تعريف معايير الاستحقاق (الجنس، الفئة العمرية، الحالة الصحية)
- توزيع المساعدات ذكياً: تحديد المستفيدين تلقائياً بناءً على بياناتهم الصحية
- تأكيد توزيع المساعدات وتحديث المخزون
- إدارة الداعمين: إضافة داعمين جدد أو ربط داعمين موجودين بالمخيم
- إدارة مدخلي البيانات: إضافة، تفعيل/تعطيل، وتغيير كلمات المرور
- التقارير: اطلاع على بيانات المخيم
- سجل التغييرات: تتبع جميع العمليات التي أجراها مدخلو البيانات

### لوحة تحكم مدخل البيانات (Data Entry)
- تسجيل العائلات: إضافة بيانات ولي الأمر (الاسم، الهوية، الجنس، الحالة الاجتماعية، المحافظة، جهات التواصل، المعلومات الصحية)
- تسجيل أفراد العائلة: إضافة بيانات كل فرد مع معلوماتهم الصحية وبيانات التواصل
- تعديل وحذف بيانات العائلات والأفراد
- عرض تفاصيل كاملة لكل عائلة وأفرادها

### الصفحات العامة
- الصفحة الرئيسية: التعريف بالنظام
- صفحة التواصل: إرسال رسائل للإدارة
- صفحة الانضمام: تقديم طلب لإنشاء مخيم جديد مع رفع المستندات الثبوتية
- صفحة تسجيل الدخول

---

## متطلبات التشغيل

- PHP >= 8.2
- Composer
- MySQL
- XAMPP أو أي خادم ويب مشابه

---

## طريقة التشغيل بعد التنزيل من GitHub

```bash
# 1. استنساخ المشروع
git clone https://github.com/your-repo/camps_management.git
cd camps_management

# 2. تثبيت الاعتماديات
composer install

# 3. نسخ ملف البيئة وضبطه
cp .env.example .env

# 4. توليد مفتاح التطبيق
php artisan key:generate

# 5. إنشاء قاعدة البيانات
# افتح phpMyAdmin أو MySQL وأنشئ قاعدة بيانات باسم: camps_management
# ثم اضبط بيانات الاتصال في ملف .env:
# DB_DATABASE=camps_management
# DB_USERNAME=root
# DB_PASSWORD=

# 6. تشغيل الـ Migrations
php artisan migrate

# 7. إنشاء رابط التخزين
php artisan storage:link

# 8. تشغيل السيرفر
php artisan serve
```

بعد تشغيل السيرفر، افتح المتصفح على: **http://127.0.0.1:8000**

---

## بيانات تسجيل الدخول

| الدور | البريد الإلكتروني | كلمة المرور |
|-------|-------------------|-------------|
| مشرف (Admin) | admin@test.com | 123456 |
| مندوب (Representative) | rep@test.com | 123456 |
| مدخل بيانات (Data Entry) | data@test.com | 123456 |

---

## فريق التطوير

**تطوير:** Hassan, Ashour, Heba, Tasneem, Zain

**المشرف:** د. خالد إسماعيل

**الجامعة:** جامعة الأزهر — غزة، فلسطين

</div>

---

# Khaimati — Refugee Camp Management System

A full-featured web application for managing Palestinian refugee camps, built with Laravel 12.

---

## Features

### Admin Dashboard
- Overview statistics: camps, representatives, data entry users, supporters, and messages
- Camp management: add, edit, delete, and view camp details
- Representative management: assign or replace a representative per camp
- Join requests: approve or reject new camp registration requests (auto-creates accounts on approval)
- User management: activate/deactivate accounts and change passwords
- Supporter (institution) management: add, edit, and delete supporting organizations
- Add data entry users and link them to specific camps
- Communication settings: update email, phone, Facebook, WhatsApp, LinkedIn info
- View incoming messages from the public contact page

### Representative Dashboard
- Camp statistics: family count, members, data entry staff, and supporters
- Browse registered families and their members
- Inventory management: record received aid quantities from supporters and track distribution
- Aid type management: define eligibility criteria (gender, age range, health conditions)
- Smart aid distribution: auto-select beneficiaries based on their health data
- Confirm distributions and automatically update inventory quantities
- Supporter management: add new supporters or link existing ones to the camp
- Data entry management: add, enable/disable, and reset passwords
- Reports: view camp data summaries
- Change log: track all operations performed by data entry users

### Data Entry Dashboard
- Register families: add guardian info (name, ID, gender, marital status, governorate, contact details, health info)
- Register family members: add individual data including health info and contact details
- Edit and delete family and member records
- View full details for each family and its members

### Public Pages
- Home page: system introduction
- Contact page: send messages to administration
- Join page: submit a new camp registration request with document uploads
- Sign-in page

---

## Requirements

- PHP >= 8.2
- Composer
- MySQL
- XAMPP or any equivalent local server

---

## Setup & Installation (from GitHub)

```bash
# 1. Clone the repository
git clone https://github.com/your-repo/camps_management.git
cd camps_management

# 2. Install dependencies
composer install

# 3. Copy and configure environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Create the database
# Open phpMyAdmin or MySQL and create a database named: camps_management
# Then update your .env file:
# DB_DATABASE=camps_management
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Run migrations
php artisan migrate

# 7. Create storage symlink
php artisan storage:link

# 8. Start the development server
php artisan serve
```

Then open your browser at: **http://127.0.0.1:8000**

---

## Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@test.com | 123456 |
| Representative | rep@test.com | 123456 |
| Data Entry | data@test.com | 123456 |

---

## Development Team

**Developed by:** Hassan, Ashour, Heba, Tasneem, and Zain

**Supervisor:** Dr. Khaled Ismael

**University:** Al-Azhar University — Gaza, Palestine
