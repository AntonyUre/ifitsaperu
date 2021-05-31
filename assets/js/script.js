
	jQuery(document).ready(function() {
	
	/*
	    Contact form
	*/
    $('.contact-form form').submit(function(e) {
    	e.preventDefault();
    	var form = $(this);
    	var nameLabel = form.find('label[for="contact-name"]');
    	var emailLabel = form.find('label[for="contact-email"]');
		var fonoLabel = form.find('label[for="contact-fono"]');
    	var messageLabel = form.find('label[for="contact-message"]');
    	
    	nameLabel.html('Nombres y Apellidos');
    	emailLabel.html('Correo V&aacute;lido');
		fonoLabel.html('Tel&eacute;fono / Celular');
    	messageLabel.html('Mensaje');
        
        var postdata = form.serialize();        
        $.ajax({
            type: 'POST',
            url: 'assets/sendmail.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.nameMessage != '') {
                	nameLabel.append(' - <span class="red error-label"> ' + json.nameMessage + '</span>');
                }
                if(json.emailMessage != '') {
                	emailLabel.append(' - <span class="red error-label"> ' + json.emailMessage + '</span>');
                }
				if(json.fonoMessage != '') {
                	fonoLabel.append(' - <span class="red error-label"> ' + json.fonoMessage + '</span>');
                }
                if(json.messageMessage != '') {
                	messageLabel.append(' - <span class="red error-label"> ' + json.messageMessage + '</span>');
                }
                if(json.nameMessage == '' && json.emailMessage == '' && json.messageMessage == '') {
				//if(json.nameMessage == '' && json.emailMessage == '' && json.fonoMessage == '' && json.messageMessage == '') {
                	form.fadeOut('fast', function() {
                		form.parent('.contact-form').append('<p class="yellow"><span class="green">Gracias, tu mensaje ha sido enviado!</span> Nos pondremos en contacto contigo a la brevedad posible. <a class="green" href="http://www.ifitsaperu.com/">Actualizar</a></p>');
                    });
                }
            }
        });
    });

});