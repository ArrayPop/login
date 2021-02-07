<?php
class UserOperations {  

    protected $errors = [];
    protected $data = [];

    
    public function __construct($data){
        $this->data = $data;
        $this->requiredValidate();
    }

    

    /*
    * исключаем  не нужные  параметры данные из $_POST
    */
    public  function exclude($data){
        foreach ($data as $key) {
            unset($this->data[$key]);
        }
    }

    /*
    * пользовательские проверки
    */
    public  function validate($data,$callback = null){

        if(!empty($data)){
            foreach($data as $key => $value){
                if(trim($this->data[$key]) == '') {
                    $this->errors[] = $value;
                }
            }
        }

        if($callback instanceof Closure){
            $this->errors = array_merge($this->errors,$callback($this->data,$this->errors));
        }

        

    }

   
} 
