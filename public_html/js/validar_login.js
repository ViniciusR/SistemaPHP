$(document).ready(function(){
        $('#formLogin').validate({
            rules:{
                email_login: {
                    required: true
                },
                senha_login: {
                    required: true
                }
            },
           
            messages:{
                email_login:   {
                	required: "Insira o seu e-mail."
                },
                senha_login:	{
                	required: "Insira a sua senha."
                }
            },
            
            //Ajax para verificar se o login e valido (email e senha corretos).
            submitHandler: function(form){
            	$.ajax({
            		url: "/SistemaPHP/lib/login.php",
            		type: "POST",
            		data: $('#formLogin').serialize(),
            		
            		success: function(resposta){
            			if (resposta == "erro")
            				{
            					$('#erro_login').html("E-mail ou senha inválidos.").show();
            				}
            			else
            				{
            					window.location="/SistemaPHP/public_html/area_usuario.php?id=" + resposta;
            				}
            		}
            	});
            },
                        
            highlight: function(element) {
                $(element).closest('.input-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.input-group').removeClass('has-error');
            },
                        
            errorElement: 'span',
            errorClass: 'msg-erro',
            errorPlacement: function(error, element) { 
            		          	
            		if(element.parent('.input-group').length) {
            			error.insertAfter(element.parent());
            		} else {
            			error.insertAfter(element);
            		}
            }
        });
	});