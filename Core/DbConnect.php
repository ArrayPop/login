<?php
require "rb-mysql.php";
require "Config.php";
// localhost - host по умолчанию
// dbname - имя базы данных
// root - логин
// после логина идет пароль

R::setup( 'mysql:host='.HOST.';dbname='.DB_NAME,
        DB_USER, DB_PASS );

// Если после пароля поставить true, тогда функция создания таблиц на лету будет включена
// Если после пароля поставить false, тогда функция создания таблиц на лету будет отключена

// Проверка подключения к БД
if(!R::testConnection()) die('No DB connection!');

session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];