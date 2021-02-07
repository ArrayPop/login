"use strict"


var User = {
	loginErrors: [],
	registerErrors: [],
	init: function(){
		this.authValidate();
		this.registerValidate();
		$("#register_form").on("submit",this.register.bind(this));
		$("#login_form").on("submit",this.auth.bind(this))
	},
	authValidate: function(){
		var self = this
		 var validator = new FormValidator('login_form', [{
		    name: 'login',
		    display: 'Логин',
		    rules: 'required',
		    mess: 'Вы должны заполнить поле'
		},{
		    name: 'password',
		    display: 'Пароль',
		    rules: 'required',
		}], function(errors, event) {
		    self.loginErrors = errors
		});
		 validator.setMessage('required', 'Введите %s.');
	},
	registerValidate: function(){
		var self = this
		 var validator = new FormValidator('register_form', [{
		    name: 'login',
		    display: 'Логин',
		    rules: 'required|min_length[5]|max_length[90]',
		},{
		    name: 'email',
		    display: 'Email',
		    rules: 'required|valid_email',
		},{
		    name: 'name',
		    display: 'Имя',
		    rules: 'required|min_length[5]|max_length[50]',
		},{
		    name: 'family',
		    display: 'Фамилия',
		    rules: 'required|min_length[5]|max_length[90]',
		},{
		    name: 'password',
		    display: 'Пароль',
		    rules: 'required|min_length[2]',
		}], function(errors, event) {

		    self.registerErrors = errors
		});
		 validator.setMessage('required', 'Введите %s.');
		 validator.setMessage('min_length', 'В поле %s должно быть не меньше %s');
		 validator.setMessage('max_length', 'В поле %s должен быть не больше %s');
		 validator.setMessage('valid_email', 'Email не верный');
	},
	auth: function(e){
		 e.preventDefault();

		if(this.loginErrors.length > 0){
			for(var i = 0; i<this.loginErrors.length; i++){
				$(this.loginErrors[i].element).addClass('is-invalid')
				$(this.loginErrors[i].element).next().text(this.loginErrors[i].message)
			}
			return;
		}


		 var data = $( e.currentTarget ).serialize();
		
	     $.ajax({
		      url: '/login.php',
		      type: 'POST',
		      dataType:  'html',
		      data: data + '&do_login', 
		      success: function( data ) {
		      	if(data == "success"){
		      		document.location.reload()
		      	}else{
		        	$("#error").html(data)
		    	}
		      },error:function(jqXHR, textStatus, errorThrown ){
		       console.log(textStatus,jqXHR,errorThrown)
		      }
		 });
		
	},
	register: function(e){
		 e.preventDefault();

		 if(this.registerErrors.length > 0){
			for(var i = 0; i<this.registerErrors.length; i++){
				$(this.registerErrors[i].element).addClass('is-invalid')
				$(this.registerErrors[i].element).next().text(this.registerErrors[i].message)
			}
			return;
		}

		 var data = $( e.currentTarget ).serialize();
		
	     $.ajax({
		      url: '/signup.php',
		      type: 'POST',
		      dataType:  'html',
		      data: data + '&do_signup', 
		      success: function( data ) {
		      	if(data == "success"){
		      		document.location.reload()
		      	}else{
		        	$("#error").html(data)
		    	}
		      },error:function(jqXHR, textStatus, errorThrown ){
		       console.log(textStatus,jqXHR,errorThrown)
		      }
		 });
		
	}

}
User.init();