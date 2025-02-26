<?php get_header(); ?>
<?php $opts = get_fields('options'); ?>
<section id="content">
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
	</div>
</section>
<section id="contacts">
	<div class="container">
		<div class="contacts_wrap">
			<div class="contacts">
				<h2>Контакты</h2>
				<div class="cont_line">
					<div class="cont_item">
						<p>Режим работы:</p>
						<?=$opts['rezhim']?>
					</div>
					<div class="cont_item">
						<p>Телефон:</p>
						<p><?=$opts['phone']?></p>
						<p><?=$opts['phone2']?></p>
					</div>
					<div class="cont_item">
						<p>E-mail:</p>
						<p><?=$opts['email']?></p>
					</div>
				</div>
				<div class="cont_line">
					<div class="cont_item">
						<p>Реквизиты:</p>
						<p><strong>ИНН:</strong> <?=$opts['inn']?></p>
						<p><strong>КПП:</strong> <?=$opts['kpp']?></p>
					</div>
					<div class="cont_item">
						<p>Адрес:</p>
						<p>660118, г. Красноярск</p>
						<p>Северное шоссе, д. 17Д/17</p>
					</div>
				</div>
				<div class="flex">
					<a href="/kontakty-form" class="btn">Свяжитесь с нами</a>
					<a href="https://yandex.ru/maps/?rtext=~56.074468,92.923832" target="_blank">Проложить маршрут до дилерского центра</a>
				</div>
				<div class="socs">
					<a class="soc-item" href="<?=$opts['socs']['tgm']?>">
						<img src="<?=get_template_directory_uri()?>/img/telegram_g.png" alt="">
					</a>
					<a class="soc-item" href="<?=$opts['socs']['wa']?>">
						<img src="<?=get_template_directory_uri()?>/img/whatsup_g.png" alt="">
					</a>
					<a class="soc-item" href="<?=$opts['socs']['vk']?>">
						<img src="<?=get_template_directory_uri()?>/img/vk_g.png" alt="">
					</a>
				</div>
			</div>
			<div class="contacts_map">
				<div id="map">
					<script charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af2f2cb6426ce3659fc569ddeb3a6fe52a334315df3341878fa599d5947dfec08&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>