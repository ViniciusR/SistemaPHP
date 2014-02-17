jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Use apenas os seguintes caracteres: a-z, A-Z, 0-9.");



jQuery.validator.addMethod("dataNascimento", function(data) {
	data = data.replace('/','');
	data = data.replace('/','');
	dia = parseInt(data.substr(0,2));
	mes = parseInt(data.substr(2,2));
	ano = parseInt(data.substr(4,4));
	
	if ((mes > 12 || mes < 1) || (ano > 2013  || ano < 1) || dia < 1)
		{
			return false;
		}
	
	if (mes == 1 || mes == 3 || mes == 5 || mes == 7 || mes == 8 || mes == 10 || mes == 12)
		{
			return dia <= 31;
		}
	
	if (mes == 2)
		{
			if (ano % 4 == 0)
				{
					return dia <= 29;
				}
			else
				return dia <= 28;
		}
	
	return dia <= 30;	
}, "Data de nascimento inv�lida.");


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
  }, "CPF inv�lido.");


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
                	minlength: 10,
                	dataNascimento: true
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
                	remote: "Este endere�o de e-mail j� foi registrado.",
                	email: "Insira um endere�o de e-mail v�lido."
                },
                senha_registrar:	{
                	required: "Este campo deve ser preenchido.",
                	minlength: "A senha deve conter no m�nimo {0} caracteres."               		
                },
                confirmar_senha_registrar:	{
                	required: "Este campo deve ser preenchido.",
                	minlength: "A senha deve conter no m�nimo {0} caracteres.",         
                	equalTo: "As duas senhas n�o coincidem. Tente novamente."
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
