jQuery(function ($) {
	$('#header .menu-item-has-children > a')
		.append('<span class="parent_icon"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.00008 5.07076L2.42908 0.499756L0.929077 1.99976L7.00008 8.07075L13.0711 1.99976L11.5711 0.499756L7.00008 5.07076Z" fill="#fff"/></svg></span>');
	/* maskedinput */
	$('input[type="tel"]').inputmask("+7 (999) 999-9999", {
		placeholder: "Х",
		clearMaskOnLostFocus: true,
		showMaskOnHover: false
	});


	/*document.addEventListener( 'wpcf7mailsent', function( event ) {
				 $(location).attr('href','/thanks');
	}, false );*/

	$('[data-target]').click(function () {
		$($(this).attr('data-target')).modal();
	});

	$('.mmenu').click(function () {
		$(this).toggleClass('open');
		$('#main-menu').toggleClass('open');
		$('body').toggleClass('overflow');
	});
	/*-----------*/

	/*Выбор почты для формы сервиса*/
	$('select[name="menu-938"], select[name="menu-58"], select[name="otdel"]').change(function () {
		switch ($(this).val()) {
			case 'Отдел продаж':
				$('[name="smailto"]').val('sale@ahvtrucks.ru');
				break;
			case 'Отдел сервиса':
				$('[name="smailto"]').val('service@ahvtrucks.ru');
				break;
			case 'Отдел запасных частей':
				$('[name="smailto"]').val('parts@ahvtrucks.ru');
				break;
			case 'Иной вопрос':
				$('[name="smailto"]').val('sale@ahvtrucks.ru');
				break;
		}
	});
	/*------------------------------*/

	function w128activiti(e) {
		e.preventDefault();
		$(this).toggleClass('open');
		$(this).find('.sub-menu').slideToggle(400);
	}

	/*Mobile fixes*/
	/*if ($(window).width()>1259){
	$('#header .container').css('padding-left',$('#footer .container').offset().left);
	}*/
	function w128(e) {
		e.stopPropagation();
	}

	// function w128r() {
	// }
	// function w768() {
	// }
	// function w768r() {
	// }
	// function w575() {
	// }
	// function w575r() {
	// }

	function w480() {
		if (!$('#main-menu > div').is('div')) {
			$('#main-menu').append('<div></div>');
			$('#main-menu > div').append($('.header-socs .soc-item:first-child'));
			$('#main-menu > div').append($('.header-socs .soc-item:nth-child(2)'));
			$('#main-menu > div').append($('.header-socs .soc-item:last-child'));
		}
	}
	function w480r() {
		if ($('#main-menu > div').is('div')) {
			$('.header-socs').prepend($('#main-menu > div a:first-child,#main-menu > div a:nth-child(2)'));
			$('.header-socs').prepend($('#main-menu > div a:last-child'));
			$('#main-menu > div').remove();
		}
	}

	if ($(window).width() < 1280) {
		$('#header .menu-item-has-children').on('click', w128activiti);
		$('#header .menu-item-has-children ul a').on('click', w128);
	}

	// if ($(window).width() < 992) {
	// }
	// if ($(window).width() < 768) {
	// 	w768();
	// }
	// if ($(window).width() < 576) {
	// 	w575();
	// }
	if ($(window).width() < 480) {
		w480();
	}

	$(window).resize(function () {
		$('#main-menu .menu-item-has-children').removeClass('open');
		$('#main-menu .sub-menu').attr('style', '');
		$('#header .menu-item-has-children').off('click', w128activiti);
		$('#header .menu-item-has-children ul a').off('click', w128);

		/*if ($(window).width()>1259){
			$('#header .container').css('padding-left',$('#footer .container').offset().left);
		}*/
		if ($(window).width() < 1280) {
			$('#header .menu-item-has-children').on('click', w128activiti);
			$('#header .menu-item-has-children ul a').on('click', w128);
		} else {
			// w128r();
		}
		// if ($(window).width() < 768) {
		// 	w768();
		// } else {
		// 	w768r();
		// }
		// if ($(window).width() < 576) {
		// 	w575();
		// } else {
		// 	w575r();
		// }
		if ($(window).width() < 480) {
			w480();
		} else {
			w480r();
		}
	});
	/*------------*/
});