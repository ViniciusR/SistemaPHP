jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Use apenas os seguintes caracteres: a-z, A-Z, 0-9.");


//Fonte: www.geradordecpf.org
jQuery.validator.addMethod("cpf", function(valor) {
	
	//remove os "." e "-", pra analisar apenas os numeros.
	valor = valor.replace('.', '');
	valor = valor.replace('.', '');
    cpf = valor.replace('-', '');
    
  var numeros, digitos, soma, i, resultado, digitos_iguais;
  digitos_iguais = 1;
  if (cpf.length < 11)
        return false;
  for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1))
              {
              digitos_iguais = 0;
              break;
              }
  if (!digitos_iguais)
        {
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
              soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
              return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
              soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
              return false;
        return true;
        }
  else
      return false;
  }, "CPF inválido.");


$(document).ready(function(){
        $('#formRegistrar').validate({
            rules:{
                nome_registrar:{
                    required: true
                },
                sobrenome_registrar:{
                    required: true
                },
                email_registrar: {
                    required: true,
                    email: true,
                    remote: {
                    	url: "lib/verificarEmail.php",
                    	type: "post",
                    	data: {
                    		email: function(){
                    			return $("#email_registrar").val();
                    		}
                    	}
                    }
                },
                senha_registrar: {
                    required: true,
                    alphanumeric: true,
                    minlength: 6
                },
                confirmar_senha_registrar: {
                    required: true,
                    alphanumeric: true,
                    minlength: 6,
                    equalTo: "#senha_registrar"
                },
                cpf_registrar: {
                	required: true,
                	cpf: true
                },
                data_nasc_registrar: {
                	required: true,
                	minlength: 10
                }
            },
           
            groups: {
            	nomeCompleto: "nome_registrar sobrenome_registrar"
            },
            
            messages:{
            	nome_registrar: "Este campo deve ser preenchido.",
            	sobrenome_registrar: "Este campo deve ser preenchido.",
                email_registrar:   {
                	required: "Este campo deve ser preenchido.",
                	remote: "Este endereço de e-mail já foi registrado.",
                	email: "Insira um endereço de e-mail válido."
                },
                senha_registrar:	{
                	required: "Este campo deve ser preenchido.",
                	minlength: "A senha deve conter no mínimo {0} caracteres."               		
                },
                confirmar_senha_registrar:	{
                	required: "Este campo deve ser preenchido.",
                	minlength: "A senha deve conter no mínimo {0} caracteres.",         
                	equalTo: "As duas senhas não coincidem. Tente novamente."
                },
                cpf_registrar: {
                	required: "Este campo deve ser preenchido."
                },
                data_nasc_registrar: {
                	required: "Este campo deve ser preenchido.",
                	minlength: "Preencha a data no formato dd/mm/aaaa."
                }
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
            	if (element.attr("name") == "nome_registrar" || element.attr("name") == "sobrenome_registrar") { 
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
