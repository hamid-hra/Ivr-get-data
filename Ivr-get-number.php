#!/usr/bin/php -q
<?php
require_once('phpagi.php');
require_once ('phpagi-asmanager.php');

$agi = new AGI();

$number = null;
$result = null;

while (true) {
    // گرفتن داده از کاربر
    $result = $agi->get_data('ivr', 15000, 12); // ورودی تا 12 رقم و مدت زمان دریافت ورودی از کاربر 
    $number = $result['result'];

    // بررسی اینکه ورودی معتبر باشد و شماره دریافت شده باشد
    if (!empty($number)) {        
        // اگر ورودی به اندازه کافی طولانی است (مثلاً 11 رقم)، از حلقه خارج شوید
        if (strlen($number) >= 11) {
            // چاپ شماره دریافت شده
            $agi->verbose("شماره دریافت شده: $number", 1);
            break;
        }
        else {
            // اگر هیچ ورودی دریافت نشد
            $agi->verbose("هیچ شماره‌ای دریافت نشد", 1);
        }
    }
}
    // پخش صدای تشکر
$agi->exec('Playback', 'pr/thank-you-for-calling'); // فایل صوتی برای تشکر
// هنگ‌آپ تماس
$agi->hangup();
?>
