<?php
require $_SERVER['DOCUMENT_ROOT'] ."/Core/Classes/UserOperations.php";  
class Login extends UserOperations{  

    protected $user = null;


    /*
    * Добавляем  пользователя
    */
    public function auth(){  
        
        if(empty($this->errors)) {

            // Все верно, пускаем пользователя
            $_SESSION['logged_user'] = $this->user;
                
            // Редирект на главную страницу
            echo "success";
            exit;

        } else {
                    // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
            echo '<div style="color: red; ">' . array_shift($this->errors). '</div><hr>';
          
            exit;
        }
           
    }  


    /*
    * обязательные  проверки
    */
    protected function  requiredValidate(){
         // Проводим поиск пользователей в таблице users
         $this->user = R::findOne('users', 'login = ?', array($this->data['login']));
         if($this->data['token'] != $_SESSION['token']) {

            $this->errors[] = "Не верный токен";
         }
         if($this->user) {

            // Если логин существует, тогда проверяем пароль
            if(!password_verify($this->data['password'], $this->user->password)) {
                $this->errors[] = 'Пароль неверно введен!';
            }

         } else {
            $this->errors[] = 'Пользователь с таким логином не найден!';
         }

    }
   
} 
