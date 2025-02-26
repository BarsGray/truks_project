<?php $opts = get_fields('options'); ?>	





<footer id="footer">
    <div class="container">
		<div class="footer-top">
			<div class="footer-top_l">
				<p class="site-name"><?php bloginfo('name'); ?></p>
				<?php wp_nav_menu( array( 
					'theme_location' => 'footer_menu', 
					'container'      => false,
					'menu_class'     => 'footer-menu') 
				); ?> 
			</div>
			<div class="footer_logo">
				<img src="<?=get_template_directory_uri()?>/img/logo_white.png" alt="Dongfeng">
			</div>
		</div>
		<div class="footer_mdl">
			<div class="footer_conts">
				<a class="footer_phone" href="tel:<?=preg_replace("/ (\s)|(\()|(\))|(\-) /xui","",$opts['phone'])?>"><?=$opts['phone']?></a>
				<a class="footer_mail" href="mailto:sale@ahvtrucks.ru"></a>
				<p><?=$opts['addr']?></p>
			</div>
			<div class="footer_mdl_cntr">
				<div class="socs">
					<a class="soc-item" href="<?=$opts['socs']['tgm']?>">
						<img src="<?=get_template_directory_uri()?>/img/telegram_b.png" alt="">
					</a>
					<a class="soc-item" href="<?=$opts['socs']['wa']?>">
						<img src="<?=get_template_directory_uri()?>/img/whatsup_b.png" alt="">
					</a>
					<a class="soc-item" href="mailto:sale@ahvtrucks.ru">
						<img src="<?=get_template_directory_uri()?>/img/mail_b.png" alt="">
					</a>
					<a class="soc-item" href="<?=$opts['socs']['vk']?>">
						<img src="<?=get_template_directory_uri()?>/img/vk_b.png" alt="">
					</a>
				</div>
				<a class="btn" href="/zakazat-zvonok-1">Заказать звонок</a>
			</div>
			<a href="<?php the_permalink($opts['pravo'][0]->ID); ?>">Правовые аспекты</a>
		</div>
		<div class="footer_btm">
			<p>Информация, представленная на сайте в отношении автомобилей, их стоимости, сервисного обслуживания и специальных предложений (акций), носит информационный характер и не является публичной офертой (ст. 437 ГК РФ). Для получения подробной информации просьба обращаться в ООО "АХВ-Тракс" официальному дилеру DONGFENG. Информация, опубликованная на данном сайте может быть изменена по инициативе ООО "АХВ-Тракс" в любое время, без предварительного уведомления.</p>

<?php 
add_shortcode("date", function($atts)
{
	//Sets
	$atts = shortcode_atts(array(
		'template' => date('Y-m-d'),
	),$atts);

	return date($atts['template']);
});
 ?>

<p class="diskl">*Цены действительны по состоянию на <?php echo do_shortcode('[date template="Y-m-d"]'); ?> и могут быть изменены производителем без предварительного уведомления.<br>
Расчёт стоимости в рублях РФ производиться по действующему курсу CYN(юаня) ЦБ РФ.</p>
<p class="diskl">**Поля обязательны для заполнения</p>


			<p><?php echo date('Y'); ?> ООО "АХВ-Тракс", ИНН <?=$opts['inn']?>, ОГРН <?=$opts['ogrn']?></p>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>


<!-- calltouch -->
<script>
(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)},m=typeof Array.prototype.find === 'function',n=m?"init-min.js":"init.js";s.async=true;s.src="https://mod.calltouch.ru/"+n+"?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","fwaxbaxm");
</script>
<!-- calltouch -->


<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(93696458, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/93696458" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</body>
</html>