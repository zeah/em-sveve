


jQuery(function($) {
	var ins = ['max_age', 'min_age', 'max_salery', 'min_salery'];
	var inputs = '';

	for (var i in ins)
		inputs += '<div class="em-sveve-c em-sveve-c-'+ins[i]+'"><label for="">'+ins[i].replace(/_/g, ' ')+'</label><input class="'+ins[i]+'"></div>';

	// inputs += '<div class="em-sveve-c em-sveve-c-gender"><label>gender</label><select class="gender"><option>any</option><option>male</option><option>female</option></select></div>';

	var ele = $('<div class="em-sveve-glass"></div><div class="em-sveve-container"><h1 class="em-sveve-tittel">Sende Nyhetsbrev på SMS</h1><button type="button" class="em-sveve-knapp-lukk"></button><textarea class="em-sveve-sms-tekst"></textarea>'+inputs+'<button class="em-sveve-knapp-send" type="button">Send</button></div>');

	$('#wp-admin-bar-sveve-nyhetsbrev > a.ab-item').on('click', function(e) {
		e.preventDefault();
		ele.appendTo('body');
		ele.show(); // closing it, adds inline display=none

		$('.em-sveve-knapp-lukk, .em-sveve-knapp-send').one('click', function() {

			$('.em-sveve-container, .em-sveve-glass').fadeOut(500, function() {
				$(this).remove();
			});
			
		});

		$('.em-sveve-knapp-send').one('click', function() {

			$.post(emurl.ajax_url, {
				action: 'sveve',
				text: $('.em-sveve-sms-tekst').val(),
				min_age: $('.em-sveve-c .max_age').val(),
				max_age: $('.em-sveve-c .min_age').val(),
				min_salery: $('.em-sveve-c .min_salery').val(),
				max_salery: $('.em-sveve-c .max_salery').val(),
				gender: $('.em-sveve-c .gender').val(),
				link: location.href
			}, function(data) {
				console.log(data);
			});

		});

	});
});

