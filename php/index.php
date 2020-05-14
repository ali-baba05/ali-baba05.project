<?php
include 'idiorm.php';

ORM::configure('mysql:host=localhost;dbname=serenity'); // название бд 
ORM::configure('username', 'mysql'); // имя пользователя для доступа к бд
ORM::configure('password', 'mysql'); // пароль для доступа к бд 

// устанавливаем кодировку 
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// вытягиваем переменную из массива $_REQUEST, если такая существует, 
// иначе возвращаем значение $default
function getRequestVar($var, $default=null) {
    return isset($_REQUEST[$var]) 
           ? trim($_REQUEST[$var])
           : $default
    ;
}
 
if (getRequestVar('name')  && getRequestVar('email') && getRequestVar('message')) { // Если пришло имя, почта, сообщение
    $record  = ORM::for_table('messages')->create(); // создаем объект, таблицы messages
    $record->name = getRequestVar('name'); // записываем в него значение, в поле name
	$record->email = getRequestVar('email');
	$record->message = getRequestVar('message'); // записываем в него значение, в поле message
    $record->save(); // сохраняем новую запись в базу данных
    header('Location:company.php');
}
?>
