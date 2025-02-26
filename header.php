<?php $opts = get_fields('options'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
<?php if ( is_search() ) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
<?php } ?>
	<meta name="format-detection" content="telephone=no" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
<meta name="color-scheme" content="only light">
<meta name="theme-color" content="#fff">
</head>

<body <?php body_class(); ?>>

<section id="main_wrap">
	<header id="header">
		<div class="header-top">
			<div class="container">
				<div class="htop_wrap flex">
					<div class="htop_names">
						<p class="site-name"><?php bloginfo('name'); ?></p>
						<p class="site-descr"><?php bloginfo('description'); ?></p>
					</div>
					<div class="htop_r">
						<div class="header_cont">
							<a class="header_phone phone" href="tel:<?=preg_replace("/ (\s)|(\()|(\))|(\-) /xui","",$opts['phone'])?>">
								<img src="<?=get_template_directory_uri()?>/img/topphone.png" alt="Телефон">
								<?=$opts['phone']?>
							</a>
							<a class="header_addr addr" href="/kontakty">
								<img src="<?=get_template_directory_uri()?>/img/topmap.png" alt="Контакты">
								<?=$opts['addr']?>
							</a>
						</div>
						<a class="btn" href="/zakazat-zvonok-2">Заказать звонок</a>
					</div>
				</div>
			</div>
		</div>
		<div class="header-main">
			<div class="container flex">
				<div class="header_l">
					<?php the_custom_logo(); ?>
					<nav id="main-menu">
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'container'      => false,
							'menu_class'     => 'main-menu') 
						); ?> 
					</nav>
				</div>
				<div class="header_r">
					<div class="mob-icons">
						<a href="tel:<?=preg_replace("/ (\s)|(\()|(\))|(\-) /xui","",$opts['phone'])?>">
							<img src="<?=get_template_directory_uri()?>/img/topphone.png" alt="Телефон">
						</a>
						<a href="/contacts">
							<img src="<?=get_template_directory_uri()?>/img/topmap.png" alt="Контакты">
						</a>
					</div>
					<div class="header-socs socs">
						<a class="soc-item" href="<?=$opts['socs']['tgm']?>">
							<img src="<?=get_template_directory_uri()?>/img/telegram.png" alt="">
						</a>
						<a class="soc-item" href="<?=$opts['socs']['wa']?>">
							<img src="<?=get_template_directory_uri()?>/img/whatsup.png" alt="">
						</a>
						<a class="soc-item" href="mailto:sale@ahvtrucks.ru">
							<img src="<?=get_template_directory_uri()?>/img/mail.png" alt="">
						</a>
						<a class="soc-item" href="<?=$opts['socs']['vk']?>">
							<img src="<?=get_template_directory_uri()?>/img/vk.png" alt="">
						</a>
					</div>
					<button class="mmenu">
						<span></span>
					</button>
				</div>
			</div>
		</div>
	</header>	