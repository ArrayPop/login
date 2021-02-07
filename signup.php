<?php 
if ( !defined('ABSPATH') )
	define('ABSPATH', true);
require $_SERVER['DOCUMENT_ROOT'] ."/Core/DbConnect.php";  
require $_SERVER['DOCUMENT_ROOT'] ."/Core/Classes/Register.php"; // подключаем файл для соединения с БД
$title="Форма регистрации"; // название формы
if(isset($_SESSION['logged_user'])) header('Location: index.php');
// Создаем переменную для сбора данных от пользователя по методу POST
$data = $_POST;

// Пользователь нажимает на кнопку "Зарегистрировать" и код начинает выполняться
if(isset($data['do_signup'])) {

        // Регистрируем
        // Создаем массив для сбора ошибок
	
	$register = new Register($data);

	

	$register->validate([
		'family' => 'Введите фамилию',
		'name' => 'Введите Имя'
	],function($data,$errors){
		if(mb_strlen($data['family']) < 5 || mb_strlen($data['family']) > 90) {
			$errors[] = "Недопустимая длина фамилии";
		}
		if (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 50){
            $errors[] = "Недопустимая длина имени";
        }
        return $errors;
	});
	$register->exclude(['password_2','do_signup','token']);
	

	$register->addUser();
	
	
}
?>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/header.php'; // подключаем шапку проекта ?>
<div class="container mt-4">
		<div class="row">
			<div class="col">
	   <!-- Форма регистрации -->
		<h2>Форма регистрации</h2>
		<form action="signup.php" method="post" id="register_form" name="register_form">

			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
			<div class="invalid-feedback"></div><br>
			<input type="email" class="form-control" name="email" id="email" placeholder="Введите Email">
			<div class="invalid-feedback"></div><br>
			<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя">
			<div class="invalid-feedback"></div><br>
			<input type="text" class="form-control" name="family" id="family" placeholder="Введите фамилию">
			<div class="invalid-feedback"></div><br>
			<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
			<div class="invalid-feedback"></div><br>
			<input type="hidden"  name="token" value="<?=$token;?>">
			<button class="btn btn-success" name="do_signup" type="submit">Зарегистрировать</button>
		</form>
		<br>
		<p>Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>.</p>
		<p>Вернуться на <a href="index.php">главную</a>.</p>
			</div>
		</div>
	</div>
<?php require  $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?> <!-- Подключаем подвал проекта -->