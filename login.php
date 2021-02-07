<?php 
if ( !defined('ABSPATH') )
	define('ABSPATH', true);
require $_SERVER['DOCUMENT_ROOT'] ."/Core/DbConnect.php";  
require $_SERVER['DOCUMENT_ROOT'] ."/Core/Classes/Login.php";
$title="Форма авторизации"; // название формы
if(isset($_SESSION['logged_user'])) header('Location: index.php');
// Создаем переменную для сбора данных от пользователя по методу POST
$data = $_POST;

// Пользователь нажимает на кнопку "Авторизоваться" и код начинает выполняться
if(isset($data['do_login'])) { 

 	$login = new Login($data);
	

	$login->auth();

}
?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/header.php'; // подключаем шапку проекта?>
<div class="container mt-4">
		<div class="row">
			<div class="col">
		<!-- Форма авторизации -->
		<h2>Форма авторизации</h2>
		<form action="login.php" method="post" id="login_form" name="login_form">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
			<div class="invalid-feedback"></div><br>
			<input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль">
			<div class="invalid-feedback"></div><br>
			<input type="hidden"  name="token" value="<?=$token;?>">
			<button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
		</form>
		<br>
		<p>Если вы еще не зарегистрированы, тогда нажмите <a href="signup.php">здесь</a>.</p>
		<p>Вернуться на <a href="index.php">главную</a>.</p>
			</div>
		</div>
	</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?> <!-- Подключаем подвал проекта -->