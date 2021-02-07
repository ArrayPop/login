<?php

require $_SERVER['DOCUMENT_ROOT'] ."/Core/Classes/UserOperations.php";  
class Register extends UserOperations{  

   
    /*
    * Добавляем  пользователя
    */
    public function addUser(){  
        if(empty($this->errors)) {

            // Все проверено, регистрируем
            // Создаем таблицу users
            $user = R::dispense('users');

                    // добавляем в таблицу записи
            $user->login = $this->data['login'];
            $user->email = $this->data['email'];
            $user->name = $name;
            $user->family = $family;

            // Хешируем пароль
            $user->password = password_hash($this->data['password'], PASSWORD_DEFAULT);

            unset($this->data['login'],$this->data['email'],$this->data['password']);

            foreach($this->data as $key => $value){
                $user->{$key}  = $value;
            }

            // Сохраняем таблицу
            R::store($user);
            echo '<div style="color: green; ">Вы успешно зарегистрированы! Можно <a href="login.php">авторизоваться</a>.</div><hr>';
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
        if($this->data['token'] != $_SESSION['token']) {

            $this->errors[] = "Не верный токен";
        }

        if(trim($this->data['login']) == '') {

            $this->errors[] = "Введите логин!";
        }

        if(trim($this->data['email']) == '') {

            $this->errors[] = "Введите Email";
        }

        if($this->data['password'] == '') {

            $this->errors[] = "Введите пароль";
        }

             // функция mb_strlen - получает длину строки
            // Если логин будет меньше 5 символов и больше 90, то выйдет ошибка
        if(mb_strlen($this->data['login']) < 5 || mb_strlen($this->data['login']) > 90) {

            $this->errors[] = "Недопустимая длина логина (от 5 символов)";

        }

        if (mb_strlen($this->data['password']) < 2 ){
        
            $this->errors[] = "Недопустимая длина пароля (от 2 cиволов)";

        }
        // проверка на правильность написания Email
        if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $this->data['email'])) {

            $this->errors[] = 'Неверно введен е-mail';
        
        }

        if(R::count('users', "login = ?", array($this->data['login'])) > 0) {

           $this->errors[] = "Пользователь с таким логином существует!";
        }

        // Проверка на уникальность email

        if(R::count('users', "email = ?", array($this->data['email'])) > 0) {

            $this->errors[] = "Пользователь с таким Email существует!";
        }
    }
   
} 
