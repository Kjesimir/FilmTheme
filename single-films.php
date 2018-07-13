<?php get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
?>

	<div class="container">
		<div class="row">

			<?php if ( $default_sidebar_position === 'no' ) : ?>
				<div class="col-md-12 wp-bp-content-width">
			<?php else : ?>
				<div class="col-md-8 wp-bp-content-width">
			<?php endif; ?>

				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						the_post_navigation(array(
				            'prev_text' => esc_html__( '&laquo; Предыдущий фильм', 'wp-bootstrap-4' ),
				            'next_text' => esc_html__( 'Следующий фильм &raquo;', 'wp-bootstrap-4' ),
				        ) );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<!-- /.col-md-8 -->

			<?php if ( $default_sidebar_position != 'no' ) : ?>
				<?php if ( $default_sidebar_position === 'right' ) : ?>
					<div class="col-md-4 wp-bp-sidebar-width">
				<?php elseif ( $default_sidebar_position === 'left' ) : ?>
					<div class="col-md-4 order-md-first wp-bp-sidebar-width">
				<?php endif; ?>
						<?php get_sidebar(); ?>
					</div>
					<!-- /.col-md-4 -->
			<?php endif; ?>
		</div>
		<!-- /.row -->
	</div>
	
	<!-- /. Short Code -->
	
	<?php echo do_shortcode( '[recentfilms num="6"]' );?>
	
	<!-- /. <section id="reviews">
		<?php //$posts = test_show_reviews(); ?>
		<h4>Киноновинки</h4>
		<div class="reviews-box owl-carousel owl-theme">
				<?php $posts=get_posts('films',6); ?>
			<?php foreach($posts as $post): ?>
				<a class="reviewItem" href="<?php echo get_the_permalink() ?>">
					<div class="reviewItem__title"><?php echo $post->post_title ?></div>					
					<?php 					
					if( has_post_thumbnail() ) ?>
						<div class="reviewItem__content"><?php echo  get_the_post_thumbnail(  $post->ID, 'thumbnail' ) ?></div>					
				</a>
			<?php endforeach;wp_reset_postdata();  ?>
		</div>
	</section> -->
<?php
get_footer();
