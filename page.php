<?php get_header(); ?>
<?php $str = get_fields(); ?>
<section id="content">
	<?php if ($str['banon']){ ?>
	<section id="page-bn" style="background-image:url(<?php echo $str['bnbg']; ?>)">
		<div class="container">
			<div class="head_serv">
				<div class="head_serv_left">
					<div class="">
						<div class="hs_h1"><?php echo $str['bntitle']; ?></div>
						<div class="hs_h2"><?php echo $str['bntxt']; ?></div>
					</div>
				</div>
				<div class="head_serv_right">
					<div class="head_serv_right_f">
						<?php foreach ($str['bnlist'] as $itm){ ?>
						<div class="hrs_f">
							<div class="hsr_img_holder">
								<img decoding="async" src="<?php echo $itm['img']; ?>" alt="">
							</div>
							<div class="hsr_txt"><?php echo $itm['txt']; ?></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		

	</section>
	<?php } ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		} ?>
		<?php if (!$str['banon']){ ?>
		<h1><?php the_title(); ?></h1>
		<?php } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
	</div>
</section>



<?php get_footer(); ?>