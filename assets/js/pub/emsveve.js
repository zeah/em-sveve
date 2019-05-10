


jQuery(function($) {
	// console.log(document.location);
	var ele = $('<div class="em-sveve-container"><h1 class="em-sveve-tittel">Sende Nyhetsbrev på SMS</h1><button type="button" class="em-sveve-knapp-lukk"></button><textarea class="em-sveve-sms-tekst"></textarea><button class="em-sveve-knapp-send" type="button">Send</button></div>');
		// ele.appendTo('body');
// 
	$('#wp-admin-bar-sveve-nyhetsbrev > a.ab-item').on('click', function(e) {
		e.preventDefault();
		ele.appendTo('body');
		ele.show(); // closing it, adds inline display=none

		$('.em-sveve-knapp-lukk, .em-sveve-knapp-send').one('click', function() {

			$('.em-sveve-container').fadeOut(500, function() {
				$(this).remove();
			});
		});

		$('.em-sveve-knapp-send').one('click', function() {

			// console.log($('.em-sveve-sms-tekst').val());

			$.post(emurl.ajax_url, {
				action: 'sveve',
				text: $('.em-sveve-sms-tekst').val(),
				link: location.href
			}, function(data) {
				console.log(data);
			});

		});

	});
});

