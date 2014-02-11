/**
 * 
 */
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Use apenas os seguintes caracteres: a-z, A-Z, 0-9.");

$(document).ready(function(){
        $('#formAlterarCadastro').validate({
            rules:{
                nome_novo:{
                    required: true
                },
                sobrenome_novo:{
                    required: true
                },
                data_nasc_nova: {
                	required: true,
                	minlength: 10
                },
                email_novo: {
                    required: true,
                    email: true,
                    remote: {
                    	url: "../lib/verificarEmail.php",
                    	type: "post",
                    	data: {
                    		email_novo: function(){
                    			return $("#email_novo").val();
                    		}
                    	}
                    }
                },
                senha_atual: {
                    required: true,
                    alphanumeric: true,
                    minlength: 6,
                    remote: {
                    	url: "../lib/verificarSenhaAtual.php",
                    	type: "post",
                    	data: {
                    		senha_atual: function(){
                    			return $("#senha_atual").val();
                    		}
                    	}
                    }
                },
                senha_nova: {
                    required: false,
                    alphanumeric: true,
                    minlength: 6
                },
                confirmar_senha_nova: {
                    required: false,
                    minlength: 6,
                    equalTo: "#senha_nova"
                }
            },
           
            groups: {
            	nomeCompleto: "nome_novo sobrenome_novo"
            },
            
            messages:{
            	nome_novo: "Este campo deve ser preenchido.",
            	sobrenome_novo: "Este campo deve ser preenchido.",
                email_novo:   {
                	required: "Este campo deve ser preenchido.",
                	remote: "Este endereço de e-mail já foi registrado.",
                	email: "Insira um endereço de e-mail válido."
                },
                senha_atual:	{
                	required: "Este campo deve ser preenchido.",
                	remote: "Senha atual incorreta.",
                	minlength: "A senha deve conter no mínimo {0} caracteres."               		
                },
                senha_nova:	{
                	required: "Este campo deve ser preenchido.",
                	minlength: "A senha deve conter no mínimo {0} caracteres."               		
                },
                confirmar_senha_nova:	{
                	required: "Este campo deve ser preenchido.",
                	minlength: "A senha deve conter no mínimo {0} caracteres.",         
                	equalTo: "As duas senhas não coincidem. Tente novamente."
                },
                data_nasc_nova: {
                	required: "Este campo deve ser preenchido.",
                	minlength: "Preencha a data no formato dd/mm/aaaa."
                }
            },
                        
            highlight: function(element) {
                $(element).closest('.control-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.control-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'msg-erro',
            errorPlacement: function(error, element) {
            	if (element.attr("name") == "nome_novo" || element.attr("name") == "sobrenome_novo") { 
            		error.insertAfter(".name-group");
            	}            	
            	else {
            		if(element.parent('.input-group').length) {
            			error.insertAfter(element.parent());
            		} else {
            			error.insertAfter(element);
            		}
            	}
            }
        });
	});