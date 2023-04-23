<?php
 
/**
 * Database bağlantısı
 * 
 */
 
define('DB_TYPE', 'mysql');
// default olarak mariadb xampp ile beraber kurulduğunda 3306 portundan dinler
// Port numarası my.ini dosyasından düzenlenebilir
define('DB_HOST', 'localhost');
//define('DB_HOST', 'localhost:3309');
define('DB_NAME', 'ogrencidb');
// define('DB_NAME', 'veritabaniadi');
define('DB_USER', 'ogrenci'); 
// define('DB_USER', 'kullanici adi'); 
define('DB_PASS', 'fO6843');
//define('DB_PASS', 'kullanici şifresi');
