<?php
const DB_DSN = 'mysql:host=##DB_HOST##;dbname=blog';
const DB_USER = "##DB_USER##";
const DB_PASS = "##DB_PASSWORD##";



$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);