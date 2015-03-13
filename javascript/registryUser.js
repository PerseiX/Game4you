$(document).ready(function(){
    $(this).click(function(event) {
        var currentTarget = event.target.id;

        $("#"+currentTarget).blur(function() {

            var email = $("#email").val();
            var login = $("#login").val();
            var password = $("#password").val();
            var passwordRepeat = $("#passwordRepeat").val();
            $.ajax({
                url: "../src/Controller.php?module=user&action=validation",
                type: "POST",
                dataType : 'json',
                data: {
                    email: email,
                    login: login,
                    password: password,
                    passwordRepeat: passwordRepeat
                },
                success: function(data) {
				   if(data["validEmail"]==false && currentTarget=="email"){

                        document.getElementById("email").style.border = '1px solid red';
                        document.getElementById("status").src = "../images/x.png";
                        document.getElementById("status").title = "Błędny email.";
                    }
                    else if(data["validEmail"]==true && currentTarget=="email"){
                        document.getElementById("email").style.border = '1px solid blue';
                        document.getElementById("status").src = "../images/tick.png";
                        document.getElementById("status").title = "Poprawny email.";
                    }
					
					if(data["validLogin"]==false && currentTarget=="login"){
                        document.getElementById("login").style.border = '1px solid red';
                        document.getElementById("status2").src = "../images/x.png";
                        document.getElementById("status2").title = "Podany login istnieje.";
                    }
                    else if(data["validLogin"]==true && currentTarget=="login"){
                        document.getElementById("login").style.border = '1px solid blue	';
                        document.getElementById("status2").src = "../images/tick.png";
                        document.getElementById("status2").title = "Poprawny login.";
                    }
					
					if(data["validPassword"]==false && currentTarget=="passwordRepeat"){
                        document.getElementById("password").style.border = '1px solid red';
						document.getElementById("passwordRepeat").style.border = '1px solid red';
                        document.getElementById("status3").src = "../images/x.png";
						document.getElementById("status4").src = "../images/x.png";
                        document.getElementById("status3").title = "Hasło musi mieć conajmniej 6 znaków..";
                    }
                    else if(data["validPassword"]==true && currentTarget=="passwordRepeat"){
                        document.getElementById("password").style.border = '1px solid blue	';
						document.getElementById("passwordRepeat").style.border = '1px solid blue	';
                        document.getElementById("status3").src = "../images/tick.png";
						document.getElementById("status4").src = "../images/tick.png";
                        document.getElementById("status3").title = "Poprawne hasło.";
                    }
					
                },
                error: function (err){
                    alert(err);
                }
            });
        });
    });

    $(".registryButton").click(function() {
        var email = $("#email").val();
        var login = $("#login").val();
        var password = $("#password").val();
        var passwordRepeat = $("#passwordRepeat").val();
        $.ajax({
            url: "../src/Controller.php?module=user&action=registry",
            type: "POST",
            dataType : 'json',
            data: {
                email: email,
                login: login,
                password: password,
                passwordRepeat: passwordRepeat
            },
            success: function(data) {
		
              if(data['registryStatus'] == true){
                    document.getElementById('email').value = "";
                    document.getElementById('login').value = "";
                    document.getElementById('password').value = "";
                    document.getElementById('passwordRepeat').value = ""
                    document.getElementById("status4").src = "";
                    document.getElementById("status3").src = "";
                    document.getElementById("status2").src = "";
                    document.getElementById("status").src = "";
                    document.getElementById("registryComunicat").innerHTML="Poprawna rejestracja";
                }
				else{
					document.getElementById("registryComunicat").innerHTML="Błędne dane rejestracji!";
				}
            },
            error: function (err){
                alert(err);
            }
        });
    });

    $(".loginButton").click(function() {

        var login = $("#logins").val();
        var password = $("#passwords").val();
        $.ajax({
            url: "../src/Controller.php?module=user&action=login",
            type: "POST",
            dataType : 'json',
            data: {
                login: login,
                password: password
            },
            success: function(data) {
                if(data['loginStatus'] == true){
                    document.getElementById("loginComunicat").innerHTML="Zalogowano jako "+data["login"];
                    document.getElementById("loginout").innerHTML="Wyloguj<br>" + data["login"];
					document.getElementById("logins").value="";
					document.getElementById("passwords").value="";
                }
                else{
                    document.getElementById("loginComunicat").innerHTML="Błędny login lub hasło!";
                }

            },
            error: function (err){
                alert(err);
            }
        });
    });

});