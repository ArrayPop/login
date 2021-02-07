<?php 
if ( !defined('ABSPATH') )
	define('ABSPATH', true);
require $_SERVER['DOCUMENT_ROOT'] ."/Core/DbConnect.php"; 
$title="Форма авторизации"; // название формы

?>



<?php require $_SERVER['DOCUMENT_ROOT'] . '/header.php'; // подключаем шапку проекта ?>
<div class="container mt-4">
	<div class="row">
		<div class="col">
			<center>
				<h1>Добро пожаловать на наш сайт!</h1>
			</center>
		</div>
	</div>
</div>

<!-- Если авторизован выведет приветствие -->
<?php if(isset($_SESSION['logged_user'])) : ?>
	Привет, <?php echo $_SESSION['logged_user']->name; ?></br>

<!-- Пользователь может нажать выйти для выхода из системы -->
<a href="logout.php">Выйти</a> <!-- файл logout.php создадим ниже -->
<?php else : ?>

<!-- Если пользователь не авторизован выведет ссылки на авторизацию и регистрацию -->
<a href="login.php">Авторизоваться</a><br>
<a href="signup.php">Регистрация</a>
<?php endif; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?> <!-- Подключаем подвал проекта -->