<?php
///////////////////////////////////////////////////////////////////////////
// Created and developed by Greg Zemskov
// Email: audit@revisium.com, http://revisium.com/ai/, skype: greg_zemskov

// Commercial usage is not allowed without a license purchase or written permission of author
// Source code usage is not allowed without author's permission

// Certificated in Federal Institute of Industrial Property in 2012
// http://revisium.com/ai/i/mini_aibolit.jpg
///////////////////////////////////////////////////////////////////////////

//define('LANG', 'EN');
define('LANG', 'RU');

define('PASS', 'put_any_strong_password_here'); // Put any strong password to open the script from web


define('REPORT_MASK_PHPSIGN', 1);
define('REPORT_MASK_SPAMLINKS', 2);
define('REPORT_MASK_DOORWAYS', 4);
define('REPORT_MASK_SUSP', 8);
define('REPORT_MASK_CANDI', 16);
define('REPORT_MASK_WRIT', 32);
define('REPORT_MASK_FULL', REPORT_MASK_PHPSIGN | REPORT_MASK_SPAMLINKS | REPORT_MASK_DOORWAYS | REPORT_MASK_SUSP | REPORT_MASK_CANDI | REPORT_MASK_WRIT);

$defaults = array(
	'path' => dirname(__FILE__),
	'scan_all_files' => 0, // full scan (rather than just a .js, .php, .html, .htaccess)
	'scan_delay' => 1, // delay in file scanning to reduce system load
	'max_size_to_scan' => '1M',
	'site_url' => '', // website url
	'no_rw_dir' => 0,
	'report_mask' =>  REPORT_MASK_FULL // full-featured report
);


define('DEBUG_MODE', 0);

define('DIR_SEPARATOR', '/');

define('DOUBLECHECK_FILE', 'AI-BOLIT-DOUBLECHECK.php');

if ((isset($_SERVER['OS']) && stripos('Win', $_SERVER['OS']) !== false)/* && stripos('CygWin', $_SERVER['OS']) === false)*/) {
   define('DIR_SEPARATOR', '\\');
}


if (LANG == 'RU') {
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// RUSSIAN INTERFACE
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
define('AI_STR_001', '<h3>AI-Болит v.%s &mdash; ищет вредоносный код и вирусы в файлах.</h3><h5>Григорий Земсков, 2012-2013, <a target=_blank href="http://revisium.com/ai/">Страница проекта на revisium.com.</a> %s</h5>');
define('AI_STR_002', '<div class="update">Проверьте обновление на сайте <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. Возможно, ваша версия скрипта уже устарела.</div>');
define('AI_STR_003', 'ВНИМАНИЕ! Не оставляйте файл ai-bolit.php или файл отчета на сервере, и не давайте прямых ссылок с других сайтов на файл отчета или скрипта. Отчет содержит важную информацию о вашем сайте или сервере, сохраните его в надежном месте от посторонних глаз!');
define('AI_STR_004', 'Путь');
define('AI_STR_005', 'Дата создания');
define('AI_STR_006', 'Дата модификации');
define('AI_STR_007', 'Размер');
define('AI_STR_008', 'Конфигурация PHP');
define('AI_STR_009', "Вы установили слабый пароль на скрипт AI-BOLIT. Укажите пароль не менее 8 символов, содержащий латинские буквы в верхнем и нижнем регистре, а также цифры. Например, такой <b>%s</b>");
define('AI_STR_010', "Запустите скрипт с паролем, который установлен в переменной PASS (в начале файла). <br/>Например, так http://ваш_сайт_и_путь_до_скрипта/ai-bolit.php?p=<b>%s</b>");
define('AI_STR_011', 'Текущая директория не доступна для чтения скрипту. Пожалуйста, укажите права на доступ <b>rwxr-xr-x</b> или с помощью командной строки <b>chmod +r имя_директории</b>');
define('AI_STR_012', "<div class=\"rep\">Известно %s шелл-сигнатур, а также %s других вредоносных фрагментов. Затрачено времени: <b>%s</b
>.<br/>Сканирование начато: %s. Сканирование завершено: %s</div> ");
define('AI_STR_013', '<div class="rep">Всего проверено %s директорий и %s файлов.</div>');
define('AI_STR_014', '<div class="rep" style="color: #0000A0">Внимание, скрипт выполнил быструю проверку сайта. Проверяются только наиболее критические файлы, но часть вредоносных скриптов может быть не обнаружена. Пожалуйста, запустите скрипт из командной строки для выполнения полного тестирования. Подробнее смотрите в <a href="http://revisium.com/ai/faq.php">FAQ вопрос №10</a>.</div>');
define('AI_STR_015', '<div class="sec">Критические замечания</div>');
define('AI_STR_016', 'Найдены сигнатуры шелл-скрипта. Подозрение на вредоносный скрипт:');
define('AI_STR_017', 'Шелл-скрипты не найдены.');
define('AI_STR_018', 'Найдены сигнатуры javascript вирусов:');
define('AI_STR_019', 'Найдены сигнатуры исполняемых файлов unix. Они могут быть вредоносными файлами:');
define('AI_STR_020', 'Найдены длинные зашифрованные последовательности в PHP или подключение внешних файлов. Подозрение на вредоносный скрипт:');
define('AI_STR_021', 'Подозрение на вредоносный скрипт:');
define('AI_STR_022', 'Список файловых ссылок (symlinks):');
define('AI_STR_023', 'Список скрытых файлов:');
define('AI_STR_024', 'Скорее всего этот файл лежит в каталоге с дорвеем:');
define('AI_STR_025', 'Не найдено директорий c дорвеями');
define('AI_STR_026', 'Предупреждения');
define('AI_STR_027', 'Опасный код в .htaccess (редирект на внешний сервер, подмена расширений или автовнедрение кода):');
define('AI_STR_028', 'В не .php файле содержится стартовая сигнатура PHP кода. Возможно, там вредоносный код:');
define('AI_STR_029', 'В этих файлах размещен код по продаже ссылок. Убедитесь, что размещали его вы:');
define('AI_STR_030', 'Непроверенные файлы - ошибка чтения');
define('AI_STR_031', 'В этих файлах размещены невидимые ссылки. Подозрение на ссылочный спам:');
define('AI_STR_032', 'Список невидимых ссылок:');
define('AI_STR_033', 'Отображены только первые ');
define('AI_STR_034', 'Найдены директории, в которых подозрительно много файлов .php или .html. Подозрение на дорвей:');
define('AI_STR_035', 'Скрипт использует код, который часто используются во вредоносных скриптах:');
define('AI_STR_036', 'Директории из файла .adirignore были пропущены при сканировании:');
define('AI_STR_037', 'Версии найденных CMS:');
define('AI_STR_038', 'Большие файлы (больше чем %s! Пропущено:');
define('AI_STR_039', 'Не найдено файлов больше чем %s');
define('AI_STR_040', 'Временные файлы или файлы(каталоги)-кандидаты на удаление по ряду причин:');
define('AI_STR_041', 'Потенциально небезопасно! Директории, доступные скрипту на запись:');
define('AI_STR_042', 'Не найдено директорий, доступных на запись скриптом');
define('AI_STR_043', 'Использовано памяти при сканировании: ');
define('AI_STR_044', '<div id="igid" style="display: none;"><div class="sec">Добавить в список игнорируемых</div><form name="ignore"><textarea name="list" style="width: 600px; height: 400px;"></textarea></form><div class="details">Скопируйте этот список и вставьте его в файл .aignore, чтобы исключить эти файлы из отчета.</div></div>');
define('AI_STR_045', '<div class="notice"><span class="vir">[!]</span> В скрипте отключено полное сканирование файлов, проверяются только .php, .html, .htaccess. Чтобы выполнить более тщательное сканирование, <br/>поменяйте значение настройки на <b>\'scan_all_files\' => 1</b> в самом верху скрипта. Скрипт в этом случае может работать очень долго. Рекомендуется отключить на хостинге лимит по времени выполнения, либо запускать скрипт из командной строки.</div>');
define('AI_STR_046', '[x] закрыть сообщение');
define('AI_STR_047', '<div class="offer" id="ofr"><span style="font-size: 15px;"><a href="http://www.revisium.com/ru/order/" target="_blank">Лечение сайта от вирусов. Защита от взлома. Гарантия.</a></span><br/><p>Быстро и качественно вылечим Ваш сайт от вирусов, удалим вредоносный код с сайта, поставим защиту от взлома. <a href="http://www.revisium.com/ru/order/">Пишите</a>.</p><a href="http://www.revisium.com/ru/order/" target="_blank">www.revisium.com &rarr;</a><p>Смотрите <a href="http://www.revisium.com/ru/quotes/" target=_blank>отзывы клиентов</a><p><p>Также приглашаем в <a href="http://vk.com/siteprotect" style="color: white" target="_blank">группу ВКонтакте: "Безопасность Веб-сайтов"</a>');
define('AI_STR_048', '<p>Если у вас есть эккаунт ВКонтакте, приглашаю в <a href="http://vk.com/siteprotect" target=_blank>группу "Безопасность Веб-сайтов"</a>: там я делюсь опытом защиты веб-сайтов и поиска вредоносных скриптов.</p>');
define('AI_STR_049', 'Отказ от гарантий: даже если скрипт не нашел вредоносных скриптов на сайте, автор не гарантирует их полное отсутствие, а также не несет ответственности за возможные последствия работы скрипта ai-bolit.php или неоправданные ожидания пользователей относительно функциональности и возможностей.');
define('AI_STR_050', 'Замечания и предложения по работе скрипта присылайте на <a href="mailto:audit@revisium.com">audit@revisium.com</a>.<p>Также буду чрезвычайно благодарен за любые упоминания скрипта ai-bolit на вашем сайте, в блоге, среди друзей, знакомых и клиентов. Ссылочку можно поставить на <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. <p>Если будут вопросы - пишите <a href="mailto:audit@revisium.com">audit@revisium.com</a>. Кстати, еще я собрал точную <a href="http://gzq.ru/">базу IP адресов</a> по городам России и Украины.');
define('AI_STR_051', 'Отчет по ');
define('AI_STR_052', 'Эвристический анализ обнаружил подозрительные файлы. Проверьте их на наличие вредоносного кода.');
define('AI_STR_053', 'Много косвенных вызовов функции');
define('AI_STR_054', 'Подозрение на обфусцированные переменные');
define('AI_STR_055', 'Подозрительное использование массива глобальных переменных');
define('AI_STR_056', 'Дробление строки на символы');
} else {
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ENGLISH INTERFACE
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
define('AI_STR_001', '<h3>AI-BOLIT v.%s &mdash; Enhanced Server-Side Detector of Viruses, Malicious and Hacker\'s Scripts.</h3><h5>Greg Zemskov, 2012-2013, <a target=_blank href="http://revisium.com/aibo/">AI-BOLIT web site.</a>. Non-commercial use only.</h5>');
define('AI_STR_002', '<div class="update">Check for updates on <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. Probably your version is out-of-date.</div>');
define('AI_STR_003', 'Caution! Do not leave either ai-bolit.php or report file on server and do not provide direct links to the report file. Report file contains sensitive information about your website which could be used by hackers. So keep it in safe place and don\'t leave on website!');
define('AI_STR_004', 'Path');
define('AI_STR_005', 'Created');
define('AI_STR_006', 'Modified');
define('AI_STR_007', 'Size');
define('AI_STR_008', 'PHP Info');
define('AI_STR_009', "Your password for AI-BOLIT is weak. Password must be more than 8 character length, contain both latin letters in upper and lower case, and digits. E.g. <b>%s</b>");
define('AI_STR_010', "Open AI-BOLIT with password specified in the beggining of file in PASS variable. <br/>E.g. http://you_website.com/ai-bolit.php?p=<b>%s</b>");
define('AI_STR_011', 'Current folder is not readable. Please change permission for <b>rwxr-xr-x</b> or using command line <b>chmod +r folder_name</b>');
define('AI_STR_012', "<div class=\"rep\">%s malicious signatures known, %s virus signatures and other malicious code. Elapsed: <b>%s</b
>.<br/>Started: %s. Stopped: %s</div> ");
define('AI_STR_013', '<div class="rep">Scanned %s folders and %s files.</div>');
define('AI_STR_014', '<div class="rep" style="color: #0000A0">Attention! Script has performed quick scan. It scans only .html/.js/.php files  in quick scan mode so some of malicious scripts might not be detected. Please launch script from a command line thru SSH to perform full scan.');
define('AI_STR_015', '<div class="sec">Critical</div>');
define('AI_STR_016', 'Shell script signatures detected. Might be a malicious or hacker\'s script:');
define('AI_STR_017', 'Shell scripts signatures not detected.');
define('AI_STR_018', 'Javascript virus signatures detected:');
define('AI_STR_019', 'Unix executables signatures detected. They might be a malicious binaries or rootkits:');
define('AI_STR_020', 'Suspicious encoded strings or external includes detected in PHP files. Might be a malicious or hacker\'s script:');
define('AI_STR_021', 'Might be a malicious or hacker\'s script:');
define('AI_STR_022', 'Symlinks:');
define('AI_STR_023', 'Hidden files:');
define('AI_STR_024', 'Files might be a part of doorway:');
define('AI_STR_025', 'Doorway folders not detected');
define('AI_STR_026', 'Warnings');
define('AI_STR_027', 'Malicious code in .htaccess (redirect to external server, extention handler replacement or malicious code auto-append):');
define('AI_STR_028', 'Non-PHP file has PHP signature. Check for malicious code:');
define('AI_STR_029', 'This script has black-SEO links or linkfarm. Check if it was installed by your:');
define('AI_STR_030', 'Reading error. Skipped.');
define('AI_STR_031', 'These files have invisible links, might be black-seo stuff:');
define('AI_STR_032', 'List of invisible links:');
define('AI_STR_033', 'Displayed first ');
define('AI_STR_034', 'Folders contained too many .php or .html files. Might be a doorway:');
define('AI_STR_035', 'Suspicious code detected. It\'s usually used in malicious scrips:');
define('AI_STR_036', 'The following list of files specified in .adirignore has been skipped:');
define('AI_STR_037', 'CMS found:');
define('AI_STR_038', 'Large files (greater than %s! Skipped:');
define('AI_STR_039', 'Files greater than %s not found');
define('AI_STR_040', 'Files recommended to be remove due to security reason:');
define('AI_STR_041', 'Potentially unsafe! Folders which are writable for scripts:');
define('AI_STR_042', 'Writable folders not found');
define('AI_STR_043', 'Memory used: ');
define('AI_STR_044', '<div id="igid" style="display: none;"><div class="sec">Add to ignore list</div><form name="ignore"><textarea name="list" style="width: 600px; height: 400px;"></textarea></form><div class="details">Copy and paste the following list into .aignore to eliminate these files from AI-BOLIT report.</div></div>');
define('AI_STR_045', '<div class="notice"><span class="vir">[!]</span> Ai-BOLIT is working in quick scan mode, only .php, .html, .htaccess files will be checked. Change the following setting \'scan_all_files\' => 1 to perform full scanning.</b>. </div>');
define('AI_STR_046', '[x] close window');
define('AI_STR_047', '<div class="offer" id="ofr"><span style="font-size: 15px;"><a href="http://www.revisium.com/ru/order/" target="_blank">
We will protect your website against hackers and viruses with guarantee!</a></span><br/>
<p>We completely remove malicious software and scripts from your website, protect website against hackers, check servers for rootkits and suid-files, teach you how to keep your website secured. <a href="http://www.revisium.com/en/order/">Contact Us</a>');
define('AI_STR_048', '');
define('AI_STR_049', "Disclaimer: I'm not liable to you for any damages, including general, special, incidental or consequential damages arising out of the use or inability to use the script (including but not limited to loss of data or report being rendered inaccurate or failure of the script). There's no warranty for the program. Use at your own risk. ");
define('AI_STR_050', "I'm sincerely appreciate reports for any bugs you may found in the script. Please email me: <a href=\"mailto:audit@revisium.com\">audit@revisium.com</a>.<p> Also I appriciate any reference to the script in your blog or forum posts. Thank you for the link to download page: <a href=\"http://revisium.com/aibo/\">http://revisium.com/aibo/</a>");
define('AI_STR_051', 'Report for ');
define('AI_STR_052', 'Heuristic Analyzer has detected suspicious files. Check if they are malware.');
define('AI_STR_053', 'Fucntion called by reference');
define('AI_STR_054', 'Suspected for obfuscated variables');
define('AI_STR_055', 'Suspected for $GLOBAL array usage');
define('AI_STR_056', 'Abnormal split of string');
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// This is signatures wrapped into base64. 
$g_DBShe = unserialize(base64_decode("YTozODA6e2k6MDtzOjIwOiIkbWQ1PW1kNSgiJHJhbmRvbSIpOyI7aToxO3M6NjoiM3hwMXIzIjtpOjI7czoyNjoiYW5kcm9pZHxhdmFudGdvfGJsYWNrYmVycnkiO2k6MztzOjg6Ii8vTk9uYU1FIjtpOjQ7czozMjoiJGltPXN1YnN0cigkdHgsJHArMiwkcDItKCRwKzIpKTsiO2k6NTtzOjMyOiI8IS0tI2V4ZWMgY21kPSIkSFRUUF9BQ0NFUFQiIC0tPiI7aTo2O3M6MTU6Ik5pbmphVmlydXMgSGVyZSI7aTo3O3M6MjE6IjdQMXRkK05XbGlhSS9oV2taNFZYOSI7aTo4O3M6NDoiQW0hciI7aTo5O3M6NjoiI0lySXNUIjtpOjEwO3M6MTA6Im5kcm9pfGh0Y18iO2k6MTE7czoxMDoiYW5kZXh8b29nbCI7aToxMjtzOjE3OiJIYWNrZWQgQnkgRW5ETGVTcyI7aToxMztzOjE3OiIoJF9QT1NUWyJkaXIiXSkpOyI7aToxNDtzOjU1OiIoJGluZGF0YSwkYjY0PTEpe2lmKCRiNjQ9PTEpeyRjZD1iYXNlNjRfZGVjb2RlKCRpbmRhdGEpIjtpOjE1O3M6NzU6IiRpbT1zdWJzdHIoJGltLDAsJGkpLnN1YnN0cigkaW0sJGkyKzEsJGk0LSgkaTIrMSkpLnN1YnN0cigkaW0sJGk0KzEyLHN0cmxlbiI7aToxNjtzOjE4OiI8P3BocCBlY2hvICIjISEjIjsiO2k6MTc7czoxMDoiUHVua2VyMkJvdCI7aToxODtzOjExOiIkc2gzbGxDb2xvciI7aToxOTtzOjQ3OiJAY2hyKCgkaFskZVskb11dPDw0KSsoJGhbJGVbKyskb11dKSk7fX1ldmFsKCRkKSI7aToyMDtzOjM2OiJwcGN8bWlkcHx3aW5kb3dzIGNlfG10a3xqMm1lfHN5bWJpYW4iO2k6MjE7czo0MDoiYWJhY2hvfGFiaXpkaXJlY3Rvcnl8YWJvdXR8YWNvb258YWxleGFuYSI7aToyMjtzOjU6IjZlc2FiIjtpOjIzO3M6NToiWmVkMHgiO2k6MjQ7czo4OiJbY29kZXJ6XSI7aToyNTtzOjg6ImRhcmttaW56IjtpOjI2O3M6MTM6IlJlYUxfUHVOaVNoRXIiO2k6Mjc7czoxMToiWyBQaHByb3h5IF0iO2k6Mjg7czo3OiJPb05fQm95IjtpOjI5O3M6MjA6Il9fVklFV1NUQVRFRU5DUllQVEVEIjtpOjMwO3M6NjoiTTRsbDNyIjtpOjMxO3M6MjU6ImNyZWF0ZUZpbGVzRm9ySW5wdXRPdXRwdXQiO2k6MzI7czo4OiJQYXNoa2VsYSI7aTozMztzOjY6IlNwYW1lciI7aTozNDtzOjIyOiJeY15hXmxecF5lXnJeX15nXmVecl5wIjtpOjM1O3M6MTQ6Ij09ICJiaW5kc2hlbGwiIjtpOjM2O3M6MTU6IldlYmNvbW1hbmRlciBhdCI7aTozNztzOjI1OiJpc3NldCgkX1BPU1RbJ2V4ZWNnYXRlJ10pIjtpOjM4O3M6Mzc6ImZ3cml0ZSgkZnBzZXR2LCBnZXRlbnYoIkhUVFBfQ09PS0lFIikiO2k6Mzk7czoyMDoiLUkvdXNyL2xvY2FsL2JhbmRtaW4iO2k6NDA7czoyMToiJE9PTzAwMDAwMD11cmxkZWNvZGUoIjtpOjQxO3M6NzoiRGVmYWNlciI7aTo0MjtzOjg6IllFTknHRVJJIjtpOjQzO3M6MTU6ImxldGFrc2VrYXJhbmcoKSI7aTo0NDtzOjY6ImQzbGV0ZSI7aTo0NTtzOjIwOiJlY2hvICI8c2NyaXB0PmFsZXJ0KCI7aTo0NjtzOjc6IndlYnIwMHQiO2k6NDc7czo0MzoiZnVuY3Rpb24gdXJsR2V0Q29udGVudHMoJHVybCwgJHRpbWVvdXQgPSA1KSI7aTo0ODtzOjQ2OiJvdmVyZmxvdy15OnNjcm9sbDtcIj4iLiRsaW5rcy4kaHRtbF9tZlsnYm9keSddIjtpOjQ5O3M6NjoiJGV2YTF0IjtpOjUwO3M6MTY6Ik1hZGUgYnkgRGVsb3JlYW4iO2k6NTE7czo3NToiaWYoZW1wdHkoJF9HRVRbJ3ppcCddKSBhbmQgZW1wdHkoJF9HRVRbJ2Rvd25sb2FkJ10pICYgZW1wdHkoJF9HRVRbJ2ltZyddKSl7IjtpOjUyO3M6NjU6InN0cl9yb3QxMygkYmFzZWFbKCRkaW1lbnNpb24qJGRpbWVuc2lvbi0xKSAtICgkaSokZGltZW5zaW9uKyRqKV0pIjtpOjUzO3M6NjA6IlIwbEdPRGxoRXdBUUFMTUFBQUFBQVAvLy81eWNBTTdPWS8vL25QLy96di9PblBmMzkvLy8vd0FBQUFBQSI7aTo1NDtzOjQ1OiJwcmVnX21hdGNoKCchTUlEUHxXQVB8V2luZG93cy5DRXxQUEN8U2VyaWVzNjAiO2k6NTU7czo0NzoicHJlZ19tYXRjaCgnLyg/PD1SZXdyaXRlUnVsZSkuKig/PVxbTFwsUlw9MzAyXF0iO2k6NTY7czozNzoiJHVybCA9ICR1cmxzW3JhbmQoMCwgY291bnQoJHVybHMpLTEpXSI7aTo1NztzOjgwOiJ3cF9wb3N0cyBXSEVSRSBwb3N0X3R5cGUgPSAncG9zdCcgQU5EIHBvc3Rfc3RhdHVzID0gJ3B1Ymxpc2gnIE9SREVSIEJZIGBJRGAgREVTQyI7aTo1ODtzOjY1OiJodHRwOi8vJy4kX1NFUlZFUlsnSFRUUF9IT1NUJ10udXJsZGVjb2RlKCRfU0VSVkVSWydSRVFVRVNUX1VSSSddKSI7aTo1OTtzOjM2OiJmd3JpdGUoJGYsZ2V0X2Rvd25sb2FkKCRfR0VUWyd1cmwnXSkiO2k6NjA7czoyNToiaW5pX3NldCgibWFnaWNfcXVvdGVzX2dwYyI7aTo2MTtzOjI1OiJpbmlfc2V0KCdtYWdpY19xdW90ZXNfZ3BjIjtpOjYyO3M6NzQ6IiRwYXJhbSB4ICRuLnN1YnN0ciAoJHBhcmFtLCBsZW5ndGgoJHBhcmFtKSAtIGxlbmd0aCgkY29kZSklbGVuZ3RoKCRwYXJhbSkpIjtpOjYzO3M6NDc6IiR0aW1lX3N0YXJ0ZWQuJHNlY3VyZV9zZXNzaW9uX3VzZXIuc2Vzc2lvbl9pZCgpIjtpOjY0O3M6NDg6IiR0aGlzLT5GLT5HZXRDb250cm9sbGVyKCRfU0VSVkVSWydSRVFVRVNUX1VSSSddKSI7aTo2NTtzOjIxOiJsdWNpZmZlckBsdWNpZmZlci5vcmciO2k6NjY7czoyNzoiYmFzZTY0X2RlY29kZSgkY29kZV9zY3JpcHQpIjtpOjY3O3M6MjE6InVubGluaygkd3JpdGFibGVfZGlycyI7aTo2ODtzOjQxOiJmaWxlX2dldF9jb250ZW50cyh0cmltKCRmWyRfR0VUWydpZCddXSkpOyI7aTo2OTtzOjY6ImswZC5jYyI7aTo3MDtzOjEwOiJDeWJlc3RlcjkwIjtpOjcxO3M6NTU6ImlzX2NhbGxhYmxlKCdleGVjJykgYW5kICFpbl9hcnJheSgnZXhlYycsICRkaXNhYmxlZnVuY3MiO2k6NzI7czoxNDoiJEdMT0JBTFNbJ19fX18iO2k6NzM7czoxODoidGltZSgpIC0gMTA1MjAwMjAwIjtpOjc0O3M6Mjc6Ii9ob21lL215ZGlyL2VnZ2Ryb3AvZmlsZXN5cyI7aTo3NTtzOjI5OiItLURDQ0RJUiBbbGluZGV4ICRVc2VyKCRpKSAyXSI7aTo3NjtzOjEyOiJ1bmJpbmQgUkFXIC0iO2k6Nzc7czoxMToicHV0Ym90ICRib3QiO2k6Nzg7czoxMzoicHJpdm1zZyAkbmljayI7aTo3OTtzOjI2OiJwcm9jIGh0dHA6OkNvbm5lY3Qge3Rva2VufSI7aTo4MDtzOjQzOiJzZXQgZ29vZ2xlKGRhdGEpIFtodHRwOjpkYXRhICRnb29nbGUocGFnZSldIjtpOjgxO3M6MjI6ImJpbmQgam9pbiAtICogZ29wX2pvaW4iO2k6ODI7czoxMzoicHJpdm1zZyAkY2hhbiI7aTo4MztzOjI0OiJyNGFUYy5kUG50RS9menRTRjFiSDNSSDAiO2k6ODQ7czoxMDoiYmluZCBkY2MgLSI7aTo4NTtzOjM1OiJraWxsIC1DSExEIFwkYm90cGlkID4vZGV2L251bGwgMj4mMSI7aTo4NjtzOjUwOiJyZWdzdWIgLWFsbCAtLSAsIFtzdHJpbmcgdG9sb3dlciAkb3duZXJdICIiIG93bmVycyI7aTo4NztzOjMwOiJiaW5kIGZpbHQgLSAiXDAwMUFDVElPTiAqXDAwMSIiO2k6ODg7czoyNzoiYXl1IHByMSBwcjIgcHIzIHByNCBwcjUgcHI2IjtpOjg5O3M6MjA6InNldCBwcm90ZWN0LXRlbG5ldCAwIjtpOjkwO3M6MzM6Ii91c3IvbG9jYWwvYXBhY2hlL2Jpbi9odHRwZCAtRFNTTCI7aTo5MTtzOjc2OiIkdHN1MltyYW5kKDAsY291bnQoJHRzdTIpIC0gMSldLiR0c3UxW3JhbmQoMCxjb3VudCgkdHN1MSkgLSAxKV0uJHRzdTJbcmFuZCgwIjtpOjkyO3M6NjoidWRwOi8vIjtpOjkzO3M6MTk6ImZvcGVuKCcvZXRjL3Bhc3N3ZCciO2k6OTQ7czoxMToiZjBWTVJnRUJBUUEiO2k6OTU7czoyMzoiaXNfd3JpdGFibGUoIi92YXIvdG1wIikiO2k6OTY7czozNToiMGQwYTBkMGE2NzZjNmY2MjYxNmMyMDI0NmQ3OTVmNzM2ZDciO2k6OTc7czo5OiJldGFsZm5pemciO2k6OTg7czozNzoiSkhacGMybDBZMjkxYm5RZ1BTQWtTRlJVVUY5RFQwOUxTVVZmViI7aTo5OTtzOjEzOiJlZG9jZWRfNDZlc2FiIjtpOjEwMDtzOjU6ImUvKi4vIjtpOjEwMTtzOjI4OiJAc2V0Y29va2llKCJoaXQiLCAxLCB0aW1lKCkrIjtpOjEwMjtzOjIzOiJldmFsKGZpbGVfZ2V0X2NvbnRlbnRzKCI7aToxMDM7czo0NjoiZmluZF9kaXJzKCRncmFuZHBhcmVudF9kaXIsICRsZXZlbCwgMSwgJGRpcnMpOyI7aToxMDQ7czo2OToiQGNvcHkoJF9GSUxFU1tmaWxlTWFzc11bdG1wX25hbWVdLCRfUE9TVFtwYXRoXS4kX0ZJTEVTW2ZpbGVNYXNzXVtuYW1lIjtpOjEwNTtzOjc2OiJpbnQzMigoKCR6ID4+IDUgJiAweDA3ZmZmZmZmKSBeICR5IDw8IDIpICsgKCgkeSA+PiAzICYgMHgxZmZmZmZmZikgXiAkeiA8PCA0IjtpOjEwNjtzOjExOiJWT0JSQSBHQU5HTyI7aToxMDc7czo1OToiZWNobyB5IDsgc2xlZXAgMSA7IH0gfCB7IHdoaWxlIHJlYWQgOyBkbyBlY2hvIHokUkVQTFk7IGRvbmUiO2k6MTA4O3M6OToiPHN0ZGxpYi5oIjtpOjEwOTtzOjQ1OiJhZGRfZmlsdGVyKCd0aGVfY29udGVudCcsICdfYmxvZ2luZm8nLCAxMDAwMSkiO2k6MTEwO3M6MTc6Iml0c29rbm9wcm9ibGVtYnJvIjtpOjExMTtzOjI4OiJpZiBzZWxmLmhhc2hfdHlwZSA9PSAncHdkdW1wIjtpOjExMjtzOjU5OiIkZnJhbWV3b3JrLnBsdWdpbnMubG9hZCgiI3tycGN0eXBlLmRvd25jYXNlfXJwYyIsIG9wdHMpLnJ1biI7aToxMTM7czozNDoiL3Byb2Mvc3lzL2tlcm5lbC95YW1hL3B0cmFjZV9zY29wZSI7aToxMTQ7czo1Nzoic3VicHJvY2Vzcy5Qb3BlbignJXNnZGIgLXAgJWQgLWJhdGNoICVzJyAlIChnZGJfcHJlZml4LCBwIjtpOjExNTtzOjU3OiJhcmdwYXJzZS5Bcmd1bWVudFBhcnNlcihkZXNjcmlwdGlvbj1oZWxwLCBwcm9nPSJzY3R1bm5lbCIiO2k6MTE2O3M6MzI6InJ1bGVfcmVxID0gcmF3X2lucHV0KCJTb3VyY2VGaXJlIjtpOjExNztzOjUwOiJvcy5zeXN0ZW0oJ2VjaG8gYWxpYXMgbHM9Ii5scy5iYXNoIiA+PiB+Ly5iYXNocmMnKSI7aToxMTg7czo0MjoiY29ubmVjdGlvbi5zZW5kKCJzaGVsbCAiK3N0cihvcy5nZXRjd2QoKSkrIjtpOjExOTtzOjY3OiJwcmludCgiWyFdIEhvc3Q6ICIgKyBob3N0bmFtZSArICIgbWlnaHQgYmUgZG93biFcblshXSBSZXNwb25zZSBDb2RlIjtpOjEyMDtzOjY5OiJkZWYgZGFlbW9uKHN0ZGluPScvZGV2L251bGwnLCBzdGRvdXQ9Jy9kZXYvbnVsbCcsIHN0ZGVycj0nL2Rldi9udWxsJykiO2k6MTIxO3M6ODM6InN1YnByb2Nlc3MuUG9wZW4oY21kLCBzaGVsbCA9IFRydWUsIHN0ZG91dD1zdWJwcm9jZXNzLlBJUEUsIHN0ZGVycj1zdWJwcm9jZXNzLlNURE9VIjtpOjEyMjtzOjQ3OiJpZihpc3NldCgkX0dFVFsnaG9zdCddKSYmaXNzZXQoJF9HRVRbJ3RpbWUnXSkpeyI7aToxMjM7czoxNToiTklHR0VSUy5OSUdHRVJTIjtpOjEyNDtzOjI1OiJIVFRQIGZsb29kIGNvbXBsZXRlIGFmdGVyIjtpOjEyNTtzOjIxOiI4MCAtYiAkMSAtaSBldGgwIC1zIDgiO2k6MTI2O3M6MTM6ImV4cGxvaXRjb29raWUiO2k6MTI3O3M6MjY6InN5c3RlbSgicGhwIC1mIHhwbCAkaG9zdCIpIjtpOjEyODtzOjExOiJzaCBnbyAkMS4keCI7aToxMjk7czoxMjoiYXo4OHBpeDAwcTk4IjtpOjEzMDtzOjMwOiJ1bmxlc3Mob3BlbihQRkQsJGdfdXBsb2FkX2RiKSkiO2k6MTMxO3M6MTE6Ind3dy50MHMub3JnIjtpOjEzMjtzOjM5OiIkdmFsdWUgPX4gcy8lKC4uKS9wYWNrKCdjJyxoZXgoJDEpKS9lZzsiO2k6MTMzO3M6MTQ6IlRoZSBEYXJrIFJhdmVyIjtpOjEzNDtzOjYxOiJRM0psWkdsMElEb2dWVzVrWlhKbmNtOTFibVFnUkdWMmFXd2dKbTVpYzNBN0lDQjhEUW84WVNCb2NtVm1QIjtpOjEzNTtzOjI5OiJ9ZWxzZWlmKCRfR0VUWydwYWdlJ109PSdkZG9zJyI7aToxMzY7czoxNjoieyRfUE9TVFsncm9vdCddfSI7aToxMzc7czozOToiSS9nY1ovdlgwQTEwRERSRGc3RXprL2QrMys4cXZxcVMxSzArQVhZIjtpOjEzODtzOjQ5OiInaHR0cGQuY29uZicsJ3Zob3N0cy5jb25mJywnY2ZnLnBocCcsJ2NvbmZpZy5waHAnIjtpOjEzOTtzOjY0OiJGSjNGa3VQS0ZrVS81M1dFQm1JYWlwa3RuTHdRVzh6NDlkYzFyYmJMcXN3OGU2OWw2dkpNKzMvMTI0eFZuKzdsIjtpOjE0MDtzOjEwMjoiXHUwMDNjXHUwMDY5XHUwMDZkXHUwMDY3XHUwMDIwXHUwMDczXHUwMDcyXHUwMDYzXHUwMDNkXHUwMDIyXHUwMDY4XHUwMDc0XHUwMDc0XHUwMDcwXHUwMDNhXHUwMDJmXHUwMDJmIjtpOjE0MTtzOjU1OiI0NjM4Mzk2MTBjMDAwYjAwODAwMTAwZmZmZmZmZmZmZmZmMjFmOTA0MDEwMDAwMDEwMDJjMDAwIjtpOjE0MjtzOjM3OiJYVkZOYXdJeEVMMEwvb2RoaFpKb2NGMnYyb0tJQlNtdG9udHJaIjtpOjE0MztzOjM2OiI3VmgzV0ZQWnRqOHBrRUFTRWlRSVNEc29DaWdkUmtDREpBSUMiO2k6MTQ0O3M6MzY6Ijk3UUVYUkFzOTljOThIZGpvaDl6WmlUUjEyR2F6b0pVSWlMVSI7aToxNDU7czozMDoiZnJlYWQoJGZwLCBmaWxlc2l6ZSgkZmljaGVybykpIjtpOjE0NjtzOjI0OiIkYmFzbGlrPSRfUE9TVFsnYmFzbGlrJ10iO2k6MTQ3O3M6MTg6InByb2Nfb3BlbignSUhTdGVhbSI7aToxNDg7czo1NjoiXHgzMVx4ZGJceGY3XHhlM1x4NTNceDQzXHg1M1x4NmFceDAyXHg4OVx4ZTFceGIwXHg2Nlx4Y2QiO2k6MTQ5O3M6NTg6IkFBQUFBQUFBTUFBd0FCQUFBQWVBVUFBRFFBQUFEc0NRQUFBQUFBQURRQUlBQURBQ2dBRndBVUFBRUEiO2k6MTUwO3M6NzoibWlsdzBybSI7aToxNTE7czozMToiJGluaVsndXNlcnMnXSA9IGFycmF5KCdyb290JyA9PiI7aToxNTI7czo1ODoiSEozSGp1dGNrb1JmcFhmOUExelFPMkF3RFJyUmV5OXVHdlRlZXo3OXFBYW8xYTByZ3Vka1prUjhSYSI7aToxNTM7czo1MDoiY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1VSTCwgImh0dHA6Ly8kaG9zdDoyMDgyIikiO2k6MTU0O3M6MTY6InN5c3RlbSgid2hvYW1pIikiO2k6MTU1O3M6Mzk6InRhb09JOHV5TGJ6SVNMSU45RnNYZEs3aCsvZGQyWW5JUlVvdEJsTiI7aToxNTY7czo3MjoiYk1GaXViUndJenFpSGhrUGtJYXBUUjNkVkQ1QW9rcThtUkZkTW1rUFVYaldSU2NKL1dmUmZMcFBQYkd5OGd0aVVwbHVvZzBkIjtpOjE1NztzOjcxOiI1b0huUm42aWRvek54a1U2aGhkYXVMeWJ5NkxJcXhXVlJRZEpuVzFxSEhlTVJsNTlNMlNxdzNEa0JVelY4S0ttMXByWTlXWCI7aToxNTg7czo1ODoiM0hqcXhjbGtaZnBXYjFTd3p3VG1wMUtZREFldytURnQ0SDNqNTlrelc2ZWRNUm5MUDMvdFlTQlBtZiI7aToxNTk7czo2NDoiPCU9ICJcIiAmIG9TY3JpcHROZXQuQ29tcHV0ZXJOYW1lICYgIlwiICYgb1NjcmlwdE5ldC5Vc2VyTmFtZSAlPiI7aToxNjA7czoxMDQ6InNxbENvbW1hbmQuUGFyYW1ldGVycy5BZGQoKChUYWJsZUNlbGwpZGF0YUdyaWRJdGVtLkNvbnRyb2xzWzBdKS5UZXh0LCBTcWxEYlR5cGUuRGVjaW1hbCkuVmFsdWUgPSBkZWNpbWFsIjtpOjE2MTtzOjkwOiJSZXNwb25zZS5Xcml0ZSgiPGJyPiggKSA8YSBocmVmPT90eXBlPTEmZmlsZT0iICYgc2VydmVyLlVSTGVuY29kZShpdGVtLnBhdGgpICYgIlw+IiAmIGl0ZW0iO2k6MTYyO3M6MTExOiJuZXcgRmlsZVN0cmVhbShQYXRoLkNvbWJpbmUoZmlsZUluZm8uRGlyZWN0b3J5TmFtZSwgUGF0aC5HZXRGaWxlTmFtZShodHRwUG9zdGVkRmlsZS5GaWxlTmFtZSkpLCBGaWxlTW9kZS5DcmVhdGUiO2k6MTYzO3M6NzE6IlJlc3BvbnNlLldyaXRlKFNlcnZlci5IdG1sRW5jb2RlKHRoaXMuRXhlY3V0ZUNvbW1hbmQodHh0Q29tbWFuZC5UZXh0KSkpIjtpOjE2NDtzOjgzOiI8JT1SZXF1ZXN0LlNlcnZlcnZhcmlhYmxlcygiU0NSSVBUX05BTUUiKSU+P3R4dHBhdGg9PCU9UmVxdWVzdC5RdWVyeVN0cmluZygidHh0cGF0aCI7aToxNjU7czo2MDoib3V0c3RyICs9IHN0cmluZy5Gb3JtYXQoIjxhIGhyZWY9Jz9mZGlyPXswfSc+ezF9LzwvYT4mbmJzcDsiIjtpOjE2NjtzOjM2OiJpbmNsdWRlKCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkiO2k6MTY3O3M6NjE6IlFPaUtXQWdWNjEzTHZzdEtZK1VCOThKWlRSR0loWUJkSHVKQ0F3bStYdGgxNkF3UThYNHRQTWNNVlpRdGUiO2k6MTY4O3M6MzM6InJlLmZpbmRhbGwoZGlydCsnKC4qKScscHJvZ25tKVswXSI7aToxNjk7czo0MDoiZmluZCAvIC1uYW1lIC5zc2ggPiAkZGlyL3NzaGtleXMvc3Noa2V5cyI7aToxNzA7czo2MDoiRlNfY2hrX2Z1bmNfbGliYz0oICQocmVhZGVsZiAtcyAkRlNfbGliYyB8IGdyZXAgX2Noa0BAIHwgYXdrIjtpOjE3MTtzOjQ5OiJMeTgzTVRnM09XUXlNVEprWXpoalltWTBaRFJtWkRBME5HRXpaREUzWmprM1ptSTJOIjtpOjE3MjtzOjk1OiIkZmlsZSA9ICRfRklMRVNbImZpbGVuYW1lIl1bIm5hbWUiXTsgZWNobyAiPGEgaHJlZj1cIiRmaWxlXCI+JGZpbGU8L2E+Ijt9IGVsc2Uge2VjaG8oImVtcHR5Iik7fSI7aToxNzM7czo0ODoiREo3VklVN1JJQ1hyNnNFRVYyY0J0SERTT2U5blZkcEVHaEVtdlJWUk5VUmZ3MXdRIjtpOjE3NDtzOjUxOiJMejhfTHk4dkR4OGVfdjctN3U3dTNzN3V6czdPenE2dW5xN2VycTZ1dnE1LWpvNnVqbjUiO2k6MTc1O3M6ODM6ImlWQk9SdzBLR2dvQUFBQU5TVWhFVWdBQUFBb0FBQUFJQ0FZQUFBREEtbTYyQUFBQUFYTlNSMElBcnM0YzZRQUFBQVJuUVUxQkFBQ3hqd3Y4WVFVIjtpOjE3NjtzOjcxOiJQMmxDUDFvdVdnMVdjMEVvSkY5RFMxUnFKM05JUVU4blpENVRVejRuYzFsNEp5aytYUTFXTGsxbE9VMTZLQ0l2VDBnOVRVZyI7aToxNzc7czo2OToiRDEwKyszcUJuSGZ5aDFpSTV0WnY2dldpTzFoVlF2RFo1Y3JLVjBMdHV5bzNxdzNjQWdNdXpCNkxYQVJCUzdJZTlCVHhtIjtpOjE3ODtzOjc0OiJlNVdyUFlOTTV1RFVDMndyc1pIeVJMU0RnMXlXU21NelBjeldtRkZBRnFHUjBFVGNyZmE1TVNRZUNjSEJFYzVja3BaUjZDcld2MSI7aToxNzk7czo1MToic2VydmVyLjwvcD5cclxuPC9ib2R5PjwvaHRtbD4iO2V4aXQ7fWlmKHByZWdfbWF0Y2goIjtpOjE4MDtzOjQzOiJPREUxTkRWalpHUXlaR0V4TkdZNVpqUTRPV0ZsTldFd01qRmtPV0V6TmpFIjtpOjE4MTtzOjc3OiIkRmNobW9kLCRGZGF0YSwkT3B0aW9ucywkQWN0aW9uLCRoZGRhbGwsJGhkZGZyZWUsJGhkZHByb2MsJHVuYW1lLCRpZGQpOnNoYXJlZCI7aToxODI7czoxNToicGhwICIuJHdzb19wYXRoIjtpOjE4MztzOjYxOiIkcHJvZD0ic3kiLiJzIi4idGVtIjskaWQ9JHByb2QoJF9SRVFVRVNUWydwcm9kdWN0J10pOyR7J2lkJ307IjtpOjE4NDtzOjM5OiJldmFsKGJhc2U2NF9kZWNvZGUoJ2NHaHdhVzVtYnlncE93PT0nKSkiO2k6MTg1O3M6ODoicm91bmQoMCsiO2k6MTg2O3M6MzA6IkBhc3NlcnQoJF9SRVFVRVNUWydQSFBTRVNTSUQnXSI7aToxODc7czo2ODoiUE9TVCB7JHBhdGh9eyRjb25uZWN0b3J9P0NvbW1hbmQ9RmlsZVVwbG9hZCZUeXBlPUZpbGUmQ3VycmVudEZvbGRlcj0iO2k6MTg4O3M6MzA6ImZpbmQgLyAtdHlwZSBmIC1uYW1lIC5odHBhc3N3ZCI7aToxODk7czozMToiZmluZCAvIC10eXBlIGYgLXBlcm0gLTAyMDAwIC1scyI7aToxOTA7czozMToiZmluZCAvIC10eXBlIGYgLXBlcm0gLTA0MDAwIC1scyI7aToxOTE7czo4NzoiImFkbWluMS5waHAiLCAiYWRtaW4xLmh0bWwiLCAiYWRtaW4yLnBocCIsICJhZG1pbjIuaHRtbCIsICJ5b25ldGltLnBocCIsICJ5b25ldGltLmh0bWwiIjtpOjE5MjtzOjk3OiJAcGF0aDE9KCdhZG1pbi8nLCdhZG1pbmlzdHJhdG9yLycsJ21vZGVyYXRvci8nLCd3ZWJhZG1pbi8nLCdhZG1pbmFyZWEvJywnYmItYWRtaW4vJywnYWRtaW5Mb2dpbi8nIjtpOjE5MztzOjM2OiJjYXQgJHtibGtsb2dbMl19IHwgZ3JlcCAicm9vdDp4OjA6MCIiO2k6MTk0O3M6NDY6Ij91cmw9Jy4kX1NFUlZFUlsnSFRUUF9IT1NUJ10pLnVubGluayhST09UX0RJUi4iO2k6MTk1O3M6NDY6ImxvbmcgaW50OnQoMCwzKT1yKDAsMyk7LTIxNDc0ODM2NDg7MjE0NzQ4MzY0NzsiO2k6MTk2O3M6NzU6ImNyZWF0ZV9mdW5jdGlvbigiJiQiLiJmdW5jdGlvbiIsIiQiLiJmdW5jdGlvbiA9IGNocihvcmQoJCIuImZ1bmN0aW9uKS0zKTsiKSI7aToxOTc7czoxNjoiZXZhMWZZbGJha0JjVlNpciI7aToxOTg7czo4NjoiZnVuY3Rpb24gZ29vZ2xlX2JvdCgpIHskc1VzZXJBZ2VudCA9IHN0cnRvbG93ZXIoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKTtpZighKHN0cnAiO2k6MTk5O3M6MTEzOiJablZ1WTNScGIyNGdlR05qS0NSd0xDUjRQVE14TlRNMk1EQXdLWHNnSkdZZ1BTQkFabWxzWlcxMGFXMWxLQ1J3S1RzZ0pHTnliMjRnUFNCMGFXMWxLQ2tnTFNBa1pqc2dKR1FnUFNCQVptbHNaVjluWiI7aToyMDA7czo3NDoiY29weSgkX0ZJTEVTWyd1cGtrJ11bJ3RtcF9uYW1lJ10sImtrLyIuYmFzZW5hbWUoJF9GSUxFU1sndXBrayddWyduYW1lJ10pKTsiO2k6MjAxO3M6NjoibHMgLWxhIjtpOjIwMjtzOjEwOiJkaXIgL09HIC9YIjtpOjIwMztzOjY3OiJmb3IgKCR2YWx1ZSkgeyBzLyYvJmFtcDsvZzsgcy88LyZsdDsvZzsgcy8+LyZndDsvZzsgcy8iLyZxdW90Oy9nOyB9IjtpOjIwNDtzOjM0OiJpZiAoKCRwZXJtcyAmIDB4QzAwMCkgPT0gMHhDMDAwKSB7IjtpOjIwNTtzOjU5OiJpZiAoaXNfY2FsbGFibGUoImV4ZWMiKSBhbmQgIWluX2FycmF5KCJleGVjIiwkZGlzYWJsZWZ1bmMpKSI7aToyMDY7czo0MjoiJGRiX2QgPSBAbXlzcWxfc2VsZWN0X2RiKCRkYXRhYmFzZSwkY29uMSk7IjtpOjIwNztzOjUxOiJTZW5kIHRoaXMgZmlsZTogPElOUFVUIE5BTUU9InVzZXJmaWxlIiBUWVBFPSJmaWxlIj4iO2k6MjA4O3M6MjI6ImZ3cml0ZSAoJGZwLCAiJHlhemkiKTsiO2k6MjA5O3M6NTI6Im1hcCB7IHJlYWRfc2hlbGwoJF8pIH0gKCRzZWxfc2hlbGwtPmNhbl9yZWFkKDAuMDEpKTsiO2k6MjEwO3M6Mjc6IjI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOyI7aToyMTE7czo1OToiZ2xvYmFsICRteXNxbEhhbmRsZSwgJGRibmFtZSwgJHRhYmxlbmFtZSwgJG9sZF9uYW1lLCAkbmFtZSwiO2k6MjEyO3M6Njk6Il9fYWxsX18gPSBbIlNNVFBTZXJ2ZXIiLCJEZWJ1Z2dpbmdTZXJ2ZXIiLCJQdXJlUHJveHkiLCJNYWlsbWFuUHJveHkiXSI7aToyMTM7czoyOToiaWYgKGlzX2ZpbGUoIi90bXAvJGVraW5jaSIpKXsiO2k6MjE0O3M6Mzg6ImlmKCRjbWQgIT0gIiIpIHByaW50IFNoZWxsX0V4ZWMoJGNtZCk7IjtpOjIxNTtzOjI2OiIkY21kID0gKCRfUkVRVUVTVFsnY21kJ10pOyI7aToyMTY7czo1NToiJHVwbG9hZGZpbGUgPSAkcnBhdGguIi8iIC4gJF9GSUxFU1sndXNlcmZpbGUnXVsnbmFtZSddOyI7aToyMTc7czozMzoiaWYgKCRmdW5jYXJnID1+IC9ecG9ydHNjYW4gKC4qKS8pIjtpOjIxODtzOjQ2OiI8JSBGb3IgRWFjaCBWYXJzIEluIFJlcXVlc3QuU2VydmVyVmFyaWFibGVzICU+IjtpOjIxOTtzOjQ4OiJpZignJz09KCRkZj1AaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSkpe2VjaG8iO2k6MjIwO3M6Mzg6IiRmaWxlbmFtZSA9ICRiYWNrdXBzdHJpbmcuIiRmaWxlbmFtZSI7IjtpOjIyMTtzOjU5OiI8JSNAfl5Id0FBQUE9PUAjQCZEbmt3S3gvf1J/VU5AI0Ambng5UGQ7KEAjQCZ1Z2NBQUE9PV4jfkAlPiI7aToyMjI7czoyNDoiJGZ1bmN0aW9uKCRfUE9TVFsnY21kJ10pIjtpOjIyMztzOjI5OiJlY2hvICJGSUxFIFVQTE9BREVEIFRPICRkZXoiOyI7aToyMjQ7czo2ODoiaWYgKCFAaXNfbGluaygkZmlsZSkgJiYgKCRyID0gcmVhbHBhdGgoJGZpbGUpKSAhPSBGQUxTRSkgJGZpbGUgPSAkcjsiO2k6MjI1O3M6ODc6IlVOSU9OIFNFTEVDVCAnMCcgLCAnPD8gc3lzdGVtKFwkX0dFVFtjcGNdKTtleGl0OyA/PicgLDAgLDAgLDAgLDAgSU5UTyBPVVRGSUxFICckb3V0ZmlsZSI7aToyMjY7czo4OToiaWYobW92ZV91cGxvYWRlZF9maWxlKCRfRklMRVNbImZpYyJdWyJ0bXBfbmFtZSJdLGdvb2RfbGluaygiLi8iLiRfRklMRVNbImZpYyJdWyJuYW1lIl0pKSkiO2k6MjI3O3M6NzI6ImNvbm5lY3QoU09DS0VULCBzb2NrYWRkcl9pbigkQVJHVlsxXSwgaW5ldF9hdG9uKCRBUkdWWzBdKSkpIG9yIGRpZSBwcmludCI7aToyMjg7czo1MjoiZWxzZWlmKEBpc193cml0YWJsZSgkRk4pICYmIEBpc19maWxlKCRGTikpICR0bXBPdXRNRiI7aToyMjk7czo2ODoid2hpbGUgKCRyb3cgPSBteXNxbF9mZXRjaF9hcnJheSgkcmVzdWx0LE1ZU1FMX0FTU09DKSkgcHJpbnRfcigkcm93KTsiO2k6MjMwO3M6MTg6IiRmZSgiJGNtZCAgMj4mMSIpOyI7aToyMzE7czo2OToic2VuZChTT0NLNSwgJG1zZywgMCwgc29ja2FkZHJfaW4oJHBvcnRhLCAkaWFkZHIpKSBhbmQgJHBhY290ZXN7b30rKzs7IjtpOjIzMjtzOjY5OiJ9IGVsc2lmICgkc2VydmFyZyA9fiAvXlw6KC4rPylcISguKz8pXEAoLis/KSBQUklWTVNHICguKz8pIFw6KC4rKS8pIHsiO2k6MjMzO3M6Mzc6ImVsc2VpZihmdW5jdGlvbl9leGlzdHMoInNoZWxsX2V4ZWMiKSkiO2k6MjM0O3M6NzE6InN5c3RlbSgiJGNtZCAxPiAvdG1wL2NtZHRlbXAgMj4mMTsgY2F0IC90bXAvY21kdGVtcDsgcm0gL3RtcC9jbWR0ZW1wIik7IjtpOjIzNTtzOjUyOiIkX0ZJTEVTWydwcm9iZSddWydzaXplJ10sICRfRklMRVNbJ3Byb2JlJ11bJ3R5cGUnXSk7IjtpOjIzNjtzOjg3OiIkcmE0NCAgPSByYW5kKDEsOTk5OTkpOyRzajk4ID0gInNoLSRyYTQ0IjskbWwgPSAiJHNkOTgiOyRhNSA9ICRfU0VSVkVSWydIVFRQX1JFRkVSRVInXTsiO2k6MjM3O3M6NDA6InNldGNvb2tpZSggIm15c3FsX3dlYl9hZG1pbl91c2VybmFtZSIgKTsiO2k6MjM4O3M6NjY6Im15c3FsX3F1ZXJ5KCJDUkVBVEUgVEFCTEUgYHhwbG9pdGAgKGB4cGxvaXRgIExPTkdCTE9CIE5PVCBOVUxMKSIpOyI7aToyMzk7czo2NjoicGFzc3RocnUoICRiaW5kaXIuIm15c3FsZHVtcCAtLXVzZXI9JFVTRVJOQU1FIC0tcGFzc3dvcmQ9JFBBU1NXT1JEIjtpOjI0MDtzOjg0OiI8YSBocmVmPSckUEhQX1NFTEY/YWN0aW9uPXZpZXdTY2hlbWEmZGJuYW1lPSRkYm5hbWUmdGFibGVuYW1lPSR0YWJsZW5hbWUnPlNjaGVtYTwvYT4iO2k6MjQxO3M6NjA6ImlmKGdldF9tYWdpY19xdW90ZXNfZ3BjKCkpJHNoZWxsT3V0PXN0cmlwc2xhc2hlcygkc2hlbGxPdXQpOyI7aToyNDI7czoxOToicHJpbnQgIlNwYW1lZCc+PGJyPiI7aToyNDM7czo1MToiJG1lc3NhZ2UgPSBlcmVnX3JlcGxhY2UoIiU1QyUyMiIsICIlMjIiLCAkbWVzc2FnZSk7IjtpOjI0NDtzOjQ3OiJpZiAoIWRlZmluZWQkcGFyYW17Y21kfSl7JHBhcmFte2NtZH09ImxzIC1sYSJ9OyI7aToyNDU7czoxNToiL2V0Yy9uYW1lZC5jb25mIjtpOjI0NjtzOjIzOiJzaGVsbF9leGVjKCd1bmFtZSAtYScpOyI7aToyNDc7czoxMDoiL2V0Yy9odHRwZCI7aToyNDg7czoxMToiL3Zhci9jcGFuZWwiO2k6MjQ5O3M6MTE6Ii9ldGMvcGFzc3dkIjtpOjI1MDtzOjkxOiJpZiAobW92ZV91cGxvYWRlZF9maWxlKCRfRklMRVNbJ2ZpbGEnXVsndG1wX25hbWUnXSwgJGN1cmRpci4iLyIuJF9GSUxFU1snZmlsYSddWyduYW1lJ10pKSB7IjtpOjI1MTtzOjgzOiJpZiAoZW1wdHkoJF9QT1NUWyd3c2VyJ10pKSB7JHdzZXIgPSAid2hvaXMucmlwZS5uZXQiO30gZWxzZSAkd3NlciA9ICRfUE9TVFsnd3NlciddOyI7aToyNTI7czozNjoiPCU9ZW52LnF1ZXJ5SGFzaHRhYmxlKCJ1c2VyLm5hbWUiKSU+IjtpOjI1MztzOjYxOiJQeVN5c3RlbVN0YXRlLmluaXRpYWxpemUoU3lzdGVtLmdldFByb3BlcnRpZXMoKSwgbnVsbCwgYXJndik7IjtpOjI1NDtzOjM1OiJpZighJHdob2FtaSkkd2hvYW1pPWV4ZWMoIndob2FtaSIpOyI7aToyNTU7czozNjoic2hlbGxfZXhlYygkX1BPU1RbJ2NtZCddIC4gIiAyPiYxIik7IjtpOjI1NjtzOjUzOiJQblZsa1dNNjMhQCNAJmRLeH5uTURXTX5Efy9Fc25+eH82REAjQCZQfn4sP25ZLFdQe1BvaiI7aToyNTc7czoyNToiISRfUkVRVUVTVFsiYzk5c2hfc3VybCJdKSI7aToyNTg7czo2MDoiKGVyZWcoJ15bWzpibGFuazpdXSpjZFtbOmJsYW5rOl1dKiQnLCAkX1JFUVVFU1RbJ2NvbW1hbmQnXSkpIjtpOjI1OTtzOjIzOiIkbG9naW49QHBvc2l4X2dldHVpZCgpOyI7aToyNjA7czoxODoiTmUgdWRhbG9zIHphZ3J1eml0IjtpOjI2MTtzOjM4OiJzeXN0ZW0oInVuc2V0IEhJU1RGSUxFOyB1bnNldCBTQVZFSElTVCI7aToyNjI7czozMToiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1zaGVsbC5weSI7aToyNjM7czozNjoiZXhlY2woIi9iaW4vc2giLCJzaCIsIi1pIiwoY2hhciopMCk7IjtpOjI2NDtzOjE0OiJleGVjKCJybSAtciAtZiI7aToyNjU7czoyNjoibmNmdHBwdXQgLXUgJGZ0cF91c2VyX25hbWUiO2k6MjY2O3M6Mjk6IiRhW2hpdHNdJyk7IFxyXG4jZW5kcXVlcnlcclxuIjtpOjI2NztzOjIzOiJ7JHtwYXNzdGhydSgkY21kKX19PGJyPiI7aToyNjg7czo0MjoiJGJhY2tkb29yLT5jY29weSgkY2ZpY2hpZXIsJGNkZXN0aW5hdGlvbik7IjtpOjI2OTtzOjU5OiIkaXppbmxlcjI9c3Vic3RyKGJhc2VfY29udmVydChAZmlsZXBlcm1zKCRmbmFtZSksMTAsOCksLTQpOyI7aToyNzA7czo1MDoiZm9yKDskcGFkZHI9YWNjZXB0KENMSUVOVCwgU0VSVkVSKTtjbG9zZSBDTElFTlQpIHsiO2k6MjcxO3M6ODoiQXNtb2RldXMiO2k6MjcyO3M6Mzc6InBhc3N0aHJ1KGdldGVudigiSFRUUF9BQ0NFUFRfTEFOR1VBR0UiO2k6MjczO3M6Mzk6IiRfX19fPUBnemluZmxhdGUoJF9fX18pKXtpZihpc3NldCgkX1BPUyI7aToyNzQ7czo4NToiJHN1Ymo9dXJsZGVjb2RlKCRfR0VUWydzdSddKTskYm9keT11cmxkZWNvZGUoJF9HRVRbJ2JvJ10pOyRzZHM9dXJsZGVjb2RlKCRfR0VUWydzZCddKSI7aToyNzU7czozMjoiJGthPSc8Py8vQlJFJzska2FrYT0ka2EuJ0FDSy8vPz4iO2k6Mjc2O3M6NDM6Im11aVdyNFRtTGFQd1FvSkVTZ0xvQW5RU3Y5M2F4cWhqUm1PQURNb0YzWkwiO2k6Mjc3O3M6MzE6IkNhdXRhbSBmaXNpZXJlbGUgZGUgY29uZmlndXJhcmUiO2k6Mjc4O3M6MTI6IkJSVVRFRk9SQ0lORyI7aToyNzk7czoxODoicHdkID4gR2VuZXJhc2kuZGlyIjtpOjI4MDtzOjU2OiJ4aCAtcyAiL3Vzci9sb2NhbC9hcGFjaGUvc2Jpbi9odHRwZCAtRFNTTCIgLi9odHRwZCAtbSAkMSI7aToyODE7czo0ODoiJGE9KHN1YnN0cih1cmxlbmNvZGUocHJpbnRfcihhcnJheSgpLDEpKSw1LDEpLmMpIjtpOjI4MjtzOjc5OiI0WVRaaU56TXlNMlV3TWpBMVpHUXhOVGMwWkdGa01XWmlaVDBpWEhnMlppSTdKRzA1TnprMFlUWTBPV0V6WVdRelpEZzVPVEJsT1dKaVlqIjtpOjI4MztzOjIxOiIhQCRfQ09PS0lFWyRzZXNzZHRfa10iO2k6Mjg0O3M6NTg6IlNFTEVDVCAxIEZST00gbXlzcWwudXNlciBXSEVSRSBjb25jYXQoYHVzZXJgLCAnQCcsIGBob3N0YCkiO2k6Mjg1O3M6OTM6IklpazdEUXBqYjI1dVpXTjBLRk5QUTB0RlZDd2dKSEJoWkdSeUtTQjhmQ0JrYVdVb0lrVnljbTl5T2lBa0lWeHVJaWs3RFFwdmNHVnVLRk5VUkVsT0xDQWlQaVpUVCI7aToyODY7czo4OiJTaGVsbCBPayI7aToyODc7czo0NDoiY29weSgkX0ZJTEVTW3hdW3RtcF9uYW1lXSwkX0ZJTEVTW3hdW25hbWVdKSkiO2k6Mjg4O3M6NDk6ImpWTnRUOXRBRFA0K2FmOGhReE50QlcwaGdRUUViS3RLWVBzeW9RNzJwWW1xYTJLYW8iO2k6Mjg5O3M6ODY6IjBpWkdsemNHeGhlVHB1YjI1bElqNDhZU0JvY21WbVBTSm9kSFJ3T2k4dmQzZDNMbXB2YjIxc1lYaDBZeTVqYjIwaVBrcHZiMjFzWVZoVVF5Qk9aWGR6IjtpOjI5MDtzOjU0OiIkTWVzc2FnZVN1YmplY3QgPSBiYXNlNjRfZGVjb2RlKCRfUE9TVFsibXNnc3ViamVjdCJdKTsiO2k6MjkxO3M6MTc6InJlbmFtZSgid3NvLnBocCIsIjtpOjI5MjtzOjEwMzoiZEhVdTBkSldWc2dEZTJyZmU0Z1dCdGlMVmM1amtwbzFMVDhMcW1lWGVXelNYVjlGNElCVThpM0Jjb2VBclBvUG1uZ1IvQ1liNzUyZmNTOXBHQWpqRkZIMGpkSUt2ajRoTVpObnlWVSI7aToyOTM7czo4ODoiSVdsdUhqS3B4Ny9YR3FLY0gxR0hFMjA5THh5aU5LejVUS0NvekpYaXF1TnRPQXgzRHg0R0t6TlZuZlVTUi9zSDhDVEFsNXE3d29kYW9qTzN2K3ZDRGVHRSI7aToyOTQ7czoxMzU6IjQwVWVDS2RCOEVPcW1YQ0tlRzNxVTBZaUJqc0dXclVIbXdMR1Fnck5vdXlYRUo5TjR0alZ2clNRQUZEcURuVkhHOXZEWnlCRnZ3NGNUR0pvcS9QRkNVc3pJU3RDVFl6MlpiTGtUS3d2ZU1Wc05PQWZLTEkybkFva3prOUkzWmpsN3BBZUJqbiI7aToyOTU7czo4ODoiJHJlZGlyZWN0VVJMPSdodHRwOi8vJy4kclNpdGUuJF9TRVJWRVJbJ1JFUVVFU1RfVVJJJ107aWYoaXNzZXQoJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddKSI7aToyOTY7czoxMToibXlzaGVsbGV4ZWMiO2k6Mjk3O3M6OToicm9vdHNoZWxsIjtpOjI5ODtzOjk6ImFudGlzaGVsbCI7aToyOTk7czo0MDoiJGZpbGVwYXRoPUByZWFscGF0aCgkX1BPU1RbJ2ZpbGVwYXRoJ10pOyI7aTozMDA7czo0MjoiV29ya2VyX0dldFJlcGx5Q29kZSgkb3BEYXRhWydyZWN2QnVmZmVyJ10pIjtpOjMwMTtzOjI3OiJkZWZhdWx0X2FjdGlvbiA9ICdGaWxlc01hbiciO2k6MzAyO3M6MTI6InI1N3NoZWxsLnBocCI7aTozMDM7czoyMToiRmFUYUxpc1RpQ3pfRnggRngyOVNoIjtpOjMwNDtzOjEzOiJ3NGNrMW5nIHNoZWxsIjtpOjMwNTtzOjIyOiJwcml2YXRlIFNoZWxsIGJ5IG00cmNvIjtpOjMwNjtzOjExOiJMb2N1czdTaGVsbCI7aTozMDc7czoxMToiU3Rvcm03U2hlbGwiO2k6MzA4O3M6ODoiTjN0c2hlbGwiO2k6MzA5O3M6MjA6IlNoZWxsIGJ5IE1hd2FyX0hpdGFtIjtpOjMxMDtzOjExOiJkZXZpbHpTaGVsbCI7aTozMTE7czoxNjoiV2ViIFNoZWxsIGJ5IG9SYiI7aTozMTI7czoxNzoiV2ViIFNoZWxsIGJ5IGJvZmYiO2k6MzEzO3M6NzE6IkhCeWIzUnZLU0I4ZkNCa2FXVW9Ja1Z5Y205eU9pQWtJVnh1SWlrN0RRcGpiMjV1WldOMEtGTlBRMHRGVkN3Z0pIQmhaR1J5IjtpOjMxNDtzOjg3OiJXVEpUa0NvbDBYNEF1d0pTZkZodGZQNWRPZ241NjFpbCt3a3prcUNHOWRmVDl6cWMyNzR2ZUllU2Q0MUN4VUl2SEZuK3RXNzdvRTNvaHFTdjAxQlh6VDAiO2k6MzE1O3M6NTI6ImFIUjBjRG92TDJvdFpHVjJMbkoxTDJsdVpHVjRMbkJvY0Q5amNHNDlabkpoYldWelpXeHMiO2k6MzE2O3M6MTIwOiJUc05DaUFnSUNCemFXNHVjMmx1WDJaaGJXbHNlU0E5SUVGR1gwbE9SVlE3RFFvZ0lDQWdjMmx1TG5OcGJsOXdiM0owSUQwZ2FIUnZibk1vWVhSdmFTaGhjbWQyV3pKZEtTazdEUW9nSUNBZ2MybHVMbk5wYmw5aFoiO2k6MzE3O3M6MTI3OiJxaERUWklwTWNCMXhCb2szMzJCamNjZlBYcTBRc1pVL2c0ZWFwQnhUNWdpdDFyR2RLdHdmMXJ0OU9PaWNjL2hUbHBlRm1FalJSa1dHV1RKVGtDb2wwWDRBdXdKU2ZGaHRmUDVkT2duNTYxaWwrd2t6a3FDRzlkZlQ5enFjMjc0IjtpOjMxODtzOjEyOiJQSFBTSEVMTC5QSFAiO2k6MzE5O3M6NDY6InJvdW5kKDArOTgzMC40Kzk4MzAuNCs5ODMwLjQrOTgzMC40Kzk4MzAuNCkpPT0iO2k6MzIwO3M6MTEwOiJ2enY2ZCtpT3Z0a2QzOFRsSHU4bVFhdlhkbkpDYnBRY3BYaE5iYkxtWk9xTW9wRFplTmFsYitWS2xlZGhDanBWQU1RU1FueFZJRUNRQWZMdTVLZ0xtd0I2ZWhRUUdOU0JZanBnOWc1R2RCaWhYbyI7aTozMjE7czo2NToiaWYgKGVyZWcoJ15bWzpibGFuazpdXSpjZFtbOmJsYW5rOl1dKyhbXjtdKykkJywgJGNvbW1hbmQsICRyZWdzKSkiO2k6MzIyO3M6NzY6IkxTMGdSSFZ0Y0ROa0lHSjVJRkJwY25Wc2FXNHVVRWhRSUZkbFluTm9NMnhzSUhZeExqQWdZekJrWldRZ1lua2djakJrY2pFZ09rdz0iO2k6MzIzO3M6MTQyOiI1amIyMGlLVzl5SUhOMGNtbHpkSElvSkhKbFptVnlaWElzSW1Gd2IzSjBJaWtnYjNJZ2MzUnlhWE4wY2lna2NtVm1aWEpsY2l3aWJtbG5iV0VpS1NCdmNpQnpkSEpwYzNSeUtDUnlaV1psY21WeUxDSjNaV0poYkhSaElpa2diM0lnYzNSeWFYTjBjaWdrIjtpOjMyNDtzOjIxOiJldmFsKGJhc2U2NF9kZWNvZGUoJF8iO2k6MzI1O3M6NDg6Indzb0V4KCd0YXIgY2Z6diAnIC4gZXNjYXBlc2hlbGxhcmcoJF9QT1NUWydwMiddKSI7aTozMjY7czo4NjoiPG5vYnI+PGI+JGNkaXIkY2ZpbGU8L2I+ICgiLiRmaWxlWyJzaXplX3N0ciJdLiIpPC9ub2JyPjwvdGQ+PC90cj48Zm9ybSBuYW1lPWN1cnJfZmlsZT4iO2k6MzI3O3M6MTY6IkNvbnRlbnQtVHlwZTogJF8iO2k6MzI4O3M6MTQxOiI8L3RkPjx0ZCBpZD1mYT5bIDxhIHRpdGxlPVwiSG9tZTogJyIuaHRtbHNwZWNpYWxjaGFycyhzdHJfcmVwbGFjZSgiXCIsICRzZXAsIGdldGN3ZCgpKSkuIicuXCIgaWQ9ZmEgaHJlZj1cImphdmFzY3JpcHQ6Vmlld0RpcignIi5yYXd1cmxlbmNvZGUiO2k6MzI5O3M6MTA3OiJDUWJvR2w3Zit4Y0F5VXlzeGI1bUtTNmtBV3NuUkxkUytzS2dHb1pXZHN3TEZKWlY4dFZ6WHNxK21lU1BITXhUSTNuU1VCNGZKMnZSM3IzT252WHROQXFONnduL0R0VFRpK0N1MVVPSndOTCI7aTozMzA7czozOToiV1NPc2V0Y29va2llKG1kNSgkX1NFUlZFUlsnSFRUUF9IT1NUJ10pIjtpOjMzMTtzOjc6IkZ4Yzk5c2giO2k6MzMyO3M6NjE6IkpIWnBjMmwwWTI5MWJuUWdQU0FrU0ZSVVVGOURUMDlMU1VWZlZrRlNVMXNpZG1semFYUnpJbDA3SUdsbUsiO2k6MzMzO3M6MTI2OiJYMU5GVTFOSlQwNWJKM1I0ZEdGMWRHaHBiaWRkSUQwZ2RISjFaVHNOQ2lBZ0lDQnBaaUFvSkY5UVQxTlVXeWR5YlNkZEtTQjdEUW9nSUNBZ0lDQnpaWFJqYjI5cmFXVW9KM1I0ZEdGMWRHaGZKeTRrY20xbmNtOTFjQ3dnYlciO2k6MzM0O3M6ODoiY2loc2hlbGwiO2k6MzM1O3M6Mzk6IkpAIVZyQComUkhSd35KTHcuR3x4bGhuTEp+PzEuYndPYnhiUHwhViI7aTozMzY7czoxMToiemVoaXJoYWNrZXIiO2k6MzM3O3M6MTYxOiIoJyInLCcmcXVvdDsnLCRmbikpLiciO2RvY3VtZW50Lmxpc3Quc3VibWl0KCk7XCc+Jy5odG1sc3BlY2lhbGNoYXJzKHN0cmxlbigkZm4pPmZvcm1hdD9zdWJzdHIoJGZuLDAsZm9ybWF0LTMpLicuLi4nOiRmbikuJzwvYT4nLnN0cl9yZXBlYXQoJyAnLGZvcm1hdC1zdHJsZW4oJGZuKSI7aTozMzg7czoxNjA6InByaW50KChpc19yZWFkYWJsZSgkZikgJiYgaXNfd3JpdGVhYmxlKCRmKSk/Ijx0cj48dGQ+Ii53KDEpLmIoIlIiLncoMSkuZm9udCgncmVkJywnUlcnLDMpKS53KDEpOigoKGlzX3JlYWRhYmxlKCRmKSk/Ijx0cj48dGQ+Ii53KDEpLmIoIlIiKS53KDQpOiIiKS4oKGlzX3dyaXRhYmwiO2k6MzM5O3M6NzM6IlIwbEdPRGxoRkFBVUFLSUFBQUFBQVAvLy85M2QzY0RBd0lhR2hnUUVCUC8vL3dBQUFDSDVCQUVBQUFZQUxBQUFBQUFVQUJRQUEiO2k6MzQwO3M6OTA6IjwlPVJlcXVlc3QuU2VydmVyVmFyaWFibGVzKCJzY3JpcHRfbmFtZSIpJT4/Rm9sZGVyUGF0aD08JT1TZXJ2ZXIuVVJMUGF0aEVuY29kZShGb2xkZXIuRHJpdiI7aTozNDE7czoxMTM6Im05MWRDd2dKR1Z2ZFhRcE93MEtjMlZzWldOMEtDUnliM1YwSUQwZ0pISnBiaXdnZFc1a1pXWXNJQ1JsYjNWMElEMGdKSEpwYml3Z01USXdLVHNOQ21sbUlDZ2hKSEp2ZFhRZ0lDWW1JQ0FoSkdWdmRYIjtpOjM0MjtzOjM4OiJSb290U2hlbGwhJyk7c2VsZi5sb2NhdGlvbi5ocmVmPSdodHRwOiI7aTozNDM7czoxMTU6IlRSVUZFUkZJc01TazdEUXBpYVc1a0tGTXNjMjlqYTJGa1pISmZhVzRvSkV4SlUxUkZUbDlRVDFKVUxFbE9RVVJFVWw5QlRsa3BLU0I4ZkNCa2FXVWdJa05oYm5RZ2IzQmxiaUJ3YjNKMFhHNGlPdzBLYkciO2k6MzQ0O3M6NzY6ImEgaHJlZj0iPD9lY2hvICIkZmlzdGlrLnBocD9kaXppbj0kZGl6aW4vLi4vIj8+IiBzdHlsZT0idGV4dC1kZWNvcmF0aW9uOiBub24iO2k6MzQ1O3M6NzoiTlREYWRkeSI7aTozNDY7czoxMjc6IkNCMmFUWnBJREV3TWpRdERRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLSTNKbGNYVnAiO2k6MzQ3O3M6NTU6Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFva1UwaEZURXc5SWk5aWFXNHZZbUZ6YUNBdGFTSTdEUXAiO2k6MzQ4O3M6ODg6IkNSYnNrRUlTK3liS0F3YzYvT0IxalU4WTBZSU1WVWh4aGFPSXNIQUNCeUQwd01BTk9IcVk1WTQ4Z3VpQm5DaGt3UFlOVGt4ZEJSVlJaTEhGa29qWTk2SUkiO2k6MzQ5O3M6MzE6InMoKS5nKCkucygpLnMoKS5nKCkucygpLnMoKS5nKCkiO2k6MzUwO3M6MTIyOiJudCkoZGlza190b3RhbF9zcGFjZShnZXRjd2QoKSkvKDEwMjQqMTAyNCkpIC4gIk1iICIgLiAiRnJlZSBzcGFjZSAiIC4gKGludCkoZGlza19mcmVlX3NwYWNlKGdldGN3ZCgpKS8oMTAyNCoxMDI0KSkgLiAiTWIgPCI7aTozNTE7czozNzoia2xhc3ZheXYuYXNwP3llbmlkb3N5YT08JT1ha3RpZmtsYXMlPiI7aTozNTI7czo0NDoiV1QrUHt+RVcwRXJQT3RuVUAjQCZebF5zUDFsZG55QCNAJm5zaytyMCxHVCsiO2k6MzUzO3M6MTE1OiJtcHR5KCRfUE9TVFsndXInXSkpICRtb2RlIHw9IDA0MDA7IGlmICghZW1wdHkoJF9QT1NUWyd1dyddKSkgJG1vZGUgfD0gMDIwMDsgaWYgKCFlbXB0eSgkX1BPU1RbJ3V4J10pKSAkbW9kZSB8PSAwMTAwIjtpOjM1NDtzOjEwNToiLzB0VlNHL1N1djBVci9oYVVZQWRuM2pNUXdiYm9jR2ZmQWVDMjlCTjl0bUJpSmRWMWxrK2pZRFU5MkM5NGpkdERpZit4T1lqRzZDTGh4MzFVbzl4OS9lQVdnc0JLNjBrSzJtTHdxenFkIjtpOjM1NTtzOjg2OiJjcmxmLid1bmxpbmsoJG5hbWUpOycuJGNybGYuJ3JlbmFtZSgifiIuJG5hbWUsICRuYW1lKTsnLiRjcmxmLid1bmxpbmsoImdycF9yZXBhaXIucGhwIiI7aTozNTY7czoxMDY6Ijl0WlNCMGJ5QnlOVGNnYzJobGJHd2dKaVlnTDJKcGJpOWlZWE5vSUMxcElpazdEUW9nSUNCbGJITmxEUW9nSUNCbWNISnBiblJtS0hOMFpHVnljaXdpVTI5eWNua2lLVHNOQ2lBZ0lHTnMiO2k6MzU3O3M6MTU6IkRYX0hlYWRlcl9kcmF3biI7aTozNTg7czozMDoiW0F2NGJmQ1lDUyx4S1drJCtUa1VTLHhuR2RBeFtPIjtpOjM1OTtzOjExMToiQkRBUWtKQ1F3TERCZ05EUmd5SVJ3aE1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakwvd0FBUkNBQVFBQkFEQVNJQUFoRUJBIjtpOjM2MDtzOjExOiJjdHNoZWxsLnBocCI7aTozNjE7czo0NzoiRXhlY3V0ZWQgY29tbWFuZDogPGI+PGZvbnQgY29sb3I9I2RjZGNkYz5bJGNtZF0iO2k6MzYyO3M6MTM6IldTQ1JJUFQuU0hFTEwiO2k6MzYzO3M6NzoiY2FzdXMxNSI7aTozNjQ7czo3NjoiUjBsR09EbGhKZ0FXQUlBQUFBQUFBUC8vL3lINUJBVVVBQUVBTEFBQUFBQW1BQllBQUFJdmpJK3B5KzBQRjRpMGdWdnp1VnhYRG5vUSI7aTozNjU7czoxNzoiYWRtaW5Ac3B5Z3J1cC5vcmciO2k6MzY2O3M6MTQ6InRlbXBfcjU3X3RhYmxlIjtpOjM2NztzOjE3OiIkYzk5c2hfdXBkYXRlZnVybCI7aTozNjg7czo4OiJyNTdzaGVsbCI7aTozNjk7czo4OiJjOTlzaGVsbCI7aTozNzA7czo5OiJCeSBQc3ljaDAiO2k6MzcxO3M6MTY6ImM5OWZ0cGJydXRlY2hlY2siO2k6MzcyO3M6MTAxOiI3VE1HQUhZNUthTTlvMzdXL0dRL2ZyRkpldGZxbFJHTzZGU1JUTW03SUxTbTM1bzV6NCt2MG1jZjRLYUhnS1M1WTE3ZXFxdkQybW1OOE56dGV5cGxOZDZXT3dyUVZLNDQ1Si95MCI7aTozNzM7czo4NDoiPHRleHRhcmVhIG5hbWU9XCJwaHBldlwiIHJvd3M9XCI1XCIgY29scz1cIjE1MFwiPiIuQCRfUE9TVFsncGhwZXYnXS4iPC90ZXh0YXJlYT48YnI+IjtpOjM3NDtzOjk0OiIkaW5mbyAuPSAoKCRwZXJtcyAmIDB4MDA0MCkgPygoJHBlcm1zICYgMHgwODAwKSA/ICdzJyA6ICd4JyApIDooKCRwZXJtcyAmIDB4MDgwMCkgPyAnUycgOiAnLScpIjtpOjM3NTtzOjMwOiIkcmFuZF93cml0YWJsZV9mb2xkZXJfZnVsbHBhdGgiO2k6Mzc2O3M6MTc6InBWeGJqK0xZdGY0clFUL01SIjtpOjM3NztzOjEwOiJEci5hYm9sYWxoIjtpOjM3ODtzOjY6IkshTEwzciI7aTozNzk7czo3OiJNckhhemVtIjt9"));
$g_FlexDBShe = unserialize(base64_decode("YToyOTU6e2k6MDtzOjUxOiJcJGFsbGVtYWlsc1xzKj1ccypAc3BsaXRcKCJcXG4iXHMqLFxzKlwkZW1haWxsaXN0XCkiO2k6MTtzOjE4OiJKb29tbGFfYnJ1dGVfRm9yY2UiO2k6MjtzOjM4OiJcJHN5c19wYXJhbXNccyo9XHMqQCpmaWxlX2dldF9jb250ZW50cyI7aTozO3M6MjI6ImV2YWxccypcKFxzKmdldF9vcHRpb24iO2k6NDtzOjM1OiJmd3JpdGVccypcKFxzKlwkZmx3XHMqLFxzKlwkZmxccypcKSI7aTo1O3M6MTY6IlNwYW1ccytjb21wbGV0ZWQiO2k6NjtzOjI3OiJlY2hvXHMrWyciXXswLDF9b2tbJyJdezAsMX0iO2k6NztzOjI5OiJlY2hvXHMrWyciXXswLDF9Z29vZFsnIl17MCwxfSI7aTo4O3M6ODY6ImZpbGVfcHV0X2NvbnRlbnRzXHMqXChbJyJdezAsMX0xXC50eHRbJyJdezAsMX1ccyosXHMqcHJpbnRfclxzKlwoXHMqXCRfUE9TVFxzKixccyp0cnVlIjtpOjk7czo4MDoiXCRoZWFkZXJzXHMqPVxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX1oZWFkZXJzWyciXXswLDF9XF0iO2k6MTA7czo1NDoiY3JlYXRlX2Z1bmN0aW9uXHMqXChbJyJdezAsMX1bJyJdezAsMX1ccyosXHMqc3RyX3JvdDEzIjtpOjExO3M6MTQ6IlsnIl1hc3NlcnRbJyJdIjtpOjEyO3M6MjM6IlsnIl1jcmVhdGVfZnVuY3Rpb25bJyJdIjtpOjEzO3M6MjE6IlsnIl1iYXNlNjRfZGVjb2RlWyciXSI7aToxNDtzOjEyOiJbJyJdZXZhbFsnIl0iO2k6MTU7czozNToiZWNob1xzK1snIl17MCwxfWluc3RhbGxfb2tbJyJdezAsMX0iO2k6MTY7czo1MToiQ1VSTE9QVF9SRUZFUkVSLFxzKlsnIl17MCwxfWh0dHBzOi8vd3d3XC5nb29nbGVcLmNvIjtpOjE3O3M6MzM6ImRpZVxzKlwoXHMqUEhQX09TXHMqXC5ccypjaHJccypcKCI7aToxODtzOjU1OiJpZlxzKlwobWQ1XCh0cmltXChcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbIjtpOjE5O3M6NDQ6ImZccyo9XHMqXCRxXHMqXC5ccypcJGFccypcLlxzKlwkYlxzKlwuXHMqXCR4IjtpOjIwO3M6NDE6ImNvbnRlbnQ9WyciXXswLDF9MTtVUkw9Y2dpLWJpblwuaHRtbFw/Y21kIjtpOjIxO3M6NjM6IlwkdXJsWyciXXswLDF9XHMqXC5ccypcJHNlc3Npb25faWRccypcLlxzKlsnIl17MCwxfS9sb2dpblwuaHRtbCI7aToyMjtzOjY0OiJcJF9TRVNTSU9OXFtbJyJdezAsMX1zZXNzaW9uX3BpblsnIl17MCwxfVxdXHMqPVxzKlsnIl17MCwxfVwkUElOIjtpOjIzO3M6NDI6ImZzb2Nrb3BlblxzKlwoXHMqXCRDb25uZWN0QWRkcmVzc1xzKixccyoyNSI7aToyNDtzOjQ3OiJlY2hvXHMrXCRpZnVwbG9hZD1bJyJdezAsMX1ccypJdHNPa1xzKlsnIl17MCwxfSI7aToyNTtzOjEwNzoicHJlZ19tYXRjaFwoWyciXXswLDF9L1woeWFuZGV4XHxnb29nbGVcfGJvdFwpL2lbJyJdezAsMX0sXHMqZ2V0ZW52XChbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1cKVwpXCkiO2k6MjY7czo1MjoiXCRtYWlsZXJccyo9XHMqXCRfUE9TVFxbWyciXXswLDF9eF9tYWlsZXJbJyJdezAsMX1cXSI7aToyNztzOjU3OiJcJE9PTzBPME8wMD1fX0ZJTEVfXztccypcJE9PMDBPMDAwMFxzKj1ccyoweDFiNTQwO1xzKmV2YWwiO2k6Mjg7czoxMjoiQnlccytXZWJSb29UIjtpOjI5O3M6ODA6ImhlYWRlclwoWyciXXswLDF9czpccypbJyJdezAsMX1ccypcLlxzKnBocF91bmFtZVxzKlwoXHMqWyciXXswLDF9blsnIl17MCwxfVxzKlwpIjtpOjMwO3M6MTE6IkNWVjpccypcJGN2IjtpOjMxO3M6MzA6ImN1cmxcLmhheHhcLnNlL3JmYy9jb29raWVfc3BlYyI7aTozMjtzOjEyOiJraWxsYWxsXHMrLTkiO2k6MzM7czo3MzoibW92ZV91cGxvYWRlZF9maWxlXChcJF9GSUxFU1xbWyciXXswLDF9ZWxpZlsnIl17MCwxfVxdXFtbJyJdezAsMX10bXBfbmFtZSI7aTozNDtzOjYyOiJcJGd6aXBccyo9XHMqQCpnemluZmxhdGVccypcKFxzKkAqc3Vic3RyXHMqXChccypcJGd6ZW5jb2RlX2FyZyI7aTozNTtzOjgzOiJpZlxzKlwoXHMqbWFpbFxzKlwoXHMqXCRtYWlsc1xbXCRpXF1ccyosXHMqXCR0ZW1hXHMqLFxzKmJhc2U2NF9lbmNvZGVccypcKFxzKlwkdGV4dCI7aTozNjtzOjg0OiJmd3JpdGVccypcKFxzKlwkZmhccyosXHMqc3RyaXBzbGFzaGVzXHMqXChccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFsiO2k6Mzc7czo1NzoicHJlZ19yZXBsYWNlXHMqXChccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpIjtpOjM4O3M6OTQ6ImVjaG9ccytmaWxlX2dldF9jb250ZW50c1xzKlwoXHMqYmFzZTY0X3VybF9kZWNvZGVccypcKFxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6Mzk7czo1ODoiXCRtYWlsZXJccyo9XHMqXCRfUE9TVFxbXHMqWyciXXswLDF9eF9tYWlsZXJbJyJdezAsMX1ccypcXSI7aTo0MDtzOjYwOiJpZlxzKlwoXHMqQCptZDVccypcKFxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFsiO2k6NDE7czoxNToiXCRhdXRoX3Bhc3Nccyo9IjtpOjQyO3M6OTk6ImNoclxzKlwoXHMqMTAxXHMqXClccypcLlxzKmNoclxzKlwoXHMqMTE4XHMqXClccypcLlxzKmNoclxzKlwoXHMqOTdccypcKVxzKlwuXHMqY2hyXHMqXChccyoxMDhccypcKSI7aTo0MztzOjM1OiJwcmVnX3JlcGxhY2VccypcKFxzKlsnIl17MCwxfS9cLlwqLyI7aTo0NDtzOjE1MjoiXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcW1snIl17MCwxfVthLXpBLVowLTlfXSs/WyciXXswLDF9XF1cKFxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX1bYS16QS1aMC05X10rP1snIl17MCwxfVxdXHMqXCkiO2k6NDU7czo3NDoiPVxzKlwkR0xPQkFMU1xbXHMqWyciXXswLDF9XyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpWyciXXswLDF9XHMqXF0iO2k6NDY7czo3NToiXCRyZXN1bHRGVUxccyo9XHMqc3RyaXBjc2xhc2hlc1xzKlwoXHMqXCRfUE9TVFxbWyciXXswLDF9cmVzdWx0RlVMWyciXXswLDF9IjtpOjQ3O3M6MTU6Ii91c3Ivc2Jpbi9odHRwZCI7aTo0ODtzOjY0OiJlY2hvXHMrc3RyaXBzbGFzaGVzXHMqXChccypcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbIjtpOjQ5O3M6MzI6IlBSSVZNU0dcLlwqOlwub3duZXJcXHNcK1woXC5cKlwpIjtpOjUwO3M6ODM6InByaW50XHMrXCRzb2NrXHMrWyciXXswLDF9TklDSyBbJyJdezAsMX1ccytcLlxzK1wkbmlja1xzK1wuXHMrWyciXXswLDF9XFxuWyciXXswLDF9IjtpOjUxO3M6ODA6IlwkdXJsXHMqPVxzKlwkdXJsXHMqXC5ccypbJyJdezAsMX1cP1snIl17MCwxfVxzKlwuXHMqaHR0cF9idWlsZF9xdWVyeVwoXCRxdWVyeVwpIjtpOjUyO3M6MTIzOiJwcmVnX21hdGNoX2FsbFwoWyciXXswLDF9LzxhIGhyZWY9IlxcL3VybFxcXD9xPVwoXC5cK1w/XClcWyZcfCJcXVwrL2lzWyciXXswLDF9LCBcJHBhZ2VcW1snIl17MCwxfWV4ZVsnIl17MCwxfVxdLCBcJGxpbmtzXCkiO2k6NTM7czoxMDk6IjxzY3JpcHRccytsYW5ndWFnZT1bJyJdezAsMX0qSmF2YVNjcmlwdFsnIl17MCwxfSo+XHMqcGFyZW50XC53aW5kb3dcLm9wZW5lclwubG9jYXRpb25ccyo9XHMqWyciXXswLDF9Kmh0dHA6Ly8iO2k6NTQ7czo3NzoiXCRwXHMqPVxzKnN0cnBvc1xzKlwoXHMqXCR0eFxzKixccypbJyJdezAsMX17I1snIl17MCwxfVxzKixccypcJHAyXHMqXCtccyoyXCkiO2k6NTU7czoyOToiRXJyb3JEb2N1bWVudFxzKzQwMFxzK2h0dHA6Ly8iO2k6NTY7czoyOToiRXJyb3JEb2N1bWVudFxzKzUwMFxzK2h0dHA6Ly8iO2k6NTc7czoyMjoiPGgxPkxvYWRpbmdcLlwuXC48L2gxPiI7aTo1ODtzOjE1OiJcKG1zaWVcfG9wZXJhXCkiO2k6NTk7czo0OToiUmV3cml0ZUNvbmRccyole0hUVFBfVVNFUl9BR0VOVH1ccypcLlwqbmRyb2lkXC5cKiI7aTo2MDtzOjI4OiJnb29nbGVcfHlhbmRleFx8Ym90XHxyYW1ibGVyIjtpOjYxO3M6OTk6ImlmXHMqXChccyppc19kaXJccypcKFxzKlwkRnVsbFBhdGhccypcKVxzKlwpXHMqQWxsRGlyXHMqXChccypcJEZ1bGxQYXRoXHMqLFxzKlwkRmlsZXNccypcKTtccyp9XHMqfSI7aTo2MjtzOjE2NzoiWyciXXswLDF9RnJvbTpccypbJyJdezAsMX1cLlwkX1BPU1RcW1snIl17MCwxfXJlYWxuYW1lWyciXXswLDF9XF1cLlsnIl17MCwxfSBbJyJdezAsMX1cLlsnIl17MCwxfSA8WyciXXswLDF9XC5cJF9QT1NUXFtbJyJdezAsMX1mcm9tWyciXXswLDF9XF1cLlsnIl17MCwxfT5cXG5bJyJdezAsMX0iO2k6NjM7czo1MzoiPCEtLSNleGVjXHMrY21kPVsnIl17MCwxfVwkSFRUUF9BQ0NFUFRbJyJdezAsMX1ccyotLT4iO2k6NjQ7czoxMjoicGhwaW5mb1woXCk7IjtpOjY1O3M6MjY6IlxbLVxdXHMrQ29ubmVjdGlvblxzK2ZhaWxkIjtpOjY2O3M6NjM6ImlmXCgvXF5cXDpcJG93bmVyIVwuXCpcXEBcLlwqUFJJVk1TR1wuXCo6XC5tc2dmbG9vZFwoXC5cKlwpL1wpeyI7aTo2NztzOjM0OiJwcmludFxzKlwkc29jayAiUFJJVk1TRyAiXC5cJG93bmVyIjtpOjY4O3M6NjQ6IlxdPVsnIl17MCwxfWlwWyciXXswLDF9XHMqO1xzKmlmXHMqXChccyppc3NldFxzKlwoXHMqXCRfU0VSVkVSXFsiO2k6Njk7czo1MToiXF1ccyp9XHMqPVxzKnRyaW1ccypcKFxzKmFycmF5X3BvcFxzKlwoXHMqXCR7XHMqXCR7IjtpOjcwO3M6MzA6InByaW50XCgiI1xzK2luZm9ccytPS1xcblxcbiJcKSI7aTo3MTtzOjEzMjoiXCR1c2VyX2FnZW50XHMqPVxzKnByZWdfcmVwbGFjZVxzKlwoXHMqWyciXXswLDF9XHxVc2VyXFxcLkFnZW50XFw6XFtcXHMgXF1cP1x8aVsnIl17MCwxfVxzKixccypbJyJdezAsMX1bJyJdezAsMX1ccyosXHMqXCR1c2VyX2FnZW50IjtpOjcyO3M6NzE6IlwkcFxzKj1ccypzdHJwb3NcKFwkdHhccyosXHMqWyciXXswLDF9eyNbJyJdezAsMX1ccyosXHMqXCRwMlxzKlwrXHMqMlwpIjtpOjczO3M6MTAxOiJjcmVhdGVfZnVuY3Rpb25ccypcKFxzKlsnIl17MCwxfVwkbVsnIl17MCwxfVxzKixccypbJyJdezAsMX1pZlxzKlwoXHMqXCRtXHMqXFtccyoweDAxXHMqXF1ccyo9PVxzKiJMIiI7aTo3NDtzOjg5OiJcJGxldHRlclxzKj1ccypzdHJfcmVwbGFjZVxzKlwoXHMqXCRBUlJBWVxbMFxdXFtcJGpcXVxzKixccypcJGFyclxbXCRpbmRcXVxzKixccypcJGxldHRlciI7aTo3NTtzOjIxOiJldmFsXHMqXChccypzdHJfcm90MTMiO2k6NzY7czozODoiZXZhbFxzKlwoXHMqZ3ppbmZsYXRlXHMqXChccypzdHJfcm90MTMiO2k6Nzc7czo0ODoiZnVuY3Rpb25ccypjaG1vZF9SXHMqXChccypcJHBhdGhccyosXHMqXCRwZXJtXHMqIjtpOjc4O3M6OToiSXJJc1RcLklyIjtpOjc5O3M6MTE6IkhhY2tlZFxzK0J5IjtpOjgwO3M6MzM6InN5bWJpYW5cfG1pZHBcfHdhcFx8cGhvbmVcfHBvY2tldCI7aTo4MTtzOjQ2OiJpZlxzKlwoZGV0ZWN0X21vYmlsZV9kZXZpY2VcKFwpXClccyp7XHMqaGVhZGVyIjtpOjgyO3M6Mzc6IlwkcG9zdFxzKj1ccypbJyJdezAsMX1cXHg3N1xceDY3XFx4NjUiO2k6ODM7czozNzoiZWNob1xzKlsnIl17MCwxfWFuc3dlcj1lcnJvclsnIl17MCwxfSI7aTo4NDtzOjM0OiJ1cmw9PFw/cGhwXHMqZWNob1xzKlwkcmFuZF91cmw7XD8+IjtpOjg1O3M6NDU6ImlmXChDaGVja0lQT3BlcmF0b3JcKFwpXHMqJiZccyohaXNNb2RlbVwoXClcKSI7aTo4NjtzOjU5OiJzdHJwb3NcKFwkdWEsXHMqWyciXXswLDF9eWFuZGV4Ym90WyciXXswLDF9XClccyohPT1ccypmYWxzZSI7aTo4NztzOjEzNDoiaWZccypcKFwka2V5XHMqIT1ccypbJyJdezAsMX1tYWlsX3RvWyciXXswLDF9XHMqJiZccypcJGtleVxzKiE9XHMqWyciXXswLDF9c210cF9zZXJ2ZXJbJyJdezAsMX1ccyomJlxzKlwka2V5XHMqIT1ccypbJyJdezAsMX1zbXRwX3BvcnQiO2k6ODg7czo1MjoiZWNob1snIl17MCwxfTxjZW50ZXI+PGI+RG9uZVxzKj09PlxzKlwkdXNlcmZpbGVfbmFtZSI7aTo4OTtzOjI1OiJbJyJdezAsMX1lL1wqXC4vWyciXXswLDF9IjtpOjkwO3M6MjU6IlsnIl17MCwxfS9cLlwqL2VbJyJdezAsMX0iO2k6OTE7czoyNjoiYXNzZXJ0XHMqXChccypzdHJpcHNsYXNoZXMiO2k6OTI7czo1MToiXClccypcLlxzKnN1YnN0clxzKlwoXHMqbWQ1XHMqXChccypzdHJyZXZccypcKFxzKlwkIjtpOjkzO3M6NjU6IlwkZmxccyo9XHMqIjxtZXRhIGh0dHAtZXF1aXY9XFwiUmVmcmVzaFxcIlxzK2NvbnRlbnQ9XFwiMDtccypVUkw9IjtpOjk0O3M6OTA6IixccyphcnJheVxzKlwoJ1wuJywnXC5cLicsJ1RodW1ic1wuZGInXClccypcKVxzKlwpXHMqe1xzKmNvbnRpbnVlO1xzKn1ccyppZlxzKlwoXHMqaXNfZmlsZSI7aTo5NTtzOjgzOiJpZlxzKlwoXHMqXCRkYXRhU2l6ZVxzKjxccypCT1RDUllQVF9NQVhfU0laRVxzKlwpXHMqcmM0XHMqXChccypcJGRhdGEsXHMqXCRjcnlwdGtleSI7aTo5NjtzOjQzOiJzdHJfcm90MTNccypcKFxzKlsnIl17MCwxfXRtdmFzeW5nWyciXXswLDF9IjtpOjk3O3M6NDg6InN0cl9yb3QxM1xzKlwoXHMqWyciXXswLDF9b25mcjY0X3FycGJxclsnIl17MCwxfSI7aTo5ODtzOjE3ODoiaWZccypcKFxzKlwkX1BPU1RcW1xzKlsnIl17MCwxfXBhdGhbJyJdezAsMX1ccypcXVxzKj09XHMqWyciXXswLDF9WyciXXswLDF9XHMqXClccyp7XHMqXCR1cGxvYWRmaWxlXHMqPVxzKlwkX0ZJTEVTXFtccypbJyJdezAsMX1maWxlWyciXXswLDF9XHMqXF1cW1xzKlsnIl17MCwxfW5hbWVbJyJdezAsMX1ccypcXSI7aTo5OTtzOjk5OiJpZlxzKlwoXHMqZndyaXRlXHMqXChccypcJGhhbmRsZVxzKixccypmaWxlX2dldF9jb250ZW50c1xzKlwoXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MTAwO3M6ODk6ImFycmF5X2tleV9leGlzdHNccypcKFxzKlwkZmlsZVJhc1xzKixccypcJGZpbGVUeXBlXClccypcP1xzKlwkZmlsZVR5cGVcW1xzKlwkZmlsZVJhc1xzKlxdIjtpOjEwMTtzOjY1OiJ1cmxlbmNvZGVcKHByaW50X3JcKGFycmF5XChcKSwxXClcKSw1LDFcKVwuY1wpLFwkY1wpO31ldmFsXChcJGRcKSI7aToxMDI7czo0NDoiaWZccypcKFxzKmZ1bmN0aW9uX2V4aXN0c1xzKlwoXHMqJ3BjbnRsX2ZvcmsiO2k6MTAzO3M6NDM6ImZpbmRccysvXHMrLXR5cGVccytmXHMrLXBlcm1ccystMDQwMDBccystbHMiO2k6MTA0O3M6Mzg6ImV4ZWNsXCgiL2Jpbi9zaCIsICIvYmluL3NoIiwgIi1pIiwgMFwpIjtpOjEwNTtzOjQxOiJmdW5jdGlvblxzK2luamVjdFwoXCRmaWxlLFxzKlwkaW5qZWN0aW9uPSI7aToxMDY7czozMjoiZmNsb3NlXChcJGZcKTtccyplY2hvXHMqIm9cLmtcLiIiO2k6MTA3O3M6NzI6InByZWdfcmVwbGFjZVxzKlwoXHMqXCRleGlmXFtccyonTWFrZSdccypcXVxzKixccypcJGV4aWZcW1xzKidNb2RlbCdccypcXSI7aToxMDg7czo3MjoiXF5kb3dubG9hZHMvXChcWzAtOVxdXCpcKS9cKFxbMC05XF1cKlwpL1wkXHMrZG93bmxvYWRzXC5waHBcP2M9XCQxJnA9XCQyIjtpOjEwOTtzOjgxOiJcJHJlcz1teXNxbF9xdWVyeVwoWyciXXswLDF9U0VMRUNUXHMrXCpccytGUk9NXHMrYHdhdGNoZG9nX29sZF8wNWBccytXSEVSRVxzK3BhZ2UiO2k6MTEwO3M6NTI6IlJld3JpdGVSdWxlXHMrXC5cKlxzK2luZGV4XC5waHBcP3VybD1cJDBccytcW0wsUVNBXF0iO2k6MTExO3M6MTAwOiJJTzo6U29ja2V0OjpJTkVULT5uZXdcKFByb3RvXHMqPT5ccyoidGNwIlxzKixccypMb2NhbFBvcnRccyo9PlxzKjM2MDAwXHMqLFxzKkxpc3RlblxzKj0+XHMqU09NQVhDT05OIjtpOjExMjtzOjM5OiJldmFsXHMqXCgqXHMqc3RycmV2XHMqXCgqXHMqc3RyX3JlcGxhY2UiO2k6MTEzO3M6MjEyOiJAbW92ZV91cGxvYWRlZF9maWxlXHMqXChccypcJF9GSUxFU1xbXHMqWyciXXswLDF9bWVzc2FnZVsnIl17MCwxfVxzKlxdXFtccypbJyJdezAsMX10bXBfbmFtZVsnIl17MCwxfVxzKlxdXHMqLFxzKlwkc2VjdXJpdHlfY29kZVxzKlwuXHMqIi8iXHMqXC5ccypcJF9GSUxFU1xbWyciXXswLDF9bWVzc2FnZVsnIl17MCwxfVxdXFtbJyJdezAsMX1uYW1lWyciXXswLDF9XF1cKSI7aToxMTQ7czo4MjoiXCRVUkxccyo9XHMqXCR1cmxzXFtccypyYW5kXChccyowXHMqLFxzKmNvdW50XHMqXChccypcJHVybHNccypcKVxzKi1ccyoxXHMqXClccypcXSI7aToxMTU7czoyMzI6Imlzc2V0XHMqXChccypcJF9GSUxFU1xbXHMqWyciXXswLDF9eFsnIl17MCwxfVxzKlxdXHMqXClccypcP1xzKlwoXHMqaXNfdXBsb2FkZWRfZmlsZVxzKlwoXHMqXCRfRklMRVNcW1xzKlsnIl17MCwxfXhbJyJdezAsMX1ccypcXVxbXHMqWyciXXswLDF9dG1wX25hbWVbJyJdezAsMX1ccypcXVxzKlwpXHMqXD9ccypcKFxzKmNvcHlccypcKFxzKlwkX0ZJTEVTXFtccypbJyJdezAsMX14WyciXXswLDF9XHMqXF0iO2k6MTE2O3M6ODc6ImlmXHMqXChccypcJGlccyo8XHMqXChccypjb3VudFxzKlwoXHMqXCRfUE9TVFxbXHMqWyciXXswLDF9cVsnIl17MCwxfVxzKlxdXHMqXClccyotXHMqMSI7aToxMTc7czozODoiZWNob1xzKlwoKlxzKlsnIl17MCwxfU5PIEZJTEVbJyJdezAsMX0iO2k6MTE4O3M6MTkwOiJtb3ZlX3VwbG9hZGVkX2ZpbGVccypcKCpccypcJF9GSUxFU1xbXHMqWyciXXswLDF9ZmlsZW5hbWVbJyJdezAsMX1ccypcXVxbXHMqWyciXXswLDF9dG1wX25hbWVbJyJdezAsMX1ccypcXVxzKixccypcJF9GSUxFU1xbXHMqWyciXXswLDF9ZmlsZW5hbWVbJyJdezAsMX1ccypcXVxbXHMqWyciXXswLDF9bmFtZVsnIl17MCwxfVxzKlxdIjtpOjExOTtzOjM4OiJlY2hvXHMrWyciXXswLDF9b1wua1wuWyciXXswLDF9O1xzKlw/PiI7aToxMjA7czo3MDoiZmlsZV9nZXRfY29udGVudHNccypcKCpccypBRE1JTl9SRURJUl9VUkxccyosXHMqZmFsc2VccyosXHMqXCRjdHhccypcKSI7aToxMjE7czozNzoiPFw/cGhwXHMrY29weVxzKlwoXHMqWyciXXswLDF9aHR0cDovLyI7aToxMjI7czoxMjoidG1oYXBiemNlcmZmIjtpOjEyMztzOjk3OiJjb250ZW50PVsnIl17MCwxfW5vLWNhY2hlWyciXXswLDF9O1xzKlwkY29uZmlnXFtbJyJdezAsMX1kZXNjcmlwdGlvblsnIl17MCwxfVxdXHMqXC49XHMqWyciXXswLDF9IjtpOjEyNDtzOjc0OiJjbGVhcnN0YXRjYWNoZVwoXHMqXCk7XHMqaWZccypcKFxzKiFpc19kaXJccypcKFxzKlwkZmxkXHMqXClccypcKVxzKnJldHVybiI7aToxMjU7czo5NzoiXCRyQnVmZkxlblxzKj1ccypvcmRccypcKFxzKlZDX0RlY3J5cHRccypcKFxzKmZyZWFkXHMqXChccypcJGlucHV0LFxzKjFccypcKVxzKlwpXHMqXClccypcKlxzKjI1NiI7aToxMjY7czo1ODoiPG1ldGFccytodHRwLWVxdWl2PSJSZWZyZXNoIlxzK2NvbnRlbnQ9IlxkKztccypVUkw9aHR0cDovLyI7aToxMjc7czo1NzoiPG1ldGFccytodHRwLWVxdWl2PSJyZWZyZXNoIlxzK2NvbnRlbnQ9IlxkKztccyp1cmw9PFw/cGhwIjtpOjEyODtzOjk6IklyU2VjVGVhbSI7aToxMjk7czo5MjoiQHNldGNvb2tpZVwoWyciXXswLDF9bVsnIl17MCwxfSxccypbJyJdezAsMX1bYS16QS1aMC05X10rP1snIl17MCwxfSxccyp0aW1lXChcKVxzKlwrXHMqODY0MDAiO2k6MTMwO3M6MTE1OiJAaGVhZGVyXCgiTG9jYXRpb246XHMqWyciXXswLDF9XC5bJyJdezAsMX1oWyciXXswLDF9XC5bJyJdezAsMX10WyciXXswLDF9XC5bJyJdezAsMX10WyciXXswLDF9XC5bJyJdezAsMX1wWyciXXswLDF9IjtpOjEzMTtzOjY3OiJzZXRfdGltZV9saW1pdFxzKlwoXHMqMFxzKlwpO1xzKmlmXHMqXCghU2VjcmV0UGFnZUhhbmRsZXI6OmNoZWNrS2V5IjtpOjEzMjtzOjEwNjoicmV0dXJuXHMqXChccypzdHJzdHJccypcKFxzKlwkc1xzKixccyonZWNobydccypcKVxzKj09XHMqZmFsc2VccypcP1xzKlwoXHMqc3Ryc3RyXHMqXChccypcJHNccyosXHMqJ3ByaW50JyI7aToxMzM7czo4NToidGltZVwoXClccypcK1xzKjEwMDAwXHMqLFxzKlsnIl17MCwxfS9bJyJdezAsMX1cKTtccyplY2hvXHMrXCRtX3p6O1xzKmV2YWxccypcKFwkbV96eiI7aToxMzQ7czoxNDU6ImlmXCghZW1wdHlcKFwkX0ZJTEVTXFtbJyJdezAsMX1tZXNzYWdlWyciXXswLDF9XF1cW1snIl17MCwxfW5hbWVbJyJdezAsMX1cXVwpXHMrQU5EXHMrXChtZDVcKFwkX1BPU1RcW1snIl17MCwxfW5pY2tbJyJdezAsMX1cXVwpXHMqPT1ccypbJyJdezAsMX0iO2k6MTM1O3M6NjY6IihzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXHMqXCgqXHMqWyciXXswLDF9d2dldCI7aToxMzY7czo0Nzoic3RyX3JvdDEzXHMqXChccypnemluZmxhdGVccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MTM3O3M6NTA6Imd6dW5jb21wcmVzc1xzKlwoXHMqc3RyX3JvdDEzXHMqXChccypiYXNlNjRfZGVjb2RlIjtpOjEzODtzOjUwOiJnenVuY29tcHJlc3NccypcKFxzKmJhc2U2NF9kZWNvZGVccypcKFxzKnN0cl9yb3QxMyI7aToxMzk7czo2MToiZ3ppbmZsYXRlXHMqXChccypiYXNlNjRfZGVjb2RlXHMqXChccypzdHJfcm90MTNccypcKFxzKnN0cnJldiI7aToxNDA7czo2MToiZ3ppbmZsYXRlXHMqXChccypiYXNlNjRfZGVjb2RlXHMqXChccypzdHJyZXZccypcKFxzKnN0cl9yb3QxMyI7aToxNDE7czo0NDoiZ3ppbmZsYXRlXHMqXChccypiYXNlNjRfZGVjb2RlXHMqXChccypzdHJyZXYiO2k6MTQyO3M6Njg6Imd6aW5mbGF0ZVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqc3RyX3JvdDEzIjtpOjE0MztzOjU0OiJiYXNlNjRfZGVjb2RlXHMqXChccypnenVuY29tcHJlc3NccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MTQ0O3M6NDc6Imd6aW5mbGF0ZVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqc3RyX3JvdDEzIjtpOjE0NTtzOjQ3OiJnemluZmxhdGVccypcKFxzKnN0cl9yb3QxM1xzKlwoXHMqYmFzZTY0X2RlY29kZSI7aToxNDY7czozMzoiZ3p1bmNvbXByZXNzXHMqXChccypiYXNlNjRfZGVjb2RlIjtpOjE0NztzOjMwOiJnemluZmxhdGVccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MTQ4O3M6MjU6ImV2YWxccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MTQ5O3M6MTc6IkJyYXppbFxzK0hhY2tUZWFtIjtpOjE1MDtzOjkwOiJcJHRsZFxzKj1ccyphcnJheVxzKlwoXHMqWyciXXswLDF9Y29tWyciXXswLDF9LFsnIl17MCwxfW9yZ1snIl17MCwxfSxbJyJdezAsMX1uZXRbJyJdezAsMX0iO2k6MTUxO3M6Mzc6InN0cl9pcmVwbGFjZVxzKlwoKlxzKlsnIl17MCwxfTwvaGVhZD4iO2k6MTUyO3M6NTU6ImRlZmluZVxzKlwoKlxzKlsnIl17MCwxfVNCQ0lEX1JFUVVFU1RfRklMRVsnIl17MCwxfVxzKiwiO2k6MTUzO3M6Mzk6InByZWdfcmVwbGFjZVxzKlwoKlxzKlsnIl17MCwxfS9cLlwrL2VzaSI7aToxNTQ7czoxNzoiTXlzdGVyaW91c1xzK1dpcmUiO2k6MTU1O3M6NTU6IlwkaGVhZGVyc1xzKlwuPVxzKlwkX1BPU1RcW1snIl17MCwxfWVNYWlsQWRkWyciXXswLDF9XF0iO2k6MTU2O3M6Mzg6ImRlZmluZVxzKlwoXHMqWyciXXswLDF9REVGQ0FMTEJBQ0tNQUlMIjtpOjE1NztzOjQ3OiJkZWZhdWx0X2FjdGlvblxzKj1ccypbJyJdezAsMX1GaWxlc01hblsnIl17MCwxfSI7aToxNTg7czozODoiZWNob1xzK0BmaWxlX2dldF9jb250ZW50c1xzKlwoXHMqXCRnZXQiO2k6MTU5O3M6MTU2OiJpZlxzKlwoXHMqc3RyaXBvc1xzKlwoXHMqXCRfU0VSVkVSXFtbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1cXVxzKixccypbJyJdezAsMX1BbmRyb2lkWyciXXswLDF9XClccyohPT1mYWxzZVxzKiYmXHMqIVwkX0NPT0tJRVxbWyciXXswLDF9ZGxlX3VzZXJfaWQiO2k6MTYwO3M6NDQ6ImlmXHMqXChccypwcmVnX21hdGNoXHMqXChccypbJyJdezAsMX0jeWFuZGV4IjtpOjE2MTtzOjcwOiJoZWFkZXJccypcKFsnIl17MCwxfUxvY2F0aW9uOlxzKlsnIl17MCwxfVxzKlwuXHMqXCR0b1xzKlwuXHMqdXJsZGVjb2RlIjtpOjE2MjtzOjE1OiJEYzBSSGFbJyJdezAsMX0iO2k6MTYzO3M6MTU6IlsnIl17MCwxfWFIUjBjRCI7aToxNjQ7czozNjoiIXRvdWNoXChbJyJdezAsMX1cLlwuL1wuXC4vbGFuZ3VhZ2UvIjtpOjE2NTtzOjMyOiJldmFsXChzdHJpcHNsYXNoZXNcKFxcXCRfUkVRVUVTVCI7aToxNjY7czo3ODoiZG9jdW1lbnRcLndyaXRlXHMqXChccypbJyJdezAsMX08c2NyaXB0XHMrc3JjPVsnIl17MCwxfWh0dHA6Ly88XD89XCRkb21haW5cPz4vIjtpOjE2NztzOjg1OiJleGl0XHMqXChccypbJyJdezAsMX08c2NyaXB0PlxzKnNldFRpbWVvdXRccypcKFxzKlxcWyciXXswLDF9ZG9jdW1lbnRcLmxvY2F0aW9uXC5ocmVmIjtpOjE2ODtzOjY3OiJzdHJjaHJccypcKCpccypcJF9TRVJWRVJcW1xzKlsnIl17MCwxfUhUVFBfVVNFUl9BR0VOVFsnIl17MCwxfVxzKlxdIjtpOjE2OTtzOjY3OiJzdHJzdHJccypcKCpccypcJF9TRVJWRVJcW1xzKlsnIl17MCwxfUhUVFBfVVNFUl9BR0VOVFsnIl17MCwxfVxzKlxdIjtpOjE3MDtzOjY3OiJzdHJwb3NccypcKCpccypcJF9TRVJWRVJcW1xzKlsnIl17MCwxfUhUVFBfVVNFUl9BR0VOVFsnIl17MCwxfVxzKlxdIjtpOjE3MTtzOjI4OiJmdW5jdGlvblxzK3NxbDJfc2FmZVxzKlwoXHMqIjtpOjE3MjtzOjQxOiJcJHBvc3RSZXN1bHRccyo9XHMqY3VybF9leGVjXHMqXCgqXHMqXCRjaCI7aToxNzM7czo4NzoiJiZccypmdW5jdGlvbl9leGlzdHNccypcKCpccypbJyJdezAsMX1nZXRteHJyWyciXXswLDF9XClccypcKVxzKntccypAZ2V0bXhyclxzKlwoKlxzKlwkIjtpOjE3NDtzOjU3OiJpc19fd3JpdGFibGVccypcKCpccypcJHBhdGhccypcLlxzKnVuaXFpZFxzKlwoKlxzKm10X3JhbmQiO2k6MTc1O3M6Mjg6ImZpbGVfcHV0X2NvbnRlbnR6XHMqXCgqXHMqXCQiO2k6MTc2O3M6MzE6Ij1ccyphcnJheV9tYXBccypcKCpccypzdHJyZXZccyoiO2k6MTc3O3M6OToiXCRfX19ccyo9IjtpOjE3ODtzOjU1OiJAKmd6aW5mbGF0ZVxzKlwoXHMqQCpiYXNlNjRfZGVjb2RlXHMqXChccypAKnN0cl9yZXBsYWNlIjtpOjE3OTtzOjg3OiJmb3BlblxzKlwoKlxzKiJodHRwOi8vIlxzKlwuXHMqXCRjaGVja19kb21haW5ccypcLlxzKiI6ODAiXHMqXC5ccypcJGNoZWNrX2RvY1xzKixccyoiciIiO2k6MTgwO3M6NDM6IkBcJF9DT09LSUVcW1snIl17MCwxfXN0YXRDb3VudGVyWyciXXswLDF9XF0iO2k6MTgxO3M6MzU6ImlmXHMqXCgqXHMqQCpwcmVnX21hdGNoXHMqXCgqXHMqc3RyIjtpOjE4MjtzOjk0OiJhcnJheV9wb3BccypcKCpccypcJHdvcmtSZXBsYWNlXHMqLFxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqLFxzKlwkY291bnRLZXlzTmV3IjtpOjE4MztzOjQ5OiJnenVuY29tcHJlc3NccypcKCpccypzdWJzdHJccypcKCpccypiYXNlNjRfZGVjb2RlIjtpOjE4NDtzOjIzOiJBZGRIYW5kbGVyXHMrcGhwLXNjcmlwdCI7aToxODU7czozMzoiQWRkVHlwZVxzK2FwcGxpY2F0aW9uL3gtaHR0cGQtcGhwIjtpOjE4NjtzOjY0OiIoR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxzKlxbXHMqWyciXXswLDF9X19fWyciXXswLDF9XHMqIjtpOjE4NztzOjEwOiJwY250bF9leGVjIjtpOjE4ODtzOjMzOiJcKFxzKlsnIl17MCwxfUlOU0hFTExbJyJdezAsMX1ccyoiO2k6MTg5O3M6NDc6IlwkYlxzKlwuXHMqXCRwXHMqXC5ccypcJGhccypcLlxzKlwka1xzKlwuXHMqXCR2IjtpOjE5MDtzOjE0NToiXCRbYS16QS1aMC05X10rP1xzKlwoXHMqXGQrXHMqXF5ccypcZCtccypcKVxzKlwuXHMqXCRbYS16QS1aMC05X10rP1xzKlwoXHMqXGQrXHMqXF5ccypcZCtccypcKVxzKlwuXHMqXCRbYS16QS1aMC05X10rP1xzKlwoXHMqXGQrXHMqXF5ccypcZCtccypcKSI7aToxOTE7czoxMTQ6Ij1ccypwcmVnX3NwbGl0XHMqXChccypbJyJdezAsMX0vXFwsXChcXCBcK1wpXD8vWyciXXswLDF9LFxzKkAqaW5pX2dldFxzKlwoXHMqWyciXXswLDF9ZGlzYWJsZV9mdW5jdGlvbnNbJyJdezAsMX1cKSI7aToxOTI7czoxMjU6ImlmXHMqXCghZnVuY3Rpb25fZXhpc3RzXHMqXChccypbJyJdezAsMX1wb3NpeF9nZXRwd3VpZFsnIl17MCwxfVxzKlwpXHMqJiZccyohaW5fYXJyYXlccypcKFxzKlsnIl17MCwxfXBvc2l4X2dldHB3dWlkWyciXXswLDF9IjtpOjE5MztzOjQzOiJzdHJlYW1fc29ja2V0X2NsaWVudFxzKlwoXHMqWyciXXswLDF9dGNwOi8vIjtpOjE5NDtzOjE0MzoicHJlZ19yZXBsYWNlXHMqXChccypbJyJdezAsMX0vXF5cKHd3d1x8ZnRwXClcXFwuL2lbJyJdezAsMX1ccyosXHMqWyciXXswLDF9WyciXXswLDF9LFxzKkBcJF9TRVJWRVJccypcW1xzKlsnIl17MCwxfUhUVFBfSE9TVFsnIl17MCwxfVxzKlxdXHMqXCkiO2k6MTk1O3M6MjYxOiJpZlxzKlwoKlxzKmlzc2V0XHMqXCgqXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClccypcW1xzKlsnIl17MCwxfVthLXpBLVpfMC05XStbJyJdezAsMX1ccypcXVxzKlwpKlxzKlwpXHMqe1xzKlwkW2EtekEtWl8wLTldK1xzKj1ccypcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxzKlxbXHMqWyciXXswLDF9W2EtekEtWl8wLTldK1snIl17MCwxfVxzKlxdO1xzKmV2YWxccypcKCpccypcJFthLXpBLVpfMC05XStccypcKSoiO2k6MTk2O3M6ODE6ImV2YWxccypcKCpccypzdHJpcHNsYXNoZXNccypcKCpccyphcnJheV9wb3BcKCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKSI7aToxOTc7czo2NToiKHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilcKCpbJyJdezAsMX1jZFxzKy90bXAiO2k6MTk4O3M6MTU0OiJpZlxzK1woXHMqc3RycG9zXHMqXChccypcJHVybFxzKixccypbJyJdezAsMX1qcy9tb290b29sc1wuanNbJyJdezAsMX1ccypcKVxzKj09PVxzKmZhbHNlXHMrJiZccytzdHJwb3NccypcKFxzKlwkdXJsXHMqLFxzKlsnIl17MCwxfWpzL2NhcHRpb25cLmpzWyciXXswLDF9IjtpOjE5OTtzOjY4OiJpZlxzK1woKlxzKm1haWxccypcKFxzKlwkcmVjcFxzKixccypcJHN1YmpccyosXHMqXCRzdHVudFxzKixccypcJGZybSI7aToyMDA7czo0MzoiPFw/cGhwXHMrXCRfRlxzKj1ccypfX0ZJTEVfX1xzKjtccypcJF9YXHMqPSI7aToyMDE7czoxMDQ6IlwkeFxkK1xzKj1ccypbJyJdezAsMX0uKz9bJyJdezAsMX1ccyo7XHMqXCR4XGQrXHMqPVxzKlsnIl17MCwxfS4rP1snIl17MCwxfVxzKjtccypcJHhcZCtccyo9XHMqWyciXXswLDF9IjtpOjIwMjtzOjExNToiXCRiZWVjb2RlXHMqPUAqZmlsZV9nZXRfY29udGVudHNccypbJyJdezAsMX1cKCpccypcJHVybHB1cnNccypbJyJdezAsMX1cKSpccyo7XHMqZWNob1xzK1snIl17MCwxfVwkYmVlY29kZVsnIl17MCwxfSI7aToyMDM7czoxMDE6IlwkR0xPQkFMU1xbXHMqWyciXXswLDF9Lis/WyciXXswLDF9XHMqXF1cW1xzKlxkK1xzKlxdXChccypcJF9cZCtccyosXHMqX1xkK1xzKlwoXHMqXGQrXHMqXClccypcKVxzKlwpIjtpOjIwNDtzOjczOiJwcmVnX3JlcGxhY2VccypcKCpccypbJyJdezAsMX0vXC5cKlxbLis/XF1cPy9lWyciXXswLDF9XHMqLFxzKnN0cl9yZXBsYWNlIjtpOjIwNTtzOjE0OToiXCRHTE9CQUxTXFtbJyJdezAsMX0uKz9bJyJdezAsMX1cXT1BcnJheVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqWyciXXswLDF9Lis/WyciXXswLDF9XHMqXClccyosXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqWyciXXswLDF9Lis/WyciXXswLDF9XHMqXCkiO2k6MjA2O3M6MjAwOiJVTklPTlxzK1NFTEVDVFxzK1snIl17MCwxfTBbJyJdezAsMX1ccyosXHMqWyciXXswLDF9PFw/IHN5c3RlbVwoXFxcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbY3BjXF1cKTtleGl0O1xzKlw/PlsnIl17MCwxfVxzKixccyowXHMqLDBccyosXHMqMFxzKixccyowXHMrSU5UT1xzK09VVEZJTEVccytbJyJdezAsMX1cJFsnIl17MCwxfSI7aToyMDc7czo5MzoiaXNzZXRcKCpcJF9AKihHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX0uKz9bJyJdezAsMX1cXVwpKlxzKm9yXHMqZGllXCgqLio/XCkqIjtpOjIwODtzOjY2OiJpc3NldFxzKlwoKlxzKlwkX1BPU1RccypcW1xzKlsnIl17MCwxfWV4ZWNnYXRlWyciXXswLDF9XHMqXF1ccypcKSoiO2k6MjA5O3M6ODE6ImZ3cml0ZVxzKlwoKlxzKlwkZnBzZXR2XHMqLFxzKmdldGVudlxzKlwoXHMqWyciXXswLDF9SFRUUF9DT09LSUVbJyJdezAsMX1ccypcKVxzKiI7aToyMTA7czo1NzoiT3B0aW9uc1xzK0ZvbGxvd1N5bUxpbmtzXHMrTXVsdGlWaWV3c1xzK0luZGV4ZXNccytFeGVjQ0dJIjtpOjIxMTtzOjMxOiJzeW1saW5rXHMqXCgqXHMqWyciXXswLDF9L2hvbWUvIjtpOjIxMjtzOjI3OiJcJE9PTy4rPz1ccyp1cmxkZWNvZGVccypcKCoiO2k6MjEzO3M6NzA6ImZ1bmN0aW9uXHMrdXJsR2V0Q29udGVudHNccypcKCpccypcJHVybFxzKixccypcJHRpbWVvdXRccyo9XHMqXGQrXHMqXCkiO2k6MjE0O3M6NDk6InN0cnJldlwoKlxzKlsnIl17MCwxfWVkb2NlZF80NmVzYWJbJyJdezAsMX1ccypcKSoiO2k6MjE1O3M6NDI6InN0cnJldlwoKlxzKlsnIl17MCwxfXRyZXNzYVsnIl17MCwxfVxzKlwpKiI7aToyMTY7czoxMzY6IndwX3Bvc3RzXHMrV0hFUkVccytwb3N0X3R5cGVccyo9XHMqWyciXXswLDF9cG9zdFsnIl17MCwxfVxzK0FORFxzK3Bvc3Rfc3RhdHVzXHMqPVxzKlsnIl17MCwxfXB1Ymxpc2hbJyJdezAsMX1ccytPUkRFUlxzK0JZXHMrYElEYFxzK0RFU0MiO2k6MjE3O3M6MTEyOiJmaWxlX2dldF9jb250ZW50c1xzKlwoKlxzKnRyaW1ccypcKFxzKlwkLis/XFtcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbWyciXXswLDF9Lis/WyciXXswLDF9XF1cXVwpXCk7IjtpOjIxODtzOjE5NToiaXNfY2FsbGFibGVccypcKCpccypbJyJdezAsMX0oc3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVsnIl17MCwxfVwpKlxzK2FuZFxzKyFpbl9hcnJheVxzKlwoKlxzKlsnIl17MCwxfShzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pWyciXXswLDF9XHMqLFxzKlwkZGlzYWJsZWZ1bmNzIjtpOjIxOTtzOjI0OiJcJEdMT0JBTFNcW1snIl17MCwxfV9fX18iO2k6MjIwO3M6MTI6InJtXHMrLWZccystciI7aToyMjE7czoxMjoicm1ccystclxzKy1mIjtpOjIyMjtzOjg6InJtXHMrLWZyIjtpOjIyMztzOjg6InJtXHMrLXJmIjtpOjIyNDtzOjQzOiJmb3BlblxzKlwoKlxzKlsnIl17MCwxfS9ldGMvcGFzc3dkWyciXXswLDF9IjtpOjIyNTtzOjU5OiJldmFsXHMqXCgqQCpccypzdHJpcHNsYXNoZXNccypcKCpccyphcnJheV9wb3BccypcKCpccypAKlwkXyI7aToyMjY7czo0MToiZXZhbFxzKlwoKkAqXHMqc3RyaXBzbGFzaGVzXHMqXCgqXHMqQCpcJF8iO2k6MjI3O3M6NTI6ImlzX3dyaXRhYmxlXHMqXCgqXHMqWyciXXswLDF9L3Zhci90bXBbJyJdezAsMX1ccypcKSoiO2k6MjI4O3M6NzQ6IkAqc2V0Y29va2llXHMqXCgqXHMqWyciXXswLDF9aGl0WyciXXswLDF9LFxzKjFccyosXHMqdGltZVxzKlwoKlxzKlwpKlxzKlwrIjtpOjIyOTtzOjM2OiJldmFsXHMqXCgqXHMqZmlsZV9nZXRfY29udGVudHNccypcKCoiO2k6MjMwO3M6NDY6InByZWdfcmVwbGFjZVxzKlwoKlxzKlsnIl17MCwxfS9cLlwqL2VbJyJdezAsMX0iO2k6MjMxO3M6OTU6ImFkZF9maWx0ZXJccypcKCpccypbJyJdezAsMX10aGVfY29udGVudFsnIl17MCwxfVxzKixccypbJyJdezAsMX1fYmxvZ2luZm9bJyJdezAsMX1ccyosXHMqLis/XCkqIjtpOjIzMjtzOjI5OiJldmFsXHMqXCgqXHMqZ2V0X29wdGlvblxzKlwoKiI7aToyMzM7czo4MToiXHMqe1xzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFtccypbJyJdezAsMX1yb290WyciXXswLDF9XHMqXF1ccyp9IjtpOjIzNDtzOjEzNToiWyciXXswLDF9aHR0cGRcLmNvbmZbJyJdezAsMX1ccyosXHMqWyciXXswLDF9dmhvc3RzXC5jb25mWyciXXswLDF9XHMqLFxzKlsnIl17MCwxfWNmZ1wucGhwWyciXXswLDF9XHMqLFxzKlsnIl17MCwxfWNvbmZpZ1wucGhwWyciXXswLDF9IjtpOjIzNTtzOjMzOiJwcm9jX29wZW5ccypcKFxzKlsnIl17MCwxfUlIU3RlYW0iO2k6MjM2O3M6ODg6IlwkaW5pXHMqXFtccypbJyJdezAsMX11c2Vyc1snIl17MCwxfVxzKlxdXHMqPVxzKmFycmF5XHMqXChccypbJyJdezAsMX1yb290WyciXXswLDF9XHMqPT4iO2k6MjM3O3M6ODg6ImN1cmxfc2V0b3B0XHMqXChccypcJGNoXHMqLFxzKkNVUkxPUFRfVVJMXHMqLFxzKlsnIl17MCwxfWh0dHA6Ly9cJGhvc3Q6XGQrWyciXXswLDF9XHMqXCkiO2k6MjM4O3M6NDU6InN5c3RlbVxzKlwoKlxzKlsnIl17MCwxfXdob2FtaVsnIl17MCwxfVxzKlwpKiI7aToyMzk7czo1MjoiZmluZFxzKy9ccystbmFtZVxzK1wuc3NoXHMrPlxzK1wkZGlyL3NzaGtleXMvc3Noa2V5cyI7aToyNDA7czo5NToiKHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilccypcKCpccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFsiO2k6MjQxO3M6Mzc6InJlcXVpcmVfb25jZVxzKlwoKlxzKlsnIl17MCwxfWltYWdlcy8iO2k6MjQyO3M6Mzc6ImluY2x1ZGVfb25jZVxzKlwoKlxzKlsnIl17MCwxfWltYWdlcy8iO2k6MjQzO3M6NTg6InJlcXVpcmVfb25jZVxzKlwoKlxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjQ0O3M6NTg6ImluY2x1ZGVfb25jZVxzKlwoKlxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjQ1O3M6MzI6InJlcXVpcmVccypcKCpccypbJyJdezAsMX1pbWFnZXMvIjtpOjI0NjtzOjMyOiJpbmNsdWRlXHMqXCgqXHMqWyciXXswLDF9aW1hZ2VzLyI7aToyNDc7czo1MzoicmVxdWlyZVxzKlwoKlxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjQ4O3M6NTM6ImluY2x1ZGVccypcKCpccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpIjtpOjI0OTtzOjU5OiJiYXNlNjRfZGVjb2RlXHMqXCgqXHMqQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKSI7aToyNTA7czo1MjoiYXNzZXJ0XHMqXCgqXHMqQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKSI7aToyNTE7czo1MDoiZXZhbFxzKlwoKlxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjUyO3M6MjU6InBocFxzKyJccypcLlxzKlwkd3NvX3BhdGgiO2k6MjUzO3M6ODk6IkAqYXNzZXJ0XHMqXCgqXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClccypcW1xzKlsnIl17MCwxfS4rP1snIl17MCwxfVxzKlxdXHMqIjtpOjI1NDtzOjEwOiJldmExLis/U2lyIjtpOjI1NTtzOjg6ImxzXHMrLWxhIjtpOjI1NjtzOjk4OiJpZlxzKlwoXHMqaXNfY2FsbGFibGVccypcKCpccypbJyJdezAsMX0oc3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVsnIl17MCwxfVxzKlwpKiI7aToyNTc7czo5MzoiXCRjbWRccyo9XHMqXChccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFtccypbJyJdezAsMX0uKz9bJyJdezAsMX1ccypcXVxzKlwpIjtpOjI1ODtzOjUxOiJkb2N1bWVudFwud3JpdGVccypcKFxzKnVuZXNjYXBlXHMqXChccypbJyJdezAsMX0lM0MiO2k6MjU5O3M6OTY6IlwkZnVuY3Rpb25ccypcKCpccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFtccypbJyJdezAsMX1jbWRbJyJdezAsMX1ccypcXVxzKlwpKiI7aToyNjA7czoyMzoiXCRmZVwoIlwkY21kXHMrMj4mMSJcKTsiO2k6MjYxO3M6MTA1OiJpZlxzKlwoXHMqZnVuY3Rpb25fZXhpc3RzXHMqXChccypbJyJdezAsMX0oc3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVsnIl17MCwxfVxzKlwpXHMqXCkiO2k6MjYyO3M6ODg6InN5c3RlbVwoIlwkY21kXHMrMT5ccyovdG1wL2NtZHRlbXBccysyPiYxO1xzKmNhdFxzKy90bXAvY21kdGVtcDtccypybVxzKy90bXAvY21kdGVtcCJcKTsiO2k6MjYzO3M6NjM6InNldGNvb2tpZVwoKlxzKlsnIl17MCwxfW15c3FsX3dlYl9hZG1pbl91c2VybmFtZVsnIl17MCwxfVxzKlwpKiI7aToyNjQ7czo1Mzoic2hlbGxfZXhlY1xzKlwoKlxzKlsnIl17MCwxfXVuYW1lXHMrLWFbJyJdezAsMX1ccypcKSoiO2k6MjY1O3M6OTQ6InNoZWxsX2V4ZWNccypcKCpccypAKlwkX1BPU1RccypcW1xzKlsnIl17MCwxfS4rP1snIl17MCwxfVxzKlxdXHMqXC5ccyoiXHMqMlxzKj5ccyomMVxzKiJccypcKSoiO2k6MjY2O3M6NDM6IiFAKlwkX1JFUVVFU1RccypcW1xzKiJjOTlzaF9zdXJsIlxzKlxdXHMqXCkiO2k6MjY3O3M6Mzc6IlwkbG9naW5ccyo9XHMqQCpwb3NpeF9nZXR1aWRcKCpccypcKSoiO2k6MjY4O3M6MzA6ImV4ZWNccypcKCpccypbJyJdezAsMX1ybVxzKi1mciI7aToyNjk7czozMDoiZXhlY1xzKlwoKlxzKlsnIl17MCwxfXJtXHMqLXJmIjtpOjI3MDtzOjM0OiJleGVjXHMqXCgqXHMqWyciXXswLDF9cm1ccyotclxzKi1mIjtpOjI3MTtzOjMxOiJuY2Z0cHB1dFxzKi11XHMqXCRmdHBfdXNlcl9uYW1lIjtpOjI3MjtzOjEwMjoicnVuY29tbWFuZFxzKlwoXHMqWyciXXswLDF9c2hlbGxoZWxwWyciXXswLDF9XHMqLFxzKlsnIl17MCwxfShHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpWyciXXswLDF9IjtpOjI3MztzOjU1OiJ7XHMqXCRccyp7XHMqcGFzc3RocnVccypcKCpccypcJGNtZFxzKlwpXHMqfVxzKn1ccyo8YnI+IjtpOjI3NDtzOjUzOiJwYXNzdGhydVxzKlwoKlxzKmdldGVudlxzKlwoKlxzKidIVFRQX0FDQ0VQVF9MQU5HVUFHRSI7aToyNzU7czo1MzoicGFzc3RocnVccypcKCpccypnZXRlbnZccypcKCpccyoiSFRUUF9BQ0NFUFRfTEFOR1VBR0UiO2k6Mjc2O3M6NDA6ImV2YWxccypcKCpccypnemluZmxhdGVccypcKCpccypzdHJfcm90MTMiO2k6Mjc3O3M6ODc6IlNFTEVDVFxzKzFccytGUk9NXHMrbXlzcWxcLnVzZXJccytXSEVSRVxzK2NvbmNhdFwoXHMqYHVzZXJgXHMqLFxzKidAJ1xzKixccypgaG9zdGBccypcKSI7aToyNzg7czo5NzoiXCRNZXNzYWdlU3ViamVjdFxzKj1ccypiYXNlNjRfZGVjb2RlXHMqXChccypcJF9QT1NUXHMqXFtccypbJyJdezAsMX1tc2dzdWJqZWN0WyciXXswLDF9XHMqXF1ccypcKSI7aToyNzk7czo0NDoicmVuYW1lXHMqXChccypbJyJdezAsMX13c29cLnBocFsnIl17MCwxfVxzKiwiO2k6MjgwO3M6Njg6ImZpbGVwYXRoXHMqPVxzKkAqcmVhbHBhdGhccypcKFxzKlwkX1BPU1RccypcW1xzKiJmaWxlcGF0aCJccypcXVxzKlwpIjtpOjI4MTtzOjY4OiJmaWxlcGF0aFxzKj1ccypAKnJlYWxwYXRoXHMqXChccypcJF9QT1NUXHMqXFtccyonZmlsZXBhdGgnXHMqXF1ccypcKSI7aToyODI7czoxOToicm91bmRccypcKFxzKjBccypcKyI7aToyODM7czo0MDoiZXZhbFxzKlwoKlxzKmJhc2U2NF9kZWNvZGVccypcKCpccypAKlwkXyI7aToyODQ7czo4Nzoid3NvRXhccypcKFxzKidccyp0YXJccypjZnp2XHMqJ1xzKlwuXHMqZXNjYXBlc2hlbGxhcmdccypcKFxzKlwkX1BPU1RcW1xzKidwMidccypcXVxzKlwpIjtpOjI4NTtzOjE5OiJDb250ZW50LVR5cGU6XHMqXCRfIjtpOjI4NjtzOjY4OiJXU09zZXRjb29raWVccypcKFxzKm1kNVxzKlwoXHMqQCpcJF9TRVJWRVJcW1xzKiJIVFRQX0hPU1QiXHMqXF1ccypcKSI7aToyODc7czo2ODoiV1NPc2V0Y29va2llXHMqXChccyptZDVccypcKFxzKkAqXCRfU0VSVkVSXFtccyonSFRUUF9IT1NUJ1xzKlxdXHMqXCkiO2k6Mjg4O3M6MTUwOiJcJGluZm8gXC49IFwoXChcJHBlcm1zXHMqJlxzKjB4MDA0MFwpXHMqXD9cKFwoXCRwZXJtc1xzKiZccyoweDA4MDBcKVxzKlw/XHMqJ3MnXHMqOlxzKid4J1xzKlwpXHMqOlwoXChcJHBlcm1zXHMqJlxzKjB4MDgwMFwpXHMqXD9ccyonUydccyo6XHMqJy0nXHMqXCkiO2k6Mjg5O3M6MzA6ImRlZmF1bHRfYWN0aW9uXHMqPVxzKidGaWxlc01hbiI7aToyOTA7czozMzoic3lzdGVtXHMrZmlsZVxzK2RvXHMrbm90XHMrZGVsZXRlIjtpOjI5MTtzOjE5OiJoYWNrZWRccytieVxzK0htZWk3IjtpOjI5MjtzOjExOiJieVxzK0dyaW5heSI7aToyOTM7czoyMzoiQ2FwdGFpblxzK0NydW5jaFxzK1RlYW0iO2k6Mjk0O3M6OTY6IlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtccypbJyJdezAsMX1wMlsnIl17MCwxfVxzKlxdXHMqPT1ccypbJyJdezAsMX1jaG1vZFsnIl17MCwxfSI7fQ=="));
$g_ExceptFlex = unserialize(base64_decode("YTo2ODp7aTowO3M6ODoic29ydFwoXCkiO2k6MTtzOjEwOiJtdXN0LXJldmFsIjtpOjI7czo5OiJyZXRyaWV2YWwiO2k6MztzOjk6ImRvdWJsZXZhbCI7aTo0O3M6NjY6InJlcXVpcmVccypcKCpccypcJF9TRVJWRVJcW1xzKlsnIl17MCwxfURPQ1VNRU5UX1JPT1RbJyJdezAsMX1ccypcXSI7aTo1O3M6NzE6InJlcXVpcmVfb25jZVxzKlwoKlxzKlwkX1NFUlZFUlxbXHMqWyciXXswLDF9RE9DVU1FTlRfUk9PVFsnIl17MCwxfVxzKlxdIjtpOjY7czo2NjoiaW5jbHVkZVxzKlwoKlxzKlwkX1NFUlZFUlxbXHMqWyciXXswLDF9RE9DVU1FTlRfUk9PVFsnIl17MCwxfVxzKlxdIjtpOjc7czo3MToiaW5jbHVkZV9vbmNlXHMqXCgqXHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1ET0NVTUVOVF9ST09UWyciXXswLDF9XHMqXF0iO2k6ODtzOjE3OiJcJHNtYXJ0eS0+X2V2YWxcKCI7aTo5O3M6MzA6InByZXBccytybVxzKy1yZlxzKyV7YnVpbGRyb290fSI7aToxMDtzOjIyOiJUT0RPOlxzK3JtXHMrLXJmXHMrdGhlIjtpOjExO3M6Mjc6Imtyc29ydFwoXCR3cHNtaWxpZXN0cmFuc1wpOyI7aToxMjtzOjYzOiJkb2N1bWVudFwud3JpdGVcKHVuZXNjYXBlXCgiJTNDc2NyaXB0IHNyYz0nIiBcKyBnYUpzSG9zdCBcKyAiZ28iO2k6MTM7czo2OiJcLmV4ZWMiO2k6MTQ7czo4OiJleGVjXChcKSI7aToxNTtzOjI0OiJcJHgxID0gXCR0aGlzLT53IC0gXCR4MTsiO2k6MTY7czozMToiYXNvcnRcKFwkQ2FjaGVEaXJPbGRGaWxlc0FnZVwpOyI7aToxNztzOjEzOiJcKCdyNTdzaGVsbCcsIjtpOjE4O3M6MjU6ImV2YWxcKCJsaXN0ZW5lciA9ICJcK2xpc3QiO2k6MTk7czo4OiJldmFsXChcKSI7aToyMDtzOjMzOiJwcmVnX3JlcGxhY2VfY2FsbGJhY2tcKCcvXFx7XChpbWEiO2k6MjE7czoyMToiZXZhbCBcKF9jdE1lbnVJbml0U3RyIjtpOjIyO3M6Mjk6ImJhc2U2NF9kZWNvZGVcKFwkYWNjb3VudEtleVwpIjtpOjIzO3M6Mzk6ImJhc2U2NF9kZWNvZGVcKFwkZGF0YVwpXCk7IFwkYXBpLT5zZXRSZSI7aToyNDtzOjQ4OiJyZXF1aXJlXChcJF9TRVJWRVJcW1xcIkRPQ1VNRU5UX1JPT1RcXCJcXVwuXFwiL2IiO2k6MjU7czo2NToiYmFzZTY0X2RlY29kZVwoXCRfUkVRVUVTVFxbJ3BhcmFtZXRlcnMnXF1cKTsgaWZcKENoZWNrU2VyaWFsaXplZEQiO2k6MjY7czo2MzoicGNudGxfZXhlYycgPT4gQXJyYXlcKEFycmF5XCgxXCksIFwkYXJSZXN1bHRcWydTRUNVUklOR19GVU5DVElPIjtpOjI3O3M6Mzk6ImVjaG8gIjxzY3JpcHQ+YWxlcnRcKCciXC5DVXRpbDo6SlNFc2NhcCI7aToyODtzOjY4OiJiYXNlNjRfZGVjb2RlXChcJF9SRVFVRVNUXFsndGl0bGVfY2hhbmdlcl9saW5rJ1xdXCk7IGlmIFwoc3RybGVuXChcJCI7aToyOTtzOjUxOiJldmFsXCgnXCRoZXhkdGltZSA9ICInIFwuIFwkaGV4ZHRpbWUgXC4gJyI7J1wpOyBcJGYiO2k6MzA7czo1MjoiZWNobyAiPHNjcmlwdD5hbGVydFwoJ1wkcm93LT50aXRsZSAtICJcLl9NT0RVTEVfSVNfRSI7aTozMTtzOjM3OiJlY2hvICI8c2NyaXB0PmFsZXJ0XCgnXCRjaWRzICJcLl9DQU5OIjtpOjMyO3M6NDE6ImlmXCgxXCkgeyBcJHZfaG91ciA9IFwoXCRwX2hlYWRlclxbJ210aW1lIjtpOjMzO3M6NzA6ImRvY3VtZW50XC53cml0ZVwodW5lc2NhcGVcKCIlM0NzY3JpcHQlMjBzcmM9JTIyaHR0cCIgXCsgXChcKCJodHRwczoiID0iO2k6MzQ7czo1NzoiZG9jdW1lbnRcLndyaXRlXCh1bmVzY2FwZVwoIiUzQ3NjcmlwdCBzcmM9JyIgXCsgcGtCYXNlVVJMIjtpOjM1O3M6MzI6ImVjaG8gIjxzY3JpcHQ+YWxlcnRcKCciXC5KVGV4dDo6IjtpOjM2O3M6MjU6IidmaWxlbmFtZSdcKSwgXCgncjU3c2hlbGwiO2k6Mzc7czo0MzoiZWNobyAiPHNjcmlwdD5hbGVydFwoJyIgXC4gXCRlcnJNc2cgXC4gIidcKSI7aTozODtzOjQyOiJlY2hvICI8c2NyaXB0PmFsZXJ0XChcXCJFcnJvciB3aGVuIGxvYWRpbmciO2k6Mzk7czo0MzoiZWNobyAiPHNjcmlwdD5hbGVydFwoJyJcLkpUZXh0OjpfXCgnVkFMSURfRSI7aTo0MDtzOjg6ImV2YWxcKFwpIjtpOjQxO3M6ODoiJ3N5c3RlbSciO2k6NDI7czo2OiInZXZhbCciO2k6NDM7czo2OiIiZXZhbCIiO2k6NDQ7czo2OiJjb3B5XCgiO2k6NDU7czo3OiJfc3lzdGVtIjtpOjQ2O3M6OToic2F2ZTJjb3B5IjtpOjQ3O3M6MTA6ImZpbGVzeXN0ZW0iO2k6NDg7czo4OiJzZW5kbWFpbCI7aTo0OTtzOjg6ImNhbkNobW9kIjtpOjUwO3M6OToiZG91YmxldmFsIjtpOjUxO3M6MTY6Im9wZXJhdGluZyBzeXN0ZW0iO2k6NTI7czoxMDoiZ2xvYmFsZXZhbCI7aTo1MztzOjIxOiJ3aXRoIDAvMC8wIGlmIFwoMVwpIHsiO2k6NTQ7czo0ODoiXCR4MiA9IFwkcGFyYW1cW1snIl17MCwxfXhbJyJdezAsMX1cXSBcKyBcJHdpZHRoIjtpOjU1O3M6MTE6InNwZWNpYWxpc2VkIjtpOjU2O3M6MTk6IndwX2dldF9jdXJyZW50X3VzZXIiO2k6NTc7czo3OiItPmNobW9kIjtpOjU4O3M6NzoiX21haWxcKCI7aTo1OTtzOjc6Il9jb3B5XCgiO2k6NjA7czo0Njoic3RycG9zXChcJF9TRVJWRVJcWydIVFRQX1VTRVJfQUdFTlQnXF0sICdEcnVwYSI7aTo2MTtzOjQ1OiJzdHJwb3NcKFwkX1NFUlZFUlxbJ0hUVFBfVVNFUl9BR0VOVCdcXSwgJ01TSUUiO2k6NjI7czo0NToic3RycG9zXChcJF9TRVJWRVJcWyJIVFRQX1VTRVJfQUdFTlQiXF0sICdNU0lFIjtpOjYzO3M6MTc6ImV2YWwgXChjbGFzc1N0clwpIjtpOjY0O3M6MzE6ImZ1bmN0aW9uX2V4aXN0c1woJ2Jhc2U2NF9kZWNvZGUiO2k6NjU7czoxNjoiImFzc2VydCIsImNvdW50IiI7aTo2NjtzOjIxOiIicmVwb3NpdGlvbiIsImFzc2VydCIiO2k6Njc7czoxNzoiJ2Fzc2VydCcsICdhc3NlcnQiO30="));
$g_SusDB = unserialize(base64_decode("YToxMTg6e2k6MDtzOjc6IlNwYW1tZXIiO2k6MTtzOjQwOiJpbmlfZ2V0XHMqXCgqWyciXXswLDF9c2FmZV9tb2RlWyciXXswLDF9IjtpOjI7czoxNToiZXZhbFxzKlsnIlwoXCRdIjtpOjM7czoxNzoiYXNzZXJ0XHMqWyciXChcJF0iO2k6NDtzOjI4OiJzcnBhdGg6Ly9cLlwuL1wuXC4vXC5cLi9cLlwuIjtpOjU7czoxMjoicGhwaW5mb1xzKlwoIjtpOjY7czoxNjoiU0hPV1xzK0RBVEFCQVNFUyI7aTo3O3M6MTI6IlxicG9wZW5ccypcKCI7aTo4O3M6OToiZXhlY1xzKlwoIjtpOjk7czoxMzoiXGJzeXN0ZW1ccypcKCI7aToxMDtzOjE1OiJcYnBhc3N0aHJ1XHMqXCgiO2k6MTE7czoxNjoiXGJwcm9jX29wZW5ccypcKCI7aToxMjtzOjE1OiJzaGVsbF9leGVjXHMqXCgiO2k6MTM7czoxNjoiaW5pX3Jlc3RvcmVccypcKCI7aToxNDtzOjk6IlxiZGxccypcKCI7aToxNTtzOjE0OiJcYnN5bWxpbmtccypcKCI7aToxNjtzOjEyOiJcYmNoZ3JwXHMqXCgiO2k6MTc7czoxNDoiXGJpbmlfc2V0XHMqXCgiO2k6MTg7czoxMzoiXGJwdXRlbnZccypcKCI7aToxOTtzOjEzOiJnZXRteXVpZFxzKlwoIjtpOjIwO3M6MTQ6ImZzb2Nrb3BlblxzKlwoIjtpOjIxO3M6MTc6InBvc2l4X3NldHVpZFxzKlwoIjtpOjIyO3M6MTc6InBvc2l4X3NldHNpZFxzKlwoIjtpOjIzO3M6MTg6InBvc2l4X3NldHBnaWRccypcKCI7aToyNDtzOjE1OiJwb3NpeF9raWxsXHMqXCgiO2k6MjU7czoyNzoiYXBhY2hlX2NoaWxkX3Rlcm1pbmF0ZVxzKlwoIjtpOjI2O3M6MTI6IlxiY2htb2RccypcKCI7aToyNztzOjEyOiJcYmNoZGlyXHMqXCgiO2k6Mjg7czoxNToicGNudGxfZXhlY1xzKlwoIjtpOjI5O3M6MTQ6IlxidmlydHVhbFxzKlwoIjtpOjMwO3M6MTU6InByb2NfY2xvc2VccypcKCI7aTozMTtzOjIwOiJwcm9jX2dldF9zdGF0dXNccypcKCI7aTozMjtzOjE5OiJwcm9jX3Rlcm1pbmF0ZVxzKlwoIjtpOjMzO3M6MTQ6InByb2NfbmljZVxzKlwoIjtpOjM0O3M6MTM6ImdldG15Z2lkXHMqXCgiO2k6MzU7czoxOToicHJvY19nZXRzdGF0dXNccypcKCI7aTozNjtzOjE1OiJwcm9jX2Nsb3NlXHMqXCgiO2k6Mzc7czoxOToiZXNjYXBlc2hlbGxjbWRccypcKCI7aTozODtzOjE5OiJlc2NhcGVzaGVsbGFyZ1xzKlwoIjtpOjM5O3M6MTY6InNob3dfc291cmNlXHMqXCgiO2k6NDA7czoxMzoiXGJwY2xvc2VccypcKCI7aTo0MTtzOjEzOiJzYWZlX2RpclxzKlwoIjtpOjQyO3M6MTY6ImluaV9yZXN0b3JlXHMqXCgiO2k6NDM7czoxMDoiY2hvd25ccypcKCI7aTo0NDtzOjEwOiJjaGdycFxzKlwoIjtpOjQ1O3M6MTc6InNob3duX3NvdXJjZVxzKlwoIjtpOjQ2O3M6MTk6Im15c3FsX2xpc3RfZGJzXHMqXCgiO2k6NDc7czoyMToiZ2V0X2N1cnJlbnRfdXNlclxzKlwoIjtpOjQ4O3M6MTI6ImdldG15aWRccypcKCI7aTo0OTtzOjExOiJcYmxlYWtccypcKCI7aTo1MDtzOjE1OiJwZnNvY2tvcGVuXHMqXCgiO2k6NTE7czoyMToiZ2V0X2N1cnJlbnRfdXNlclxzKlwoIjtpOjUyO3M6MTE6InN5c2xvZ1xzKlwoIjtpOjUzO3M6MTg6IlwkZGVmYXVsdF91c2VfYWpheCI7aTo1NDtzOjIxOiJldmFsXHMqXCgqXHMqdW5lc2NhcGUiO2k6NTU7czo3OiJGTG9vZGVSIjtpOjU2O3M6MzE6ImRvY3VtZW50XC53cml0ZVxzKlwoXHMqdW5lc2NhcGUiO2k6NTc7czoxMToiXGJjb3B5XHMqXCgiO2k6NTg7czoyMzoibW92ZV91cGxvYWRlZF9maWxlXHMqXCgiO2k6NTk7czo4OiJcLjMzMzMzMyI7aTo2MDtzOjg6IlwuNjY2NjY2IjtpOjYxO3M6MjE6InJvdW5kXHMqXCgqXHMqMFxzKlwpKiI7aTo2MjtzOjExMToiY29weVxzKlwoKlxzKlwkX0ZJTEVTXHMqXFtccypbJyJdezAsMX1maWxlWyciXXswLDF9XHMqXF1cW1xzKlsnIl17MCwxfXRtcF9uYW1lWyciXXswLDF9XHMqXF1ccyosXHMqXCR1cGxvYWRmaWxlIjtpOjYzO3M6MTI2OiJtb3ZlX3VwbG9hZGVkX2ZpbGVzXHMqXCgqXHMqXCRfRklMRVNccypcW1xzKlsnIl17MCwxfWZpbGVbJyJdezAsMX1ccypcXVxbXHMqWyciXXswLDF9dG1wX25hbWVbJyJdezAsMX1ccypcXVxzKixccypcJHVwbG9hZGZpbGUiO2k6NjQ7czo1MDoiaW5pX2dldFxzKlwoXHMqWyciXXswLDF9ZGlzYWJsZV9mdW5jdGlvbnNbJyJdezAsMX0iO2k6NjU7czozNjoiVU5JT05ccytTRUxFQ1RccytbJyJdezAsMX0wWyciXXswLDF9IjtpOjY2O3M6MTA6IjJccyo+XHMqJjEiO2k6Njc7czo1NzoiZWNob1xzKlwoKlxzKlwkX1NFUlZFUlxbWyciXXswLDF9RE9DVU1FTlRfUk9PVFsnIl17MCwxfVxdIjtpOjY4O3M6Mzc6Ij1ccypBcnJheVxzKlwoKlxzKmJhc2U2NF9kZWNvZGVccypcKCoiO2k6Njk7czoxNDoia2lsbGFsbFxzKy1cZCsiO2k6NzA7czo3OiJlcml1cWVyIjtpOjcxO3M6MTA6InRvdWNoXHMqXCgiO2k6NzI7czo3OiJzc2hrZXlzIjtpOjczO3M6ODoiQGluY2x1ZGUiO2k6NzQ7czo4OiJAcmVxdWlyZSI7aTo3NTtzOjM4OiJAaW5pX3NldFxzKlwoKlsnIl17MCwxfWFsbG93X3VybF9mb3BlbiI7aTo3NjtzOjE4OiJAZmlsZV9nZXRfY29udGVudHMiO2k6Nzc7czoxNzoiZmlsZV9wdXRfY29udGVudHMiO2k6Nzg7czo0NjoiYW5kcm9pZFxzKlx8XHMqbWlkcFxzKlx8XHMqajJtZVxzKlx8XHMqc3ltYmlhbiI7aTo3OTtzOjI4OiJAc2V0Y29va2llXHMqXCgqWyciXXswLDF9aGl0IjtpOjgwO3M6MTA6IkBmaWxlb3duZXIiO2k6ODE7czo2OiI8a3VrdT4iO2k6ODI7czo1OiJzeXBleCI7aTo4MztzOjk6IlwkYmVlY29kZSI7aTo4NDtzOjg6IkJhY2tkb29yIjtpOjg1O3M6MTQ6InBocF91bmFtZVxzKlwoIjtpOjg2O3M6NTU6Im1haWxccypcKCpccypcJHRvXHMqLFxzKlwkc3VialxzKixccypcJG1zZ1xzKixccypcJGZyb20iO2k6ODc7czo2NzoibWFpbFxzKlwoKlxzKlwkc2VuZFxzKixccypcJHN1YmplY3RccyosXHMqXCRoZWFkZXJzXHMqLFxzKlwkbWVzc2FnZSI7aTo4ODtzOjY1OiJtYWlsXHMqXCgqXHMqXCR0b1xzKixccypcJHN1YmplY3RccyosXHMqXCRtZXNzYWdlXHMqLFxzKlwkaGVhZGVycyI7aTo4OTtzOjEyMDoic3RycG9zXHMqXCgqXHMqXCRuYW1lXHMqLFxzKlsnIl17MCwxfUhUVFBfWyciXXswLDF9XHMqXCkqXHMqIT09XHMqMFxzKiYmXHMqc3RycG9zXHMqXCgqXHMqXCRuYW1lXHMqLFxzKlsnIl17MCwxfVJFUVVFU1RfIjtpOjkwO3M6NTQ6ImlzX2Z1bmN0aW9uX2VuYWJsZWRccypcKFxzKipbJyJdezAsMX1pZ25vcmVfdXNlcl9hYm9ydCI7aTo5MTtzOjMwOiJlY2hvXHMqXCgqXHMqZmlsZV9nZXRfY29udGVudHMiO2k6OTI7czoyNjoiZWNob1xzKlwoKlsnIl17MCwxfTxzY3JpcHQiO2k6OTM7czozMToicHJpbnRccypcKCpccypmaWxlX2dldF9jb250ZW50cyI7aTo5NDtzOjI3OiJwcmludFxzKlwoKlsnIl17MCwxfTxzY3JpcHQiO2k6OTU7czo4NToiPG1hcnF1ZWVccytzdHlsZVxzKj1ccypbJyJdezAsMX1wb3NpdGlvblxzKjpccyphYnNvbHV0ZVxzKjtccyp3aWR0aFxzKjpccypcZCtccypweFxzKiI7aTo5NjtzOjQyOiI9XHMqWyciXXswLDF9XC5cLi9cLlwuL1wuXC4vd3AtY29uZmlnXC5waHAiO2k6OTc7czo3OiJlZ2dkcm9wIjtpOjk4O3M6OToicnd4cnd4cnd4IjtpOjk5O3M6MTU6ImVycm9yX3JlcG9ydGluZyI7aToxMDA7czoxNzoiXGJjcmVhdGVfZnVuY3Rpb24iO2k6MTAxO3M6NDM6Intccypwb3NpdGlvblxzKjpccyphYnNvbHV0ZTtccypsZWZ0XHMqOlxzKi0iO2k6MTAyO3M6MTU6IjxzY3JpcHRccythc3luYyI7aToxMDM7czo2NjoiX1snIl17MCwxfVxzKlxdXHMqPVxzKkFycmF5XHMqXChccypiYXNlNjRfZGVjb2RlXHMqXCgqXHMqWyciXXswLDF9IjtpOjEwNDtzOjMzOiJBZGRUeXBlXHMrYXBwbGljYXRpb24veC1odHRwZC1jZ2kiO2k6MTA1O3M6NDQ6ImdldGVudlxzKlwoKlxzKlsnIl17MCwxfUhUVFBfQ09PS0lFWyciXXswLDF9IjtpOjEwNjtzOjQ2OiJpZ25vcmVfdXNlcl9hYm9ydFxzKlwoKlxzKlsnIl17MCwxfSoxWyciXXswLDF9IjtpOjEwNztzOjIxOiJcJF9SRVFVRVNUXHMqXFtccyolMjIiO2k6MTA4O3M6NTE6InVybFxzKlwoWyciXXswLDF9ZGF0YVxzKjpccyppbWFnZS9wbmc7XHMqYmFzZTY0XHMqLCI7aToxMDk7czo1MToidXJsXHMqXChbJyJdezAsMX1kYXRhXHMqOlxzKmltYWdlL2dpZjtccypiYXNlNjRccyosIjtpOjExMDtzOjMwOiI6XHMqdXJsXHMqXChccypbJyJdezAsMX08XD9waHAiO2k6MTExO3M6MTc6IjwvaHRtbD4uKz88c2NyaXB0IjtpOjExMjtzOjE3OiI8L2h0bWw+Lis/PGlmcmFtZSI7aToxMTM7czo1NToiKHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilccypbJyJcKFwkXSI7aToxMTQ7czoxMToiXGJtYWlsXHMqXCgiO2k6MTE1O3M6NDY6ImZpbGVfZ2V0X2NvbnRlbnRzXHMqXCgqXHMqWyciXXswLDF9cGhwOi8vaW5wdXQiO2k6MTE2O3M6MTE4OiI8bWV0YVxzK2h0dHAtZXF1aXY9WyciXXswLDF9Q29udGVudC10eXBlWyciXXswLDF9XHMrY29udGVudD1bJyJdezAsMX10ZXh0L2h0bWw7XHMqY2hhcnNldD13aW5kb3dzLTEyNTFbJyJdezAsMX0+PGJvZHk+IjtpOjExNztzOjYyOiI9XHMqZG9jdW1lbnRcLmNyZWF0ZUVsZW1lbnRcKFxzKlsnIl17MCwxfXNjcmlwdFsnIl17MCwxfVxzKlwpOyI7fQ=="));
$g_SusDBPrio = unserialize(base64_decode("YToxMTU6e2k6MDtpOjA7aToxO2k6MDtpOjI7aTowO2k6MztpOjA7aTo0O2k6MTtpOjU7aToxO2k6NjtpOjA7aTo3O2k6MDtpOjg7aTowO2k6OTtpOjA7aToxMDtpOjA7aToxMTtpOjA7aToxMjtpOjA7aToxMztpOjA7aToxNDtpOjA7aToxNTtpOjA7aToxNjtpOjA7aToxNztpOjA7aToxODtpOjA7aToxOTtpOjA7aToyMDtpOjA7aToyMTtpOjA7aToyMjtpOjA7aToyMztpOjA7aToyNDtpOjA7aToyNTtpOjE7aToyNjtpOjE7aToyNztpOjA7aToyODtpOjA7aToyOTtpOjA7aTozMDtpOjA7aTozMTtpOjA7aTozMjtpOjA7aTozMztpOjA7aTozNDtpOjA7aTozNTtpOjA7aTozNjtpOjA7aTozNztpOjA7aTozODtpOjA7aTozOTtpOjA7aTo0MDtpOjA7aTo0MTtpOjA7aTo0MjtpOjA7aTo0MztpOjA7aTo0NDtpOjA7aTo0NTtpOjA7aTo0NjtpOjA7aTo0NztpOjA7aTo0ODtpOjA7aTo0OTtpOjA7aTo1MDtpOjA7aTo1MTtpOjA7aTo1MjtpOjE7aTo1MztpOjA7aTo1NDtpOjA7aTo1NTtpOjI7aTo1NjtpOjE7aTo1NztpOjA7aTo1ODtpOjA7aTo1OTtpOjA7aTo2MDtpOjI7aTo2MTtpOjI7aTo2MjtpOjA7aTo2MztpOjA7aTo2NDtpOjA7aTo2NTtpOjI7aTo2NjtpOjE7aTo2NztpOjA7aTo2ODtpOjA7aTo2OTtpOjE7aTo3MDtpOjA7aTo3MTtpOjE7aTo3MjtpOjE7aTo3MztpOjE7aTo3NDtpOjM7aTo3NTtpOjI7aTo3NjtpOjA7aTo3NztpOjI7aTo3ODtpOjA7aTo3OTtpOjA7aTo4MDtpOjI7aTo4MTtpOjA7aTo4MjtpOjA7aTo4MztpOjA7aTo4NDtpOjE7aTo4NTtpOjE7aTo4NjtpOjE7aTo4NztpOjE7aTo4ODtpOjA7aTo4OTtpOjI7aTo5MDtpOjI7aTo5MTtpOjI7aTo5MjtpOjI7aTo5MztpOjI7aTo5NDtpOjE7aTo5NTtpOjE7aTo5NjtpOjM7aTo5NztpOjM7aTo5ODtpOjE7aTo5OTtpOjM7aToxMDA7aTozO2k6MTAxO2k6MjtpOjEwMjtpOjA7aToxMDM7aTozO2k6MTA0O2k6MTtpOjEwNTtpOjE7aToxMDY7aTozO2k6MTA3O2k6MztpOjEwODtpOjM7aToxMDk7aToxO2k6MTEwO2k6MTtpOjExMTtpOjE7aToxMTI7aTo0O2k6MTEzO2k6MTtpOjExNDtpOjM7fQ=="));
$g_AdwareSig = unserialize(base64_decode("YToyNzp7aTowO3M6MTk6Il9fbGlua2ZlZWRfcm9ib3RzX18iO2k6MTtzOjEzOiJMSU5LRkVFRF9VU0VSIjtpOjI7czoxODoiX19zYXBlX2RlbGltaXRlcl9fIjtpOjM7czoyOToiZGlzcGVuc2VyXC5hcnRpY2xlc1wuc2FwZVwucnUiO2k6NDtzOjExOiJMRU5LX2NsaWVudCI7aTo1O3M6MTE6IlNBUEVfY2xpZW50IjtpOjY7czoxNjoiU0xBcnRpY2xlc0NsaWVudCI7aTo3O3M6MTc6Ii0+R2V0TGlua3NccypcKFwpIjtpOjg7czoxNzoiZGJcLnRydXN0bGlua1wucnUiO2k6OTtzOjM3OiJjbGFzc1xzK0NNX2NsaWVudFxzK2V4dGVuZHNccypDTV9iYXNlIjtpOjEwO3M6MTk6Im5ld1xzK0NNX2NsaWVudFwoXCkiO2k6MTE7czoxNjoidGxfbGlua3NfZGJfZmlsZSI7aToxMjtzOjE1OiJUcnVzdGxpbmtDbGllbnQiO2k6MTM7czoxMzoiLT5ccypTTENsaWVudCI7aToxNDtzOjE2NjoiaXNzZXRccypcKCpccypcJF9TRVJWRVJccypcW1xzKlsnIl17MCwxfUhUVFBfVVNFUl9BR0VOVFsnIl17MCwxfVxzKlxdXHMqXClccyomJlxzKlwoKlxzKlwkX1NFUlZFUlxzKlxbXHMqWyciXXswLDF9SFRUUF9VU0VSX0FHRU5UWyciXXswLDF9XF1ccyo9PVxzKlsnIl17MCwxfUxNUF9Sb2JvdCI7aToxNTtzOjQzOiJcJGxpbmtzLT5ccypyZXR1cm5fbGlua3NccypcKCpccypcJGxpYl9wYXRoIjtpOjE2O3M6NDQ6IlwkbGlua3NfY2xhc3Nccyo9XHMqbmV3XHMrR2V0X2xpbmtzXHMqXCgqXHMqIjtpOjE3O3M6NTI6IlsnIl17MCwxfVxzKixccypbJyJdezAsMX1cLlsnIl17MCwxfVxzKlwpKlxzKjtccypcPz4iO2k6MTg7czo3OiJsZXZpdHJhIjtpOjE5O3M6MTA6ImRhcG94ZXRpbmUiO2k6MjA7czo2OiJ2aWFncmEiO2k6MjE7czo2OiJjaWFsaXMiO2k6MjI7czo4OiJwcm92aWdpbCI7aToyMztzOjE5OiJjbGFzc1xzK1RXZWZmQ2xpZW50IjtpOjI0O3M6MTg6Im5ld1xzK1NMQ2xpZW50XChcKSI7aToyNTtzOjI0OiJfX2xpbmtmZWVkX2JlZm9yZV90ZXh0X18iO2k6MjY7czoxNjoiX190ZXN0X3RsX2xpbmtfXyI7fQ=="));
$g_JSVirSig = unserialize(base64_decode("YTo4NTp7aTowO3M6NDE6ImY9J2YnXCsncidcKydvJ1wrJ20nXCsnQ2gnXCsnYXJDJ1wrJ29kZSc7IjtpOjE7czoyMjoiXC5wcm90b3R5cGVcLmF9Y2F0Y2hcKCI7aToyO3M6Mzc6InRyeXtCb29sZWFuXChcKVwucHJvdG90eXBlXC5xfWNhdGNoXCgiO2k6MztzOjM0OiJpZlwoUmVmXC5pbmRleE9mXCgnXC5nb29nbGVcLidcKSE9IjtpOjQ7czo4NjoiaW5kZXhPZlx8aWZcfHJjXHxsZW5ndGhcfG1zblx8eWFob29cfHJlZmVycmVyXHxhbHRhdmlzdGFcfG9nb1x8YmlcfGhwXHx2YXJcfGFvbFx8cXVlcnkiO2k6NTtzOjU0OiJBcnJheVwucHJvdG90eXBlXC5zbGljZVwuY2FsbFwoYXJndW1lbnRzXClcLmpvaW5cKCIiXCkiO2k6NjtzOjgyOiJxPWRvY3VtZW50XC5jcmVhdGVFbGVtZW50XCgiZCJcKyJpIlwrInYiXCk7cVwuYXBwZW5kQ2hpbGRcKHFcKyIiXCk7fWNhdGNoXChxd1wpe2g9IjtpOjc7czo3OToiXCt6ejtzcz1cW1xdO2Y9J2ZyJ1wrJ29tJ1wrJ0NoJztmXCs9J2FyQyc7ZlwrPSdvZGUnO3c9dGhpcztlPXdcW2ZcWyJzdWJzdHIiXF1cKCI7aTo4O3M6MTE1OiJzNVwocTVcKXtyZXR1cm4gXCtcK3E1O31mdW5jdGlvbiB5Zlwoc2Ysd2VcKXtyZXR1cm4gc2ZcLnN1YnN0clwod2UsMVwpO31mdW5jdGlvbiB5MVwod2JcKXtpZlwod2I9PTE2OFwpd2I9MTAyNTtlbHNlIjtpOjk7czo2NDoiaWZcKG5hdmlnYXRvclwudXNlckFnZW50XC5tYXRjaFwoL1woYW5kcm9pZFx8bWlkcFx8ajJtZVx8c3ltYmlhbiI7aToxMDtzOjEwNjoiZG9jdW1lbnRcLndyaXRlXCgnPHNjcmlwdCBsYW5ndWFnZT0iSmF2YVNjcmlwdCIgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9IidcK2RvbWFpblwrJyI+PC9zY3InXCsnaXB0PidcKSI7aToxMTtzOjMxOiJodHRwOi8vcGhzcFwucnUvXy9nb1wucGhwXD9zaWQ9IjtpOjEyO3M6MTc6IjwvaHRtbD5ccyo8c2NyaXB0IjtpOjEzO3M6MTc6IjwvaHRtbD5ccyo8aWZyYW1lIjtpOjE0O3M6NjY6Ij1uYXZpZ2F0b3JcW2FwcFZlcnNpb25fdmFyXF1cLmluZGV4T2ZcKCJNU0lFIlwpIT0tMVw/JzxpZnJhbWUgbmFtZSI7aToxNTtzOjc6IlxceDY1QXQiO2k6MTY7czo5OiJcXHg2MXJDb2QiO2k6MTc7czoyMjoiImZyIlwrIm9tQyJcKyJoYXJDb2RlIiI7aToxODtzOjExOiI9ImV2IlwrImFsIiI7aToxOTtzOjc4OiJcW1woXChlXClcPyJzIjoiIlwpXCsicCJcKyJsaXQiXF1cKCJhXCQiXFtcKFwoZVwpXD8ic3UiOiIiXClcKyJic3RyIlxdXCgxXClcKTsiO2k6MjA7czozOToiZj0nZnInXCsnb20nXCsnQ2gnO2ZcKz0nYXJDJztmXCs9J29kZSc7IjtpOjIxO3M6MjA6ImZcKz1cKGhcKVw/J29kZSc6IiI7IjtpOjIyO3M6NDE6ImY9J2YnXCsncidcKydvJ1wrJ20nXCsnQ2gnXCsnYXJDJ1wrJ29kZSc7IjtpOjIzO3M6NTA6ImY9J2Zyb21DaCc7ZlwrPSdhckMnO2ZcKz0ncWdvZGUnXFsic3Vic3RyIlxdXCgyXCk7IjtpOjI0O3M6MTY6InZhclxzK2Rpdl9jb2xvcnMiO2k6MjU7czo5OiJ2YXJccytfMHgiO2k6MjY7czoyMDoiQ29yZUxpYnJhcmllc0hhbmRsZXIiO2k6Mjc7czo3OiJwaW5nbm93IjtpOjI4O3M6ODoic2VyY2hib3QiO2k6Mjk7czoxMDoia20wYWU5Z3I2bSI7aTozMDtzOjY6ImMzMjg0ZCI7aTozMTtzOjg6IlxceDY4YXJDIjtpOjMyO3M6ODoiXFx4NmRDaGEiO2k6MzM7czo3OiJcXHg2ZmRlIjtpOjM0O3M6NzoiXFx4NmZkZSI7aTozNTtzOjg6IlxceDQzb2RlIjtpOjM2O3M6NzoiXFx4NzJvbSI7aTozNztzOjc6IlxceDQzaGEiO2k6Mzg7czo3OiJcXHg3MkNvIjtpOjM5O3M6ODoiXFx4NDNvZGUiO2k6NDA7czoxMDoiXC5keW5kbnNcLiI7aTo0MTtzOjk6IlwuZHluZG5zLSI7aTo0MjtzOjc5OiJ9XHMqZWxzZVxzKntccypkb2N1bWVudFwud3JpdGVccypcKFxzKlsnIl17MCwxfVwuWyciXXswLDF9XClccyp9XHMqfVxzKlJcKFxzKlwpIjtpOjQzO3M6NDU6ImRvY3VtZW50XC53cml0ZVwodW5lc2NhcGVcKCclM0NkaXYlMjBpZCUzRCUyMiI7aTo0NDtzOjE4OiJcLmJpdGNvaW5wbHVzXC5jb20iO2k6NDU7czo0MToiXC5zcGxpdFwoIiYmIlwpO2g9MjtzPSIiO2lmXChtXClmb3JcKGk9MDsiO2k6NDY7czo0ODoiZG9jdW1lbnRcLndyaXRlXHMqXChccyp1bmVzY2FwZVxzKlwoWyciXXswLDF9JTNjIjtpOjQ3O3M6NDE6IjxpZnJhbWVccytzcmM9Imh0dHA6Ly9kZWx1eGVzY2xpY2tzXC5wcm8vIjtpOjQ4O3M6NDU6IjNCZm9yXHxmcm9tQ2hhckNvZGVcfDJDMjdcfDNEXHwyQzg4XHx1bmVzY2FwZSI7aTo0OTtzOjU4OiI7XHMqZG9jdW1lbnRcLndyaXRlXChbJyJdezAsMX08aWZyYW1lXHMqc3JjPSJodHRwOi8veWFcLnJ1IjtpOjUwO3M6MTEwOiJ3XC5kb2N1bWVudFwuYm9keVwuYXBwZW5kQ2hpbGRcKHNjcmlwdFwpO1xzKmNsZWFySW50ZXJ2YWxcKGlcKTtccyp9XHMqfVxzKixccypcZCtccypcKVxzKjtccyp9XHMqXClcKFxzKndpbmRvdyI7aTo1MTtzOjExMDoiaWZcKCFnXChcKSYmd2luZG93XC5uYXZpZ2F0b3JcLmNvb2tpZUVuYWJsZWRcKXtkb2N1bWVudFwuY29va2llPSIxPTE7ZXhwaXJlcz0iXCtlXC50b0dNVFN0cmluZ1woXClcKyI7cGF0aD0vIjsiO2k6NTI7czo3MDoibm5fcGFyYW1fcHJlbG9hZGVyX2NvbnRhaW5lclx8NTAwMVx8aGlkZGVuXHxpbm5lckhUTUxcfGluamVjdFx8dmlzaWJsZSI7aTo1MztzOjMxOiI8IS0tIFthLXpBLVowLTlfXSs/XHxcfHN0YXQgLS0+IjtpOjU0O3M6ODU6IiZwYXJhbWV0ZXI9XCRrZXl3b3JkJnNlPVwkc2UmdXI9MSZIVFRQX1JFRkVSRVI9J1wrZW5jb2RlVVJJQ29tcG9uZW50XChkb2N1bWVudFwuVVJMXCkiO2k6NTU7czo0ODoid2luZG93c1x8c2VyaWVzXHw2MFx8c3ltYm9zXHxjZVx8bW9iaWxlXHxzeW1iaWFuIjtpOjU2O3M6Mjk6IlxbImV2YWwiXF1cKHNcKTt9fX19PC9zY3JpcHQ+IjtpOjU3O3M6NTk6ImtDNzBGTWJseUprRldab2RDS2wxV1lPZFdZVWxuUXpSbmJsMVdac1ZFZGxkbUwwNVdadFYzWXZSR0k5IjtpOjU4O3M6NTU6IntrPWk7cz1zXC5jb25jYXRcKHNzXChldmFsXChhc3FcKFwpXCktMVwpXCk7fXo9cztldmFsXCgiO2k6NTk7czoxMzA6ImRvY3VtZW50XC5jb29raWVcLm1hdGNoXChuZXdccytSZWdFeHBcKFxzKiJcKFw/OlxeXHw7IFwpIlxzKlwrXHMqbmFtZVwucmVwbGFjZVwoL1woXFtcXFwuXCRcP1wqXHx7fVxcXChcXFwpXFxcW1xcXF1cXC9cXFwrXF5cXVwpL2ciO2k6NjA7czo4Njoic2V0Q29va2llXHMqXCgqXHMqImFyeF90dCJccyosXHMqMVxzKixccypkdFwudG9HTVRTdHJpbmdcKFwpXHMqLFxzKlsnIl17MCwxfS9bJyJdezAsMX0iO2k6NjE7czoxNDoiL1wqMjE0YWZhYWVcKi8iO2k6NjI7czoxNDQ6ImRvY3VtZW50XC5jb29raWVcLm1hdGNoXHMqXChccypuZXdccytSZWdFeHBccypcKFxzKiJcKFw/OlxeXHw7XHMqXCkiXHMqXCtccypuYW1lXC5yZXBsYWNlXHMqXCgvXChcW1xcXC5cJFw/XCpcfHt9XFxcKFxcXClcXFxbXFxcXVxcL1xcXCtcXlxdXCkvZyI7aTo2MztzOjk4OiJ2YXJccytkdFxzKz1ccytuZXdccytEYXRlXChcKSxccytleHBpcnlUaW1lXHMrPVxzK2R0XC5zZXRUaW1lXChccytkdFwuZ2V0VGltZVwoXClccytcK1xzKzkwMDAwMDAwMCI7aTo2NDtzOjEwNToiaWZccypcKFxzKm51bVxzKj09PVxzKjBccypcKVxzKntccypyZXR1cm5ccyoxO1xzKn1ccyplbHNlXHMqe1xzKnJldHVyblxzK251bVxzKlwqXHMqckZhY3RcKFxzKm51bVxzKi1ccyoxIjtpOjY1O3M6NDE6IlwrPVN0cmluZ1wuZnJvbUNoYXJDb2RlXChwYXJzZUludFwoMFwrJ3gnIjtpOjY2O3M6ODM6IjxzY3JpcHRccytsYW5ndWFnZT0iSmF2YVNjcmlwdCI+XHMqcGFyZW50XC53aW5kb3dcLm9wZW5lclwubG9jYXRpb249Imh0dHA6Ly92a1wuY29tIjtpOjY3O3M6NDQ6ImxvY2F0aW9uXC5yZXBsYWNlXChbJyJdezAsMX1odHRwOi8vdjVrNDVcLnJ1IjtpOjY4O3M6MTI5OiI7dHJ5e1wrXCtkb2N1bWVudFwuYm9keX1jYXRjaFwocVwpe2FhPWZ1bmN0aW9uXChmZlwpe2ZvclwoaT0wO2k8elwubGVuZ3RoO2lcK1wrXCl7emFcKz1TdHJpbmdcW2ZmXF1cKGVcKHZcK1woelxbaVxdXClcKS0xMlwpO319O30iO2k6Njk7czoxNDI6ImRvY3VtZW50XC53cml0ZVxzKlwoWyciXXswLDF9PFsnIl17MCwxfVxzKlwrXHMqeFxbMFxdXHMqXCtccypbJyJdezAsMX0gWyciXXswLDF9XHMqXCtccyp4XFs0XF1ccypcK1xzKlsnIl17MCwxfT5cLlsnIl17MCwxfVxzKlwreFxzKlxbMlxdXHMqXCsiO2k6NzA7czo2MDoiaWZcKHRcLmxlbmd0aD09Mlwpe3pcKz1TdHJpbmdcLmZyb21DaGFyQ29kZVwocGFyc2VJbnRcKHRcKVwrIjtpOjcxO3M6NzQ6IndpbmRvd1wub25sb2FkXHMqPVxzKmZ1bmN0aW9uXChcKVxzKntccyppZlxzKlwoZG9jdW1lbnRcLmNvb2tpZVwuaW5kZXhPZlwoIjtpOjcyO3M6Nzk6ImRvY3VtZW50XC5nZXRFbGVtZW50c0J5VGFnTmFtZVwoWyciXXswLDF9aGVhZFsnIl17MCwxfVwpXFswXF1cLmFwcGVuZENoaWxkXChhXCkiO2k6NzM7czo5NzoiXC5zdHlsZVwuaGVpZ2h0XHMqPVxzKlsnIl17MCwxfTBweFsnIl17MCwxfTt3aW5kb3dcLm9ubG9hZFxzKj1ccypmdW5jdGlvblwoXClccyp7ZG9jdW1lbnRcLmNvb2tpZSI7aTo3NDtzOjEyMjoiXC5zcmM9XChbJyJdezAsMX1odHBzOlsnIl17MCwxfT09ZG9jdW1lbnRcLmxvY2F0aW9uXC5wcm90b2NvbFw/WyciXXswLDF9aHR0cHM6Ly9zc2xbJyJdezAsMX06WyciXXswLDF9aHR0cDovL1snIl17MCwxfVwpXCsiO2k6NzU7czozMDoiNDA0XC5waHBbJyJdezAsMX0+XHMqPC9zY3JpcHQ+IjtpOjc2O3M6NzY6InByZWdfbWF0Y2hcKFsnIl17MCwxfS9zYXBlL2lbJyJdezAsMX1ccyosXHMqXCRfU0VSVkVSXFtbJyJdezAsMX1IVFRQX1JFRkVSRVIiO2k6Nzc7czoyODoiaXBcKGhvbmVcfG9kXClcfGlyaXNcfGtpbmRsZSI7aTo3ODtzOjIxOiItXHMqUGF5UGFsXHMqPC90aXRsZT4iO2k6Nzk7czoyMjoiLVxzKlByaXZhdGlccyo8L3RpdGxlPiI7aTo4MDtzOjE5OiI8dGl0bGU+XHMqVW5pQ3JlZGl0IjtpOjgxO3M6NTM6Intwb3NpdGlvbjphYnNvbHV0ZTt0b3A6LTk5OTlweDt9PC9zdHlsZT48ZGl2XHMrY2xhc3M9IjtpOjgyO3M6MTI4OiJpZlxzKlwoXCh1YVwuaW5kZXhPZlwoWyciXXswLDF9Y2hyb21lWyciXXswLDF9XClccyo9PVxzKi0xXHMqJiZccyp1YVwuaW5kZXhPZlwoIndpbiJcKVxzKiE9XHMqLTFcKVxzKiYmXHMqbmF2aWdhdG9yXC5qYXZhRW5hYmxlZCI7aTo4MztzOjU4OiJwYXJlbnRcLndpbmRvd1wub3BlbmVyXC5sb2NhdGlvbj1bJyJdezAsMX1odHRwOi8vdmtcLmNvbVwuIjtpOjg0O3M6MTc6InNleGZyb21pbmRpYVwuY29tIjt9"));

$g_UnsafeFilesArray = array('t\d*\.php', 'a{1,}\.php', 'z\d*\.php', '123\.php', 'test\d*.php', 'asd\.php', 'info\.php', 'CHANGELOG\.php', 
                           'COPYRIGHT\.php', 'CREDITS\.php', 'INSTALL\.php', 'LICENSE\.php', 'LICENSES\.php', 'backup.+?\.zip', 
                           'backup.+?\.tar\.gz', 'backup.+?\.tgz', 
                           'phpinfo\.php', 'changelog\.txt', 'readme\.txt', 'INSTALLATION\.php', 'dump\.php', 'changelog\.log');

$g_UnsafeDirArray = array('install', 'backup', 'webalizer', 'awstats');

////////////////////////////////////////////////////////////////////////////
if (!isCli() && !isset($_SERVER['HTTP_USER_AGENT'])) {
  echo "#####################################################\n";
  echo "# Error: cannot run on php-cgi. Requires php as cli #\n";
  echo "#                                                   #\n";
  echo "# See FAQ: http://revisium.com/ai/faq.php           #\n";
  echo "#####################################################\n";
  exit;
}

define('AI_VERSION', '20130928');

define('INFO_M', base64_decode('PGZvbnQgY29sb3I9I0UwNjA2MD7QotC+0LvRjNC60L4g0LTQu9GPINC90LXQutC+0LzQvNC10YDRh9C10YHQutC+0LPQviDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjRjyE8L2ZvbnQ+PC9oNT4='));


////////////////////////////////////////////////////////////////////////////

$l_Res = '';

$g_Structure = array();
$g_Counter = 0;

$g_NotRead = array();
$g_FileInfo = array();
$g_Iframer = array();
$g_PHPCodeInside = array();
$g_CriticalJS = array();
$g_HeuristicDetected = array();
$g_HeuristicType = array();
$g_UnixExec = array();
$g_SkippedFolders = array();
$g_UnsafeFilesFound = array();
$g_CMS = array();
$g_SymLinks = array();
$g_HiddenFiles = array();

$g_TotalFolder = 0;
$g_TotalFiles = 0;

$g_FoundTotalDirs = 0;
$g_FoundTotalFiles = 0;

if (!isCli()) {
   $defaults['site_url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/'; 
}

define('CRC32_LIMIT', pow(2, 31) - 1);
define('CRC32_DIFF', CRC32_LIMIT * 2 -2);

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

set_time_limit(0);
ini_set('max_execution_time', '90000');
ini_set('memory_limit','256M');

if (!function_exists('stripos')) {
	function stripos($par_Str, $par_Entry, $Offset = 0) {
		return strpos(strtolower($par_Str), strtolower($par_Entry), $Offset);
	}
}

/**
 * Print file
*/
function printFile() {
	$l_FileName = $_GET['fn'];
	$l_CRC = isset($_GET['c']) ? (int)$_GET['c'] : 0;
	$l_Content = implode('', file($l_FileName));
	$l_FileCRC = realCRC($l_Content);
	if ($l_FileCRC != $l_CRC) {
		echo 'Доступ запрещен.';
		exit;
	}
	
	echo '<pre>' . htmlspecialchars($l_Content) . '</pre>';
}

/**
 *
 */
function realCRC($str_in, $full = false)
{
        $in = crc32( $full ? normal($str_in) : $str_in );
        return ($in > CRC32_LIMIT) ? ($in - CRC32_DIFF) : $in;
}


/**
 * Determine php script is called from the command line interface
 * @return bool
 */
function isCli()
{
	return php_sapi_name() == 'cli';
}

/*
 *
 */
function shanonEntropy($par_Str)
{
    $dic = array();

    $len = strlen($par_Str);
    for ($i = 0; $i < $len; $i++) {
        $dic[$par_Str[$i]]++;
    } 

    $result = 0.0;
    $frequency = 0.0;
    foreach ($dic as $item)
    {
        $frequency = (float)$item / (float)$len;
        $result -= $frequency * (log($frequency) / log(2));
    }

    return $result;
}

 function generatePassword ($length = 9)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }

/**
 * Print to console
 * @param mixed $text
 * @param bool $add_lb Add line break
 * @return void
 */
function stdOut($text, $add_lb = true)
{
	global $BOOL_RESULT;

	if (!isCli())
		return;
		
	if (is_bool($text))
	{
		$text = $text ? 'true' : 'false';
	}
	else if (is_null($text))
	{
		$text = 'null';
	}
	if (!is_scalar($text))
	{
		$text = print_r($text, true);
	}

 	if (!$BOOL_RESULT)
 	{
 		@fwrite(STDOUT, $text . ($add_lb ? "\n" : ''));
 	}
}

/**
 * Print progress
 * @param int $num Current file
 */
function printProgress($num, &$par_File)
{

	$total_files = $GLOBALS['g_FoundTotalFiles'];
	$elapsed_time = microtime(true) - START_TIME;
	$stat = '';
	if ($elapsed_time >= 1)
	{
		$elapsed_seconds = round($elapsed_time, 0);
		$fs = floor($num / $elapsed_seconds);
		$left_files = $total_files - $num;
		if ($fs > 0) 
		{
		   $left_time = ($left_files / $fs); //ceil($left_files / $fs);
		   $stat = '. [Avg: ' . round($fs,2) . ' files/s' . ($left_time > 0  ? ' Left: ' . seconds2Human($left_time) : '') . ']';
        }
	}

	$l_FN = substr($par_File, -60);

	$text = "Scanning file [$l_FN] $num of {$total_files}" . $stat;
	$text = str_pad($text, 160, ' ', STR_PAD_RIGHT);
	stdOut(str_repeat(chr(8), 160) . $text, false);
}

/**
 * Seconds to human readable
 * @param int $seconds
 * @return string
 */
function seconds2Human($seconds)
{
	$r = '';
	$_seconds = floor($seconds);
	$ms = $seconds - $_seconds;
	$seconds = $_seconds;
	if ($hours = floor($seconds / 3600))
	{
		$r .= $hours . (isCli() ? ' h ' : ' час ');
		$seconds = $seconds % 3600;
	}

	if ($minutes = floor($seconds / 60))
	{
		$r .= $minutes . (isCli() ? ' m ' : ' мин ');
		$seconds = $seconds % 60;
	}

	if ($minutes<3) $r .= ' ' . $seconds + ($ms > 0 ? round($ms, 5) : 0) . (isCli() ? ' s' : ' сек'); //' сек' - not good for shell

	return $r;
}

if (isCli())
{

	$cli_options = array(
		'm:' => 'memory:',
		's:' => 'size:',
		'a' => 'all',
		'd:' => 'delay:',
		'r:' => 'report:',
		'f' => 'fast',
		'j:' => 'file',
		'p:' => 'path:',
		'q' => 'quite',
		'h' => 'help'
	);

	$options = getopt(implode('', array_keys($cli_options)), array_values($cli_options));

	if (isset($options['h']) OR isset($options['help']))
	{
		$memory_limit = ini_get('memory_limit');
		echo <<<HELP
AI-Bolit - Script to search for shells and other malicious software.

Usage: php {$_SERVER['PHP_SELF']} [OPTIONS] [PATH]
Current default path is: {$defaults['path']}

Mandatory arguments to long options are mandatory for short options too.
  -j, --file=FILE      Specified path and filename to scan the only file
  -p, --path=PATH      Directory path to scan, by default the file directory is used
                       Current path: {$defaults['path']}
  -m, --memory=SIZE    Maximum amount of memory a script may consume. Current value: $memory_limit
                       Can take shorthand byte values (1M, 1G...)
  -s, --size=SIZE      Scan files are smaller than SIZE. 0 - All files. Current value: {$defaults['max_size_to_scan']}
  -a, --all            Scan all files (by default scan. js,. php,. html,. htaccess)
  -d, --delay=INT      delay in milliseconds when scanning files to reduce load on the file system (Default: 1)
  -r, --report=PATH    Filename of report html, by default 'AI-BOLIT-REPORT-dd-mm-YYYY_hh-mm.html'  is used, relative to scan path
                       Enter your email address if you wish to report has been sent to the email.
                       You can also specify multiple email separated by commas.
  -q, 		       Use only with -j. Quiet result check of file, 1=Infected 
      --help           display this help and exit

HELP;
		exit;
	}

	$l_FastCli = false;
	
	if (
		(isset($options['memory']) AND !empty($options['memory']) AND ($memory = $options['memory']))
		OR (isset($options['m']) AND !empty($options['m']) AND ($memory = $options['m']))
	)
	{
		$memory = getBytes($memory);
		if ($memory > 0)
		{
			$defaults['memory_limit'] = $memory;
		}
	}

	if (
		(isset($options['file']) AND !empty($options['file']) AND ($file = $options['file']) !== false)
		OR (isset($options['j']) AND !empty($options['j']) AND ($file = $options['j']) !== false)
	)
	{
		define('SCAN_FILE', $file);
	}

	if (
		(isset($options['size']) AND !empty($options['size']) AND ($size = $options['size']) !== false)
		OR (isset($options['s']) AND !empty($options['s']) AND ($size = $options['s']) !== false)
	)
	{
		$size = getBytes($size);
		$defaults['max_size_to_scan'] = $size > 0 ? $size : 0;
	}

 	if (
 		(isset($options['file']) AND !empty($options['file']) AND ($file = $options['file']) !== false)
 		OR (isset($options['j']) AND !empty($options['j']) AND ($file = $options['j']) !== false)
 		AND (isset($options['q'])) 
 	
 	)
 	{
 		$BOOL_RESULT = true;
 	}
 
	if (isset($options['f'])) 
	 {
	   $l_FastCli = true;
	 }
		
	if (
		(isset($options['delay']) AND !empty($options['delay']) AND ($delay = $options['delay']) !== false)
		OR (isset($options['d']) AND !empty($options['d']) AND ($delay = $options['d']) !== false)
	)
	{
		$delay = (int) $delay;
		if (!($delay < 0))
		{
			$defaults['scan_delay'] = $delay;
		}
	}

	if (isset($options['all']) OR isset($options['a']))
	{
		$defaults['scan_all_files'] = 1;
	}



	if (
		(isset($options['report']) AND ($report = $options['report']) !== false)
		OR (isset($options['r']) AND ($report = $options['r']) !== false)
	)
	{
		define('REPORT', $report);
	}

	defined('REPORT') OR define('REPORT', 'AI-BOLIT-REPORT-' . date('d-m-Y_H-i') . '-' . rand(1, 999999) . '.html');

	$last_arg = max(1, sizeof($_SERVER['argv']) - 1);
	if (isset($_SERVER['argv'][$last_arg]))
	{
		$path = $_SERVER['argv'][$last_arg];
		if (
			substr($path, 0, 1) != '-'
			AND (substr($_SERVER['argv'][$last_arg - 1], 0, 1) != '-' OR array_key_exists(substr($_SERVER['argv'][$last_arg - 1], -1), $cli_options)))
		{
			$defaults['path'] = $path;
		}
	}	
	
	if (
		(isset($options['path']) AND !empty($options['path']) AND ($path = $options['path']) !== false)
		OR (isset($options['p']) AND !empty($options['p']) AND ($path = $options['p']) !== false)
	)
	{
		$defaults['path'] = $path;
	}
}

// Init
define('MAX_ALLOWED_PHP_HTML_IN_DIR', 100);
define('BASE64_LENGTH', 69);
define('MAX_PREVIEW_LEN', 80);
define('MAX_EXT_LINKS', 1001);

// Perform full scan when running from command line
if (isCli() || isset($_GET['full'])) {
  $defaults['scan_all_files'] = 1;
}

if ($l_FastCli) {
  $defaults['scan_all_files'] = 0; 
}

define('SCAN_ALL_FILES', (bool) $defaults['scan_all_files']);
define('SCAN_DELAY', (int) $defaults['scan_delay']);
define('MAX_SIZE_TO_SCAN', getBytes($defaults['max_size_to_scan']));

if ($defaults['memory_limit'] AND ($defaults['memory_limit'] = getBytes($defaults['memory_limit'])) > 0)
	ini_set('memory_limit', $defaults['memory_limit']);

define('START_TIME', microtime(true));

define('ROOT_PATH', realpath($defaults['path']));

if (!ROOT_PATH)
{
        if (isCli())  {
		die(stdOut("Directory '{$defaults['path']}' not found!"));
	}
}
elseif(!is_readable(ROOT_PATH))
{
        if (isCli())  {
		die(stdOut("Cannot read directory '" . ROOT_PATH . "'!"));
	}
}

define('CURRENT_DIR', getcwd());
chdir(ROOT_PATH);

// Проверяем отчет
if (isCli() AND REPORT !== '' AND !getEmails(REPORT))
{
	$report = str_replace('\\', '/', REPORT);
	$abs = strpos($report, '/') === 0 ? DIR_SEPARATOR : '';
	$report = array_values(array_filter(explode('/', $report)));
	$report_file = array_pop($report);
	$report_path = realpath($abs . implode(DIR_SEPARATOR, $report));

	define('REPORT_FILE', $report_file);
	define('REPORT_PATH', $report_path);

	if (REPORT_FILE AND REPORT_PATH AND is_file(REPORT_PATH . DIR_SEPARATOR . REPORT_FILE))
	{
		@unlink(REPORT_PATH . DIR_SEPARATOR . REPORT_FILE);
	}
}


if (function_exists('phpinfo')) {
   ob_start();
   phpinfo();
   $l_PhpInfo = ob_get_contents();
   ob_end_clean();

   $l_PhpInfo = str_replace('border: 1px', '', $l_PhpInfo);
   preg_match('|<body>(.*)</body>|smi', $l_PhpInfo, $l_PhpInfoBody);
}

$l_Result =<<<MAIN_PAGE

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
<style type="text/css">
 body {
   font-family: Georgia;
   color: #303030;
   background: #FFFFF0;
   font-size: 12px;
   margin: 20px;
   padding: 0;
 }

 h3 {
   font-size: 27px;
   margin: 0 0;
 }

 .sec {
  font-size: 25px;
  margin-bottom: 10px;
 }


 .warn {
   color: #FF4C00;
   margin: 0 0 20px 0;
 }

 .warn .it {
   color: #FF4C00;
 }

 .warn2 {
   color: #42ADFF;
   margin: 0 0 20px 0;
 }

 .warn2 .it {
   color: #42ADFF;
 }

 .ok {
   color: #007F0E;
   margin: 0 0 20px 0;
 }

 .vir {
    color: #A00000;
    margin: 0 0 20px 0;
  }

 .vir .it {
    color: #A00000;
 }

 .disclaimer {
   font-size: 11px;
   font-family: Arial;
   color: #505050;
   margin: 10px 0 10px 0;
 }

 .thanx {
  border: 1px solid #F0F0F0;
   padding: 20px 20px 10px 20px;
  font-size: 12px;
  font-family: Arial;
  background: #FBFFBA;
 }

 .footer {
  margin: 40px 0 0 0;
 }

 .rep {
   margin: 10px 0 20px 0;
   font-size: 11px;
   font-family: Arial;
 }

 .php_ok
 {
  color: #007F0E; 
 }

 .php_bad
 {
  color: #A00000; 
 }

 .notice
 {
  border: 1px solid cornflowerblue;
  padding: 10px;
  font-size: 12px;
  font-family: Arial;
  background: #E8F8F8;
 }

 .offer {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 85px;
   background: #E06060;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

  .offer2 {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 100px;
   background: #30A030;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

 
 .offer A, .offer2 A {
   color: yellow;
 }

 .update {
   color: red;
   font-size: 12px;
   font-family: Arial;
   margin: 0 0 20px 0;
 }

 .tbg0 {
 }

 .tbg1 {
   background: #F0F0F0;
 }

 .it {
    font-size: 12px;
    font-family: Arial;
 }

 .ctd {
    font-size: 12px;
    font-family: Arial;
    color: #909090;
 }

 .flist {
   margin: 10px 0 30px 0;
 }

 .tbgh {
   background: #E0E0E0;
 }

 TH {
   text-align: left;
   font-size: 12px;
   font-family: Arial;
   color: #909090;
 }

 .details {
  font-size: 9px;
  font-family: Arial;
  color: #303030;
 }

 .marker
 {
    color: #FF0000;
    font-size: 16px;
    font-weight: 700;
 }

</style>

<script language="javascript">
  function addToIgnore(par_Lnk, par_FN, par_CRC) {
	var o = document.getElementById('igid');
	var ta = document.forms.ignore.list;
	
	ta.value = ta.value + par_FN + String.fromCharCode(09) + par_CRC + String.fromCharCode(10);
	
	par_Lnk.innerHTML = 'Добавлено'; 
	o.style.display = 'block';
  }
</script>

</head>
<body>
<noindex>
MAIN_PAGE;

////////////////////////////////////////////////////////////////////////////

$l_Result .= sprintf(AI_STR_001, AI_VERSION, INFO_M); 

$l_CreationTime = filemtime(__FILE__);
if (time() - $l_CreationTime > 86400 * 7) {
  $l_Result .= AI_STR_002;
}

$l_Result .= '<div class="update" style="margin: 20px 0 20px 0; padding: 20px; width: 500px; border: 1px solid #400000"><b>' . AI_STR_003 . '</b></div>';

define('QCR_INDEX_FILENAME', 'fn');
define('QCR_INDEX_TYPE', 'type');
define('QCR_INDEX_WRITABLE', 'wr');
define('QCR_SVALUE_FILE', '1');
define('QCR_SVALUE_FOLDER', '0');

/**
 * Extract emails from the string
 * @param string $email
 * @return array of strings with emails or false on error
 */
function getEmails($email)
{
	$email = preg_split('#[,\s;]#', $email, -1, PREG_SPLIT_NO_EMPTY);
	$r = array();
	for ($i = 0, $size = sizeof($email); $i < $size; $i++)
	{
	        if (function_exists('filter_var')) {
   		   if (filter_var($email[$i], FILTER_VALIDATE_EMAIL))
   		   {
   		   	$r[] = $email[$i];
    		   }
                } else {
                   // for PHP4
                   if (strpos($email[$i], '@') !== false) {
   		   	$r[] = $email[$i];
                   }
                }
	}
	return empty($r) ? false : $r;
}

/**
 * Get bytes from shorthand byte values (1M, 1G...)
 * @param int|string $val
 * @return int
 */
function getBytes($val)
{
	$val = trim($val);
	$last = strtolower($val{strlen($val) - 1});
	switch($last) {
		case 't':
			$val *= 1024;
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return intval($val);
}

/**
 * Format bytes to human readable
 * @param int $bites
 * @return string
 */
function bytes2Human($bites)
{
	if ($bites < 1024)
	{
		return $bites . ' b';
	}
	elseif (($kb = $bites / 1024) < 1024)
	{
		return number_format($kb, 2) . ' Kb';
	}
	elseif (($mb = $kb / 1024) < 1024)
	{
		return number_format($mb, 2) . ' Mb';
	}
	elseif (($gb = $mb / 1024) < 1024)
	{
		return number_format($gb, 2) . ' Gb';
	}
	else
	{
		return number_format($gb / 1024, 2) . 'Tb';
	}
}

///////////////////////////////////////////////////////////////////////////
function needIgnore($par_FN, $par_CRC) {
  global $g_IgnoreList;
  
  for ($i = 0; $i < count($g_IgnoreList); $i++) {
     if (strpos($par_FN, $g_IgnoreList[$i][0]) !== false) {
		if ($par_CRC == $g_IgnoreList[$i][1]) {
			return true;
		}
	 }
  }
  
  return false;
}

///////////////////////////////////////////////////////////////////////////
function printList($par_List, $par_Details = null, $par_NeedIgnore = false) {
  global $g_Structure;
  
  $l_Result = '';
  $l_Result .= "<div class=\"flist\"><table cellspacing=1 cellpadding=4 border=0>";

  $l_Result .= "<tr class=\"tbgh" . ( $i % 2 ). "\">";
  $l_Result .= "<th>" . AI_STR_004 . "</th>";
  $l_Result .= "<th>" . AI_STR_005 . "</th>";
  $l_Result .= "<th>" . AI_STR_006 . "</th>";
  $l_Result .= "<th width=90>" . AI_STR_007 . "</th>";
  $l_Result .= "<th width=90>CRC32</th>";
  
  $l_Result .= "</tr>";

  for ($i = 0; $i < count($par_List); $i++) {
    $l_Pos = $par_List[$i];
        if ($par_NeedIgnore) {
         	if (needIgnore($g_Structure['n'][$par_List[$i]], $g_Structure['crc'][$l_Pos])) {
         		continue;
         	}
        }
  
     $l_Creat = $g_Structure['c'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['c'][$l_Pos]) : '-';
     $l_Modif = $g_Structure['m'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['m'][$l_Pos]) : '-';
     $l_Size = $g_Structure['s'][$l_Pos] > 0 ? bytes2Human($g_Structure['s'][$l_Pos]) : '-';

     if ($par_Details != null) {
        $l_WithMarket = preg_replace('|@AI_MARKER@|smi', '<span class="marker">|</span>', $par_Details[$i]);
        $l_Body = '<div class="details">' . $l_WithMarket . '</div>';
     } else {
        $l_Body = '';
     }

     $l_Result .= '<tr class="tbg' . ( $i % 2 ). '">';
	 
	 if (is_file($g_Structure['n'][$l_Pos])) {
		$l_Result .= '<td><div class="it"><a  class="it" target="_blank" href="'. $defaults['site_url'] . 'ai-bolit.php?fn=' .
	              $g_Structure['n'][$l_Pos] . '&ph=' . realCRC(PASS) . '&c=' . $g_Structure['crc'][$l_Pos] . '">' . $g_Structure['n'][$l_Pos] . '</a></div>' . $l_Body . '</td>';
	 } else {
		$l_Result .= '<td><div class="it">' . $g_Structure['n'][$par_List[$i]] . '</div></td>';
	 }
	 
     $l_Result .= '<td><div class="ctd">' . $l_Creat . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Modif . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Size . '</div></td>';
     $l_Result .= '<td><div class="ctd"><a href="#" onclick="addToIgnore(this, \'' . $g_Structure['n'][$l_Pos] . '\',\'' . $g_Structure['crc'][$l_Pos] . '\');return false;">' . $g_Structure['crc'][$l_Pos] . '</a></div></td>';
     $l_Result .= '</tr>';

  }

  $l_Result .= "</table></div>";

  return $l_Result;
}

///////////////////////////////////////////////////////////////////////////
function extractValue(&$par_Str, $par_Name) {
  if (preg_match('|<tr><td class="e">\s*'.$par_Name.'\s*</td><td class="v">(.+?)</td>|sm', $par_Str, $l_Result)) {
     return str_replace('no value', '', strip_tags($l_Result[1]));
  }
}

///////////////////////////////////////////////////////////////////////////
function QCR_ExtractInfo($par_Str) {
   $l_PhpInfoSystem = extractValue($par_Str, 'System');
   $l_PhpPHPAPI = extractValue($par_Str, 'Server API');
   $l_AllowUrlFOpen = extractValue($par_Str, 'allow_url_fopen');
   $l_AllowUrlInclude = extractValue($par_Str, 'allow_url_include');
   $l_DisabledFunction = extractValue($par_Str, 'disable_functions');
   $l_DisplayErrors = extractValue($par_Str, 'display_errors');
   $l_ErrorReporting = extractValue($par_Str, 'error_reporting');
   $l_ExposePHP = extractValue($par_Str, 'expose_php');
   $l_LogErrors = extractValue($par_Str, 'log_errors');
   $l_MQGPC = extractValue($par_Str, 'magic_quotes_gpc');
   $l_MQRT = extractValue($par_Str, 'magic_quotes_runtime');
   $l_OpenBaseDir = extractValue($par_Str, 'open_basedir');
   $l_RegisterGlobals = extractValue($par_Str, 'register_globals');
   $l_SafeMode = extractValue($par_Str, 'safe_mode');


   $l_DisabledFunction = ($l_DisabledFunction == '' ? '-?-' : $l_DisabledFunction);
   $l_OpenBaseDir = ($l_OpenBaseDir == '' ? '-?-' : $l_OpenBaseDir);

   $l_Result = '<div class="sec">' . AI_STR_008 . ': ' . phpversion() . '</div>';
   $l_Result .= 'System Version: <span class="php_ok">' . $l_PhpInfoSystem . '</span><br/>';
   $l_Result .= 'PHP API: <span class="php_ok">' . $l_PhpPHPAPI. '</span><br/>';
   $l_Result .= 'allow_url_fopen: <span class="php_' . ($l_AllowUrlFOpen == 'On' ? 'bad' : 'ok') . '">' . $l_AllowUrlFOpen. '</span><br/>';
   $l_Result .= 'allow_url_include: <span class="php_' . ($l_AllowUrlInclude == 'On' ? 'bad' : 'ok') . '">' . $l_AllowUrlInclude. '</span><br/>';
   $l_Result .= 'disable_functions: <span class="php_' . ($l_DisabledFunction == '-?-' ? 'bad' : 'ok') . '">' . $l_DisabledFunction. '</span><br/>';
   $l_Result .= 'display_errors: <span class="php_' . ($l_DisplayErrors == 'On' ? 'ok' : 'bad') . '">' . $l_DisplayErrors. '</span><br/>';
   $l_Result .= 'error_reporting: <span class="php_ok">' . $l_ErrorReporting. '</span><br/>';
   $l_Result .= 'expose_php: <span class="php_' . ($l_ExposePHP == 'On' ? 'bad' : 'ok') . '">' . $l_ExposePHP. '</span><br/>';
   $l_Result .= 'log_errors: <span class="php_' . ($l_LogErrors == 'On' ? 'ok' : 'bad') . '">' . $l_LogErrors . '</span><br/>';
   $l_Result .= 'magic_quotes_gpc: <span class="php_' . ($l_MQGPC == 'On' ? 'ok' : 'bad') . '">' . $l_MQGPC. '</span><br/>';
   $l_Result .= 'magic_quotes_runtime: <span class="php_' . ($l_MQRT == 'On' ? 'bad' : 'ok') . '">' . $l_MQRT. '</span><br/>';
   $l_Result .= 'register_globals: <span class="php_' . ($l_RegisterGlobals == 'On' ? 'bad' : 'ok') . '">' . $l_RegisterGlobals . '</span><br/>';
   $l_Result .= 'open_basedir: <span class="php_' . ($l_OpenBaseDir == '-?-' ? 'bad' : 'ok') . '">' . $l_OpenBaseDir . '</span><br/>';
   
   if (phpversion() < '5.3.0') {
      $l_Result .= 'safe_mode (PHP < 5.3.0): <span class="php_' . ($l_SafeMode == 'On' ? 'ok' : 'bad') . '">' . $l_SafeMode. '</span><br/>';
   }

   return $l_Result . '<p>';
}

///////////////////////////////////////////////////////////////////////////
function QCR_Debug($par_Str) {
  if (!DEBUG_MODE) {
     return;
  }

  $l_MemInfo = ' ';  
  if (function_exists('memory_get_usage')) {
     $l_MemInfo .= ' curmem=' .  bytes2Human(memory_get_usage());
  }

  if (function_exists('memory_get_peak_usage')) {
     $l_MemInfo .= ' maxmem=' .  bytes2Human(memory_get_peak_usage());
  }

  stdOut(date('H:i:s') . ': ' . $par_Str . $l_MemInfo);
}


///////////////////////////////////////////////////////////////////////////
function QCR_ScanDirectories($l_RootDir)
{
	global $g_Structure, $g_Counter, $g_Doorway, $g_FoundTotalFiles, $g_FoundTotalDirs, 
			$defaults, $g_SkippedFolders, $g_UrlIgnoreList, $g_DirIgnoreList, $g_UnsafeFilesArray, $g_UnsafeDirArray, 
                        $g_UnsafeFilesFound, $g_SymLinks, $g_HiddenFiles;

	$l_DirCounter = 0;
	$l_DoorwayFilesCounter = 0;
	$l_SourceDirIndex = $g_Counter - 1;

	QCR_Debug('Scan ' . $l_RootDir);

        $l_QuotedSeparator = quotemeta(DIR_SEPARATOR); 
        $l_NeedCheckCandi = ($defaults['report_mask'] & REPORT_MASK_CANDI) == REPORT_MASK_CANDI;

	if ($l_DIRH = @opendir($l_RootDir))
	{
		while (($l_FileName = readdir($l_DIRH)) !== false)
		{
			if ($l_FileName == '.' || $l_FileName == '..') continue;

                        if (is_link($l_FileName)) 
                        {
                            $g_SymLinks[] = $l_FileName;
                            continue;
                        }

			$l_FileName = $l_RootDir . DIR_SEPARATOR . $l_FileName;

			$l_Ext = substr($l_FileName, strrpos($l_FileName, '.') + 1);

			$l_IsDir = is_dir($l_FileName);

			// which files should be scanned
			$l_NeedToScan = SCAN_ALL_FILES || (in_array($l_Ext, array(
				'js', 'php', 'php3', 'phtml', 'shtml', 'khtml',
				'php4', 'php5', 'tpl', 'inc', 'htaccess', 'html', 'htm'
			)));

			if (strpos(basename($l_FileName), '.') === 0) {
                            $g_HiddenFiles[] = $l_FileName;
                        }

			if ($l_IsDir)
			{
				// if folder in ignore list
				$l_Skip = false;
				for ($dr = 0; $dr < count($g_DirIgnoreList); $dr++) {
					if (($g_DirIgnoreList[$dr] != '') &&
						preg_match('#' . $g_DirIgnoreList[$dr] . '#', $l_FileName, $l_Found)) {
						$l_Skip = true;
					}
				}
			
				// skip on ignore
				if ($l_Skip) {
					$g_SkippedFolders[] = $l_FileName;
					continue;
				}
				
				$g_Structure['d'][$g_Counter] = $l_IsDir;
				$g_Structure['n'][$g_Counter] = $l_FileName;

				$l_DirCounter++;


                                if ($l_NeedCheckCandi) {
         				for ($j = 0; $j < count($g_UnsafeDirArray); $j++) {
         				    if (preg_match('|' . $l_QuotedSeparator . $g_UnsafeDirArray[$j] . '$|i', $l_FileName, $l_Found)) {
                                                $g_UnsafeFilesFound[] = $g_Counter;
                                                break;
                                             }
         				}
     				}

				if ($l_DirCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
				{
					$g_Doorway[] = $l_SourceDirIndex;
					$l_DirCounter = -655360;
				}

				$g_Counter++;
				$g_FoundTotalDirs++;

				QCR_ScanDirectories($l_FileName);

			} else
			{
				if ($l_NeedToScan)
				{
					$g_FoundTotalFiles++;
					if (in_array($l_Ext, array(
						'php', 'php3',
						'php4', 'php5', 'html', 'htm', 'phtml', 'shtml', 'khtml'
					))
					)
					{
						$l_DoorwayFilesCounter++;
						
						if ($l_DoorwayFilesCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
						{
							$g_Doorway[] = $l_SourceDirIndex;
							$l_DoorwayFilesCounter = -655360;
						}
					}


					$l_Stat = stat($l_FileName);

					$g_Structure['d'][$g_Counter] = $l_IsDir;
					$g_Structure['n'][$g_Counter] = $l_FileName;
					$g_Structure['s'][$g_Counter] = $l_Stat['size'];
					$g_Structure['c'][$g_Counter] = $l_Stat['ctime'];
					$g_Structure['m'][$g_Counter] = $l_Stat['mtime'];

                                        if ($l_NeedCheckCandi) {
          					for ($j = 0; $j < count($g_UnsafeFilesArray); $j++) {
         					    if (preg_match('|' . $l_QuotedSeparator . $g_UnsafeFilesArray[$j] . '|i', $l_FileName, $l_Found)) {
                                                        $g_UnsafeFilesFound[] = $g_Counter;
                                                        break;
                                                     }
         					}
         				}

					$g_Counter++;
				}
			}
		}

		closedir($l_DIRH);
	}

	return $g_Structure;
}


///////////////////////////////////////////////////////////////////////////
function QCR_ScanFile($l_TheFile)
{
	global $g_Structure, $g_Counter, $g_Doorway, $g_FoundTotalFiles, $g_FoundTotalDirs, 
			$defaults, $g_SkippedFolders, $g_UrlIgnoreList, $g_DirIgnoreList, $g_UnsafeFilesArray, $g_UnsafeDirArray, 
                        $g_UnsafeFilesFound, $g_SymLinks, $g_HiddenFiles;

	QCR_Debug('Scan file ' . $l_TheFile);

      	$l_Stat = stat($l_TheFile);

      	$g_Structure['d'][$g_Counter] = false;
      	$g_Structure['n'][$g_Counter] = $l_TheFile;
      	$g_Structure['s'][$g_Counter] = $l_Stat['size'];
      	$g_Structure['c'][$g_Counter] = $l_Stat['ctime'];
      	$g_Structure['m'][$g_Counter] = $l_Stat['mtime'];

      	$g_Counter++;

	return $g_Structure;
}



///////////////////////////////////////////////////////////////////////////
function getFragment($par_Content, $par_Pos) {
  $l_MaxChars = MAX_PREVIEW_LEN;
  $l_MaxLen = strlen($par_Content);
  $l_RightPos = min($par_Pos + $l_MaxChars, $l_MaxLen); 
  $l_MinPos = max(0, $par_Pos - $l_MaxChars);

  $l_Res = substr($par_Content, $l_MinPos, $par_Pos - $l_MinPos) . 
           '@AI_MARKER@' . 
           substr($par_Content, $par_Pos, $l_RightPos - $par_Pos - 1);

  return htmlspecialchars($l_Res);
}

///////////////////////////////////////////////////////////////////////////
function escapedHexToHex($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(hexdec($escaped[1])); }
function escapedOctDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(octdec($escaped[1])); }
function escapedDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr($escaped[1]); }

///////////////////////////////////////////////////////////////////////////
if (!defined('T_ML_COMMENT')) {
   define('T_ML_COMMENT', T_COMMENT);
} else {
   define('T_DOC_COMMENT', T_ML_COMMENT);
}

function UnwrapObfu($par_Content) {
  $GLOBALS['g_EncObfu'] = 0;

  $par_Content = preg_replace_callback('/\\\\x([a-fA-F0-9]{2})/i','escapedHexToHex', $par_Content);
  $par_Content = preg_replace_callback('/\\\\([0-9]{3})/i','escapedOctDec', $par_Content);
  $par_Content = preg_replace_callback('/\\\\d([0-9]{1,3})/i','escapedDec', $par_Content);

  $par_Content = preg_replace('/[\'"]\s*?\.\s*?[\'"]/smi', '', $par_Content);

  return $par_Content;
}

///////////////////////////////////////////////////////////////////////////
function QCR_SearchPHP($src)
{
  if (preg_match("/(<\?php[\w\s]{5,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
	  return $l_Found[0][1];
  }

//  if (preg_match("/(<%[\w\s]{10,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
//	  return $l_Found[0][1];
//  }
  if (preg_match("/(<script[^>]*language\s*=\s*)('|\"|)php('|\"|)([^>]*>)/i", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
    return $l_Found[0][1];
  }

  return false;
}


///////////////////////////////////////////////////////////////////////////
function knowUrl($par_URL) {
  global $g_UrlIgnoreList;

  for ($jk = 0; $jk < count($g_UrlIgnoreList); $jk++) {
     if  ((stripos($par_URL, $g_UrlIgnoreList[$jk]) !== false)) {
     	return true;
     }
  }

  return false;
}


///////////////////////////////////////////////////////////////////////////
function QCR_GoScan($par_Offset)
{
	global $g_IframerFragment, $g_Iframer, $g_SuspDir, $g_Redirect, $g_Doorway, $g_EmptyLink, $g_Structure, $g_Counter, 
		   $g_WritableDirectories, $g_CriticalPHP, $g_HeuristicType, $g_HeuristicDetected, $g_TotalFolder, $g_TotalFiles, $g_WarningPHP, $g_AdwareList,
		   $g_CriticalPHP, $g_CriticalJS, $g_UrlIgnoreList, $g_CriticalJSFragment, $g_PHPCodeInside, $g_PHPCodeInsideFragment, 
		   $g_NotRead, $g_WarningPHPFragment, $g_BigFiles, $g_RedirectPHPFragment, $g_EmptyLinkSrc, $g_CriticalPHPFragment, 
           $g_Base64Fragment, $g_UnixExec, $g_IframerFragment, $g_CMS, $defaults, $g_AdwareListFragment, $g_KnownList;

	static $_files_and_ignored = 0;

        QCR_Debug('QCR_GoScan ' . $par_Offset);

	for ($i = $par_Offset; $i < $g_Counter; $i++)
	{
		$l_Filename = $g_Structure['n'][$i];

 	        QCR_Debug('Check ' . $l_Filename);

		if ($g_Structure['d'][$i])
		{
			// FOLDER
			$g_TotalFolder++;

			if (is_writable($l_Filename))
			{
				$g_WritableDirectories[] = $i;
			}
		}
		else
		{

			// FILE
			if (MAX_SIZE_TO_SCAN > 0 AND $g_Structure['s'][$i] > MAX_SIZE_TO_SCAN)
			{
				$g_BigFiles[] = $i;
			}
			else
			{
				$g_TotalFiles++;

                $l_Content = @implode('', file($l_Filename));
                if (($l_Content == '') && ($g_Structure['s'][$i] > 0)) {
                   $g_NotRead[] = $i;
                }

				$g_Structure['crc'][$i] = realCRC($l_Content);

                                // detect version CMS
				if (strpos($l_Filename, DIR_SEPARATOR . 'engine' . DIR_SEPARATOR . 'data' . DIR_SEPARATOR . 'config.php') !== false) {
				   if (preg_match('|\'version_id\'\s*=>\s*"(.+?)"|smi', $l_Content, $l_Ver)) {
					$g_CMS[] = 'DLE v' . $l_Ver[1];
				   }
                                } else
				if (strpos($l_Filename, DIR_SEPARATOR . 'wp-includes' . DIR_SEPARATOR . 'version.php') !== false) {
				   if (preg_match('|\$wp_version\s*=\s*\'(.+?)\'|smi', $l_Content, $l_Ver)) {
					$g_CMS[] = 'Wordpress v' . $l_Ver[1];
				   }
                                } else
				if (strpos($l_Filename, 'install' . DIR_SEPARATOR . 'consts.php') !== false) {
				   if (preg_match('|STRING_VERSION\',\s*\'(.+?)\'|smi', $l_Content, $l_Ver)) {
					$g_CMS[] = 'ShopScript Premium v' . $l_Ver[1];
				   }
                                } else
				if (strpos($l_Filename, 'bitrix' . DIR_SEPARATOR . 'modules' . DIR_SEPARATOR . 'main' . DIR_SEPARATOR . 'classes' . DIR_SEPARATOR . 'general' . DIR_SEPARATOR . 'version.php') !== false) {
				   if (preg_match('|define\("SM_VERSION","(.+?)"\)|smi', $l_Content, $l_Ver)) {
					$g_CMS[] = 'Bitrix v' . $l_Ver[1];
				   }
                                }

                                $l_KnownCRC = $g_Structure['crc'][$i] + realCRC(basename($l_Filename));
                                if (in_array($l_KnownCRC, $g_KnownList)) {
	        		   printProgress(++$_files_and_ignored, $l_Filename);
                                   continue;
                                }

				$l_Unwrapped = UnwrapObfu($l_Content);

				// ignore itself
				if (strpos($l_Content, 'KVFFGHJHGFJHGFJHGFDGHGGFD') !== false) {
					continue;
				}

				// warnings
				$l_Pos = '';
				if (WarningPHP($l_Filename, $l_Unwrapped, $l_Pos))
				{       $l_Prio = 1;
				        if (strpos($l_Filename, '.php') !== false) {
				       	   $l_Prio = 0;
					}

					$g_WarningPHP[$l_Prio][] = $i;
					$g_WarningPHPFragment[$l_Prio][] = getFragment($l_Content, $l_Pos);
				}

				// adware
				if (Adware($l_Filename, $l_Unwrapped, $l_Pos))
				{
					$g_AdwareList[] = $i;
					$g_AdwareListFragment[] = getFragment($l_Content, $l_Pos);
				}

				// critical
				$g_SkipNextCheck = false;
				if (CriticalPHP($l_Filename, $i, $l_Unwrapped, $l_Pos))
				{
					$g_CriticalPHP[] = $i;
					$g_CriticalPHPFragment[] = getFragment($l_Content, $l_Pos);
					$g_SkipNextCheck = true;
				}
				
				// critical without comments
				$a = preg_replace('|/\*.*?\*/|smiu', '', $l_Unwrapped);
				
				if ((!$g_SkipNextCheck) && CriticalPHP($l_Filename, $i, $a, $l_Pos))
				{
					$g_CriticalPHP[] = $i;
					$g_CriticalPHPFragment[] = getFragment($l_Content, $l_Pos);
				}			

				$l_TypeDe = 0;
			    if (ai_check_extra_obfus($l_Content, $l_TypeDe)) {
					$g_HeuristicDetected[] = $i;
					$g_HeuristicType[] = $l_TypeDe;
				}

				// critical JS
				$l_Pos = CriticalJS($l_Filename, $i, $l_Content);
				if ($l_Pos !== false)
				{
					$g_CriticalJS[] = $i;
					$g_CriticalJSFragment[] = getFragment($l_Content, $l_Pos);
				}

				if
				(stripos($l_Filename, 'index.php') ||
					stripos($l_Filename, 'index.htm') ||
					SCAN_ALL_FILES
				)
				{
					// check iframes
					if (preg_match_all('|<iframe.+?src.+?>|smi', $l_Unwrapped, $l_Found, PREG_SET_ORDER)) 
					{
						for ($kk = 0; $kk < count($l_Found); $kk++) {
						        $l_Pos = stripos($l_Found[$kk][0], 'http://');
							if  (($l_Pos !== false) && (!knowUrl($l_Found[$kk][0]))) {
         							$g_Iframer[] = $i;
         							$g_IframerFragment[] = getFragment($l_Found[$kk][0], $l_Pos);
							}
						}
					}

					// check empty links
					if (preg_match_all('|<a[^>]+href([^>]+?)>(.*?)</a>|smi', $l_Unwrapped, $l_Found, PREG_SET_ORDER))
					{
						for ($kk = 0; $kk < count($l_Found); $kk++) {
							if  ((stripos($l_Found[$kk][1], 'http://') !== false) &&
                                                            (trim(strip_tags($l_Found[$kk][2])) == '')) {

								$l_NeedToAdd = true;

							    if  ((stripos($l_Found[$kk][1], $default['site_url']) !== false)
                                                                 || knowUrl($l_Found[$kk][1])) {
										$l_NeedToAdd = false;
								}
								
								if ($l_NeedToAdd && (count($g_EmptyLink) < MAX_EXT_LINKS)) {
									$g_EmptyLink[] = $i;
									$g_EmptyLinkSrc[$i][] = substr($l_Found[$kk][0], 0, MAX_PREVIEW_LEN);
								}
							}
						}
					}
				}

				// check for PHP code inside any type of file
				if ((stripos($l_Filename, '.php') === false) && 
				    (stripos($l_Filename, '.phtml') === false))
				{
					$l_Pos = QCR_SearchPHP($l_Content);
					if ($l_Pos !== false)
					{
						$g_PHPCodeInside[] = $i;
						$g_PHPCodeInsideFragment[] = getFragment($l_Unwrapped, $l_Pos);
					}
				}

				// articles
				if (stripos($l_Filename, 'article_index'))
				{
					$g_AdwareSig[] = $i;
				}

				// unix executables
				if (strpos($l_Content, chr(127) . 'ELF') !== false) 
				{
                    $g_UnixExec[] = $i;
                }
				
				// htaccess
				if (stripos($l_Filename, '.htaccess'))
				{
				
				if (stripos($l_Content, 'index.php?name=$1') !== false ||
						stripos($l_Content, 'index.php?m=1') !== false
					)
					{
						$g_SuspDir[] = $i;
					}

					$l_Pos = stripos($l_Content, '^(%2d|-)[^=]+$');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					$l_Pos = stripos($l_Content, '%{HTTP_USER_AGENT}');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}


					if (
						preg_match_all('|(RewriteCond\s+%\{HTTP_HOST\}/%1 \!\^\[w\.\]\*\(\[\^/\]\+\)/\\\1\$\s+\[NC\])|smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)
					   )
					{
						$g_Redirect[] = $i;
                        			$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Found[0][1]);
					}
//

					$l_HTAContent = preg_replace('|^\s*#.+$|m', '', $l_Content);

					if (
						preg_match_all("|RewriteRule\s+.+?\s+http://(.+?)/.+\s+\[.*R=\d+.*\]|smi", $l_HTAContent, $l_Found, PREG_SET_ORDER)
					)
					{
						$l_Host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
						for ($j = 0; $j < sizeof($l_Found); $j++)
						{
							$l_Found[$j][1] = str_replace('www.', '', $l_Found[$j][1]);
							if ($l_Found[$j][1] != $l_Host)
							{
								$g_Redirect[] = $i;
								break;
							}
						}
					}

					unset($l_HTAContent);
					
					$l_Pos = stripos($l_Content, 'auto_prepend_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}
					$l_Pos = stripos($l_Content, 'auto_append_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					if (preg_match("|RewriteRule\s+\^\(\.\*\)\$\s+-\s+\[\s*F\s*,\s*L\s*\]|smi", $l_Content, $l_Found)) {
						$g_Redirect[] = $i;
					}
				}
			}
			
			unset($l_Unwrapped);
			unset($l_Content);
			
			printProgress(++$_files_and_ignored, $l_Filename);
		} // end of if (file)

		usleep(SCAN_DELAY * 1000);

	} // end of for

}

///////////////////////////////////////////////////////////////////////////
function WarningPHP($l_FN, $l_Content, &$l_Pos)
{
  global $g_SusDB;

  $l_Res = false;

//print "WarningPHP Start:\n";
//print "###########################################################################\n";

  foreach ($g_SusDB as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
//print  "\nSusDB $l_FN =" . $l_Item." l_Pos=" . $l_Pos . "\n";
           return true;
       }
    }
  }

//print "###########################################################################\n";
//print "WarningPHP End:\n";

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function Adware($l_FN, $l_Content, &$l_Pos)
{
  global $g_AdwareSig;

  $l_Res = false;

//print "Adware Start:\n";
//print "###########################################################################\n";

  foreach ($g_AdwareSig as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
//print  "\ng_AdwareSig $l_FN =" . $l_Item." l_Pos=" . $l_Pos . "\n";
           return true;
       }
    }
  }


//print "Adware End:\n";
//print "###########################################################################\n";

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function CheckException(&$l_Content, &$l_Found) {
  global $g_ExceptFlex, $g_FlexDBShe, $g_DBShe, $g_Base64, $g_Base64Fragment;

//print "\nCheckException Start -----------------------------:\n";

   $l_FoundStrPlus = substr($l_Content, max($l_Found[0][1] - 10, 0), 70);

   foreach ($g_ExceptFlex as $l_ExceptItem) {

//print "\n{{{" . $l_FoundStrPlus . "}}} vs {{{" . $l_ExceptItem . "}}}\n";
//print "--------------------------------------------\n";

      if (preg_match('#(' . $l_ExceptItem . ')#smi', $l_FoundStrPlus, $l_Detected)) {


//		print "Matched {{{" . $l_ExceptItem . "}}} in {{{" . $l_FN. "}}}\n\n";
//		print "==========> {{{" . $l_Found[0][0]. "}}}\r\n";
//		print "\n" . "CheckException: ****** EXCEPTION *************" . "\n";

         $l_Exception = true;
         return true;
      }
   }

//print "\nCheckException End -----------------------------:\n";
   return false;
}

///////////////////////////////////////////////////////////////////////////
function CriticalJS($l_FN, $l_Index, $l_Content)
{
  global $g_JSVirSig;

  $l_Res = false;

//print "CriticalJS Start:\n";
//print "###########################################################################\n";

  foreach ($g_JSVirSig as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
//print "CriticalJS " . $l_FN . ' ' . $l_Item . ' l_Pos=' . $l_Pos . "\n";
           return $l_Pos;
       }
    }
  }

//print "###########################################################################\n";
//print "CriticalJS End:\n";

  return $l_Res;
}


///////////////////////////////////////////////////////////////////////////
  function get_descr_heur($type) {
     $msg = '';
     switch ($type) {
	    case 1: $msg = AI_STR_053;
		        break;
	    case 2: $msg = AI_STR_054;
		        break;
	    case 3: $msg = AI_STR_055;
		        break;
	    case 4: $msg = AI_STR_056;
		        break;
	 }
	 
	 return $msg;
  }

  function ai_check_extra_obfus($content, &$type) {
     $res = false;

     // 1
     if (preg_match_all('|(\$[a-zA-Z0-9_]{3,}\[[\d+]\]\s*\(\s*\$)|smiu', $content, $found, PREG_SET_ORDER)) {
        $ref_calls = count($found);
     }

     // 2
     if (preg_match_all('|\$([a-zA-Z0-9_]{3,}?)\s*[;\=\(]|smi', $content, $found, PREG_SET_ORDER)) {
       $obf_var1 = 0;
       $obf_var2 = 0;

       $arr = array();
       foreach ($found as $item) {
         $arr[$item[1]] = 1;
       }                          


       $found = array_keys($arr);

       foreach ($found as $item) {
          if (preg_match('|([a-zA-Z]{2,}[0-9]+[a-zA-Z]+){1,}|', $item, $found_ob)) {
             $obf_var1++;
          }

          if (!preg_match('|([aeiouy_])|i', $item, $found_ob) && (strlen($item) > 4)) {
             $obf_var2++;
          }

          if (preg_match('|([0-9bcdfghjklmnpqrstvwxz]{6,})|i', $item, $found_ob) && (strlen($item) > 3)) {
             $obf_var3++;
          }
       }
     }

     // 3
     if (preg_match_all('|(\$GLOBALS\[\'[a-z_0-9]+\'\]\[\d+\]\()|smiu', $content, $found, PREG_SET_ORDER)) {
        $ref_glob = count($found);
     }

     // 4
//     if (preg_match_all('|(["\'].+?["\']\s*\.\s*){10,}|smiu', $content, $found, PREG_SET_ORDER)) {
//	    $type = 4;
//		return true;
//     }
	 
	 /////////////////////////////////////
	 if ($ref_calls > 10) {
	    $type = 1;
		return true;
	 }

	 if ($ref_glob > 10) {
	    $type = 2;
		return true;
	 }
	 
	 if ($obf_var1 + $obf_var2 + $obf_var3 >= 3) {
	    $type = 3;
		return true;
	 }

 
	 return false;
  }

///////////////////////////////////////////////////////////////////////////
function CriticalPHP($l_FN, $l_Index, $l_Content, &$l_Pos)
{
  global $g_ExceptFlex, $g_FlexDBShe, $g_DBShe, $g_Base64, $g_Base64Fragment;

//print "###########################################################################\n";
//print "CriticalPHP Start:" . $l_FN . " index: " . $l_Index . "\n";
//print "###########################################################################\n";


  // KVFFGHJHGFJHGFJHGFDGHGGFD

#var_dump($g_ExceptFlex);

  foreach ($g_FlexDBShe as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
//print "\nSIGNATURE: " . $l_Item . ''."\n";
//print "\nIN: {{{" . $l_Found[0][0]. "}}}\n";
       if (!CheckException($l_Content, $l_Found)) {
//print "\n****** VIR *************\n";
           $l_Pos = $l_Found[0][1];
           return true;
       }
    }
  }

  foreach ($g_DBShe as $l_Item) {
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
       return true;
    }
  }


//print "###########################################################################\n";
//print "CriticalPHP End:" . $l_FN . " index: " . $l_Index . "\n";
//print "###########################################################################\n";


  if ((strpos($l_Content, 'GIF89') === 0) && (strpos($l_FN, '.php') !== false )) {
     $l_Pos = 0;
	 return true;
  }

  if (strpos($l_FN, '.php.') !== false ) {
     $l_Pos = 0;
	 return true;
  }

  if (preg_match('#((include|require|require_once|include_once)\s*\(*\s*[\"\']http://.+?[\"\'])#smi', $l_Content, $l_Found)) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = substr($l_Found[1], 0, MAX_PREVIEW_LEN);
  }

  // detect base64 suspicious
  if (preg_match('|([A-Za-z0-9+/]{' . BASE64_LENGTH . ',})|smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
     if (preg_match('#(eval|sort|array_map|create_function|base64_decode|gzip_decode|gzip_inflate|preg_replace_callback)\s*\(#smi', 
                 $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
        if ((!CheckException($l_Content, $l_Found)) && (!in_array($l_Index, $g_Base64))) {
 	  $g_Base64[] = $l_Index;
 	   $g_Base64Fragment[] = getFragment($l_Content, $l_Found[1][1]);
        }
     }
  }

  if (preg_match('|eval\s*\(.+?\(.+?\(\s*implode|smi', $l_Content, $l_Found)) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, $l_Pos);
  }

  // count number of base64_decode entries
  $l_Count = substr_count($l_Content, 'base64_decode');
  if ($l_Count > 10) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, stripos($l_Content, 'base64_decode'));
  }

  return false;
}

///////////////////////////////////////////////////////////////////////////
if (!isCli()) {
   header('Content-type: text/html; charset=utf-8');
}

if (!isCli()) {

  $l_PassOK = false;
  if (strlen(PASS) > 8) {
     $l_PassOK = true;   
  } 

  if ($l_PassOK && preg_match('|[0-9]|', PASS, $l_Found) && preg_match('|[A-Z]|', PASS, $l_Found) && preg_match('|[a-z]|', PASS, $l_Found) ) {
     $l_PassOK = true;   
  }
  
  if (!$l_PassOK) {  
    echo sprintf(AI_STR_009, generatePassword());
    exit;
  }

  if (isset($_GET['fn']) && ($_GET['ph'] == crc32(PASS))) {
     printFile();
     exit;
  }

  if ($_GET['p'] != PASS) {
    echo sprintf(AI_STR_010, generatePassword());
    exit;
  }
}

if (!is_readable(ROOT_PATH)) {
  echo AI_STR_011;
  exit;
}

if (isCli()) {
	if (defined('REPORT_PATH') AND REPORT_PATH)
	{
		if (!is_writable(REPORT_PATH))
		{
			die("\nCannot write report. Report dir " . REPORT_PATH . " is not writable.");
		}

		else if (!REPORT_FILE)
		{
			die("\nCannot write report. Report filename is empty.");
		}

		else if (($file = REPORT_PATH . DIR_SEPARATOR . REPORT_FILE) AND is_file($file) AND !is_writable($file))
		{
			die("\nCannot write report. Report file '$file' exists but is not writable.");
		}
	}
}


$g_IgnoreList = array();
$g_DirIgnoreList = array();
$g_UrlIgnoreList = array();
$g_KnownList = array();

$l_IgnoreFilename = '.aignore';
$l_DirIgnoreFilename = '.adirignore';
$l_UrlIgnoreFilename = '.aurlignore';
$l_KnownFilename = '.aknown';

if (file_exists($l_IgnoreFilename)) {
    $l_IgnoreListRaw = file($l_IgnoreFilename);
    for ($i = 0; $i < count($l_IgnoreListRaw); $i++) 
    {
    	$g_IgnoreList[] = explode("\t", trim($l_IgnoreListRaw[$i]));
    }
    unset($l_IgnoreListRaw);
}

if (file_exists($l_DirIgnoreFilename)) {
    $g_DirIgnoreList = file($l_DirIgnoreFilename);
	
	for ($i = 0; $i < count($g_DirIgnoreList); $i++) {
		$g_DirIgnoreList[$i] = trim($g_DirIgnoreList[$i]);
	}
}

if (file_exists($l_UrlIgnoreFilename)) {
    $g_UrlIgnoreList = file($l_UrlIgnoreFilename);
	
	for ($i = 0; $i < count($g_UrlIgnoreList); $i++) {
		$g_UrlIgnoreList[$i] = trim($g_UrlIgnoreList[$i]);
	}
}


if ($l_DIRH = @opendir('.'))
{
	while (($l_FileName = readdir($l_DIRH)) !== false)
	{
		if ($l_FileName == '.' || $l_FileName == '..') continue;
		   if (strpos($l_FileName, $l_KnownFilename) !== false) {
                       $g_KnownListTmp = file($l_FileName);
                     	for ($i = 0; $i < count($g_KnownListTmp); $i++) {
                     		$g_KnownListTmp[$i] = trim($g_KnownListTmp[$i]);
                     	}

                        $g_KnownList = array_merge($g_KnownListTmp, $g_KnownList);
                   }
	}
}

closedir($l_DIRH);

stdOut("Loaded " . count($g_KnownList) . ' known files');

QCR_Debug();

// scan single file
if (defined('SCAN_FILE')) {
   if (file_exists(SCAN_FILE) && is_file(SCAN_FILE) && is_readable(SCAN_FILE)) {
       stdOut("Start scanning file '" . SCAN_FILE . "'.");
       QCR_ScanFile(SCAN_FILE); 
   } else { 
       stdOut("Error:" . SCAN_FILE . " either is not a file or readable");
   }
} else {
   // scan list of files from file
   if (file_exists(DOUBLECHECK_FILE)) {
      stdOut("Start scanning the list from '" . DOUBLECHECK_FILE . "'.");
      $l_List = file(DOUBLECHECK_FILE);
      for ($i = 1; $i < count($l_List); $i++) {
          QCR_ScanFile(trim($l_List[$i])); 
      }
   } else {
      // scan whole file system
      stdOut("Start scanning '" . ROOT_PATH . "'.");
      QCR_ScanDirectories(ROOT_PATH);
   }
}

$g_FoundTotalFiles = count($g_Structure['n']);

QCR_Debug();

stdOut("Founded $g_FoundTotalFiles files in $g_FoundTotalDirs directories.");
stdOut(str_repeat(' ', 160),false);

$g_FoundTotalFiles = count($g_Structure['n']);
QCR_GoScan(0);

QCR_Debug();

////////////////////////////////////////////////////////////////////////////
 if ($BOOL_RESULT) {
  if ((count($g_CriticalPHP) > 0) OR (count($g_CriticalJS) > 0) OR (count($g_Base64) > 0) OR (count($g_SuspDir) > 0) OR  (count($g_Iframer) > 0) OR  (count($g_UnixExec) > 0))
  {
  echo "1\n";
  exit(0);
  }
 }
////////////////////////////////////////////////////////////////////////////

$l_Result .= "<div class=\"sec\"><b>" . AI_STR_051 . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : realpath('.')) . "</b></div>";

$time_tacked = seconds2Human(microtime(true) - START_TIME);

$l_Result .= sprintf(AI_STR_012, count($g_DBShe) + count($g_FlexDBShe), (count($g_SusDB) + count($g_AdwareSig ) + count($g_JSVirSig)), $time_tacked, date('d-m-Y в H:i:s', floor(START_TIME)) , date('d-m-Y в H:i:s'));

$l_Result .= sprintf(AI_STR_013, $g_TotalFolder, $g_TotalFiles);

if (!$defaults['scan_all_files']) {
	$l_Result .= AI_STR_014;
}

$l_Result .= AI_STR_015;

$l_ShowOffer = false;

stdOut("\nBuilding report\n");


////////////////////////////////////////////////////////////////////////////
// save 
if ((count($g_CriticalPHP) > 0) OR (count($g_CriticalJS) > 0) OR (count($g_Base64) > 0) OR (count($g_SuspDir) > 0) OR 
   (count($g_Iframer) > 0) OR  (count($g_UnixExec))) 
{

  if (!file_exists(DOUBLECHECK_FILE)) {
      if ($l_FH = fopen(DOUBLECHECK_FILE, 'w')) {
         fputs($l_FH, '<?php die("Forbidden"); ?>' . "\n");

         $l_CurrPath = dirname(__FILE__);

         for ($i = 0; $i < count($g_CriticalPHP); $i++) {
             fputs($l_FH, str_replace($l_CurrPath, '.', $g_Structure['n'][$g_CriticalPHP[$i]]) . "\n");
             //unlink(str_replace($l_CurrPath, '.', $g_Structure['n'][$g_CriticalPHP[$i]]));  
         }

         for ($i = 0; $i < count($g_Base64); $i++) {
             fputs($l_FH, str_replace($l_CurrPath, '.', $g_Structure['n'][$g_Base64[$i]]) . "\n");
             //unlink(str_replace($l_CurrPath, '.', $g_Structure['n'][$g_Base64[$i]]));
         }

         for ($i = 0; $i < count($g_CriticalJS); $i++) {
             fputs($l_FH, str_replace($l_CurrPath, '.', $g_Structure['n'][$g_CriticalJS[$i]]) . "\n");
             //unlink(str_replace($l_CurrPath, '.', $g_Structure['n'][$g_CriticalJS[$i]]));
         }

         for ($i = 0; $i < count($g_SuspDir); $i++) {
             fputs($l_FH, str_replace($l_CurrPath, '.', $g_Structure['n'][$g_SuspDir[$i]]) . "\n");
             //unlink(str_replace($l_CurrPath, '.', $g_Structure['n'][$g_SuspDir[$i]]));
         }

         for ($i = 0; $i < count($g_Iframer); $i++) {
             fputs($l_FH, str_replace($l_CurrPath, '.', $g_Structure['n'][$g_Iframer[$i]]) . "\n");
             //unlink(str_replace($l_CurrPath, '.', $g_Structure['n'][$g_Iframer[$i]]));
         }

         for ($i = 0; $i < count($g_UnixExec); $i++) {
             fputs($l_FH, str_replace($l_CurrPath, '.', $g_Structure['n'][$g_UnixExec[$i]]) . "\n");
             //unlink(str_replace($l_CurrPath, '.', $g_Structure['n'][$g_UnixExec[$i]]));
         }

         fclose($l_FH);
      } else {
         stdOut("Error! Cannot create " . DOUBLECHECK_FILE);
      }
  } else {
      stdOut(DOUBLECHECK_FILE . ' already exists.');
      $l_Result .= '<div class="err">' . DOUBLECHECK_FILE . ' already exists.</div>';
  }
 
}

////////////////////////////////////////////////////////////////////////////

stdOut("Building list of shells " . count($g_CriticalPHP));

if (count($g_CriticalPHP) > 0) {
  $l_Result .= '<div class="vir"><b>' . AI_STR_016 . '</b>';
  $l_Result .= printList($g_CriticalPHP, $g_CriticalPHPFragment, true);
  $l_Result .= '</div>';

  $l_ShowOffer = true;
} else {
  $l_Result .= '<div class="ok"><b>' . AI_STR_017. '</b></div>';
}

stdOut("Building list of js " . count($g_CriticalJS));

if (count($g_CriticalJS) > 0) {
  $l_Result .= '<div class="vir"><b>' . AI_STR_018 . '</b>';
  $l_Result .= printList($g_CriticalJS, $g_CriticalJSFragment, true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of unix executables " . count($g_UnixExec));

if (count($g_UnixExec) > 0) {
  $l_Result .= "<div class=\"vir\"><b>". AI_STR_019 ."</b>";
  $l_Result .= printList($g_UnixExec, '', true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of base64s " . count($g_Base64));

if (count($g_Base64) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>" . AI_STR_020 ."</b>";
  $l_Result .= printList($g_Base64, $g_Base64Fragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of iframes " . count($g_Iframer));

if (count($g_Iframer) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>" . AI_STR_021 . "</b>";
  $l_Result .= printList($g_Iframer, $g_IframerFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of heuristics " . count($g_HeuristicDetected));

if (count($g_HeuristicDetected) > 0) {
  $l_Result .= '<div class="warn"><b>' . AI_STR_052 . '</b><ul>';
  for ($i = 0; $i < count($g_HeuristicDetected); $i++) {
	   $l_Result .= '<li>' . $g_Structure['n'][$g_HeuristicDetected[$i]] . ' (' . get_descr_heur($g_HeuristicType[$i]) . ')</li>';
  }
  
  $l_Result .= '</ul></div>';

  $l_ShowOffer = true;
}

stdOut("Building list of symlinks " . count($g_SymLinks));

if (count($g_SymLinks) > 0) {

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_022 . "</b><br>";
  $l_Result .= implode("<br>", $g_SymLinks);
  $l_Result .= "</div>";

}

stdOut("Building list of hidden files " . count($g_HiddenFiles));

if (count($g_HiddenFiles) > 0) {

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_023 . "</b><br>";
  $l_Result .= implode("<br>", $g_HiddenFiles);
  $l_Result .= "</div>";

}


stdOut("Building list of susp dirs " . count($g_SuspDir));

if (count($g_SuspDir) > 0) {

  $l_Result .= "<div class=\"vir\"><b>" . AI_STR_024 . "</b><br>";
  $l_Result .= printList($g_SuspDir);
  $l_Result .= "</div>";

} else {

  $l_Result .= '<div class="ok"><b>' . AI_STR_025 . '</b></div>';

}
 

stdOut("Building list of redirects " . count($g_Redirect));

$l_Result .= "<div class=\"sec\">" . AI_STR_026 . "</div>";

if (count($g_Redirect) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_027 . "</b>";
  $l_Result .= printList($g_Redirect, $g_RedirectPHPFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of php inj " . count($g_PHPCodeInside));

if ((count($g_PHPCodeInside) > 0) && (($defaults['report_mask'] & REPORT_MASK_PHPSIGN) == REPORT_MASK_PHPSIGN)) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_028 . "</b>";
  $l_Result .= printList($g_PHPCodeInside, $g_PHPCodeInsideFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of adware " . count($g_AdwareList));

if (count($g_AdwareList) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_029 . "</b>";
  $l_Result .= printList($g_AdwareList, $g_AdwareListFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of unread files " . count($g_NotRead));

if (count($g_NotRead) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_030 . ":</b>";
  $l_Result .= printList($g_NotRead);
  $l_Result .= "</div>";

}
stdOut("Building list of empty links " . count($g_EmptyLink));
if ((count($g_EmptyLink) > 0) && (($defaults['report_mask'] & REPORT_MASK_SPAMLINKS) == REPORT_MASK_SPAMLINKS)) {
  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_031 . "</b>";
  $l_Result .= printList($g_EmptyLink, '', true);

  $l_Result .= AI_STR_032 . '<br/>';
  
  if (count($g_EmptyLink) == MAX_EXT_LINKS) {
      $l_Result .= '(' . AI_STR_033 . MAX_EXT_LINKS . ')<br/>';
    }
   
  for ($i = 0; $i < count($g_EmptyLink); $i++) {
	$l_Idx = $g_EmptyLink[$i];
    for ($j = 0; $j < count($g_EmptyLinkSrc[$l_Idx]); $j++) {
      $l_Result .= '<span class="details">' . $g_Structure['n'][$g_EmptyLink[$i]] . ' &rarr; ' . htmlspecialchars($g_EmptyLinkSrc[$l_Idx][$j]) . '</span><br/>';
	}
  }

  $l_Result .= "</div>";

}

stdOut("Building list of doorways " . count($g_Doorway));

if ((count($g_Doorway) > 0) && (($defaults['report_mask'] & REPORT_MASK_DOORWAYS) == REPORT_MASK_DOORWAYS)) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_034 . "</b>";
  $l_Result .= printList($g_Doorway);
  $l_Result .= "</div>";

}

stdOut("Building list of php warnings " . (count($g_WarningPHP[0]) + count($g_WarningPHP[1])));

if (($defaults['report_mask'] & REPORT_MASK_SUSP) == REPORT_MASK_SUSP) {
   if ((count($g_WarningPHP[0]) + count($g_WarningPHP[1])) > 0) {
     $l_ShowOffer = true;

     $l_Result .= "<div class=\"warn\"><b>" . AI_STR_035 . "</b>";

     for ($i = 0; $i < count($g_WarningPHP); $i++) {
         if (count($g_WarningPHP[$i]) > 0) $l_Result .= printList($g_WarningPHP[$i], $g_WarningPHPFragment[$i], true);
     }
     $l_Result .= "</div>";

   } 
}

stdOut("Building list of skipped dirs " . count($g_SkippedFolders));
if (count($g_SkippedFolders) > 0) {
     $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_036 . "</b><br/>";
     $l_Result .= implode("<br>", $g_SkippedFolders);
     $l_Result .= "</div>";
 }

 stdOut("Building list of writeable dirs " . count($g_WritableDirectories));

if (count($g_CMS) > 0) {
     $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_037 . "</b><br/>";
     $l_Result .= implode("<br>", $g_CMS);
     $l_Result .= "</div>";
}

if (!isCli()) {
   $l_Result .= QCR_ExtractInfo($l_PhpInfoBody[1]);
}

$max_size_to_scan = getBytes(MAX_SIZE_TO_SCAN);
$max_size_to_scan = $max_size_to_scan > 0 ? $max_size_to_scan : getBytes('1m');

stdOut("Building list of bigfiles " . count($g_BigFiles));

if (count($g_BigFiles) > 0) {

  $l_Result .= "<div class=\"warn2\"><b>" . sprintf(AI_STR_038, bytes2Human($max_size_to_scan)) . "</b>";
  $l_Result .= printList($g_BigFiles);
  $l_Result .= "</div>";

} else {
  if (SCAN_ALL_FILES) {
	$l_Result .= '<div class="ok"><b>' . sprintf(AI_STR_039, bytes2Human($max_size_to_scan)) . '</b></div>';
  }
}

stdOut("Building list of sensitive files " . count($g_UnsafeFilesFound) . "\n");

if ((count($g_UnsafeFilesFound) > 0) && (($defaults['report_mask'] & REPORT_MASK_CANDI) == REPORT_MASK_CANDI)) {
  $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_040 . "</b>";
  $l_Result .= printList($g_UnsafeFilesFound);
  $l_Result .= "</div>";
}

if (!$defaults['no_rw_dir']) {
   if ((($defaults['report_mask'] & REPORT_MASK_WRIT) == REPORT_MASK_WRIT)) {
      if ((count($g_WritableDirectories) > 0)) {

        $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_041 . "</b>";
        $l_Result .= printList($g_WritableDirectories);
        $l_Result .= "</div>";

      } else {

        $l_Result .= '<div class="ok"><b>' . AI_STR_042 . '</b></div>';

      }
   }
}

if (function_exists('memory_get_peak_usage')) {
  $l_Result .= AI_STR_043 . bytes2Human(memory_get_peak_usage()) . '<p>';
}

$l_Result .= AI_STR_044;

if (!SCAN_ALL_FILES) {
  $l_Result .= AI_STR_045;
}

$l_Result .= '<div class="footer"><div class="disclaimer"><span class="vir">[!]</span> ' . AI_STR_049 . '</div>';
$l_Result .= '<div class="thanx">' . AI_STR_050 . '</div>';
$l_Result .= '</div>';

$l_OfferVK = AI_STR_048;
              
if ($l_ShowOffer) {
  $l_Result .= AI_STR_047 .
        '<p><a href="#" onclick="document.getElementById(\'ofr\').style.display=\'none\'" style="color: #303030">' . AI_STR_046 . '</a></p>' .
        '</div>';
} else {
  $l_Result .= '<div class="offer2" id="ofr2">' . $l_OfferVK .
        '<p><a href="#" onclick="document.getElementById(\'ofr2\').style.display=\'none\'" style="color: #303030">' . AI_STR_046 .'</a></p>' .
        '</div>';
}
////////////////////////////////////////////////////////////////////////////
if (!isCli())
{
	echo $l_Result;
	exit;
}

if (!defined('REPORT') OR REPORT === '')
{
	die('Report not written.');
}
 
$emails = getEmails(REPORT);

if (!$emails) {
	if ($l_FH = fopen($file, "w")) {
	   fputs($l_FH, $l_Result);
	   fclose($l_FH);
	   stdOut("\nReport written to '$file'.");
	} else {
		stdOut("\nCannot create '$file'.");
	}
}	else	{
		$headers = array(
			'MIME-Version: 1.0',
			'Content-type: text/html; charset=UTF-8',
			'From: ' . ($defaults['email_from'] ? $defaults['email_from'] : 'AI-Bolit@myhost')
		);

		for ($i = 0, $size = sizeof($emails); $i < $size; $i++)
		{
			mail($emails[$i], 'AI-Bolit Report ' . date("d/m/Y H:i", time()), $l_Result, implode("\r\n", $headers));
		}

		stdOut("\nReport sended to " . implode(', ', $emails));
}


$time_taken = microtime(true) - START_TIME;
$time_taken = number_format($time_taken, 5);

stdOut("Scanning complete! Time taken: " . seconds2Human($time_taken));

stdOut("\n\n!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
stdOut("Attention! DO NOT LEAVE either ai-bolit.php or AI-BOLIT-REPORT-<xxxx>-<yy>.html \nfile on server. COPY it locally then REMOVE from server. ");
stdOut("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");

QCR_Debug();

?>
