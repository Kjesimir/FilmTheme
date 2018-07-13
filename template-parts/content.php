<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mt-3r' ); ?>>
	<div class="card-body">
		
		<? //ЕСЛИ ЗАПИСИ БЫЛИ УЖЕ НА ГЛАВНОЙ СТРАНИЦЕ ОНИ ПОМЕЧАЮТСЯ ВКЛАДКОЙ?>
		<?php if ( is_sticky() ) : ?>
			<span class="oi oi-bookmark wp-bp-sticky text-muted" title="<?php echo esc_attr__( 'Sticky Post', 'wp-bootstrap-4' ); ?>"></span>
		<?php endif; ?>
		
		<header class="entry-header">
		
			<?php
		
			//СТАВИТ Н2 ИЛИ Н1 В ЗАВИСИМОСТИ ОТ ТОГО СТРАНИЦА ЛИ ЭТО ЗАПИСИЕЙ			
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title card-title h2">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title card-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-dark">', '</a></h2>' );
			endif;
		
			//дОБАВЛЯЕТ ДАТУ ПОСТА,ЕСЛИ ЭТО ПОСТ
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta text-muted">
				<?php wp_bootstrap_4_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<?php wp_bootstrap_4_post_thumbnail(); ?>	
	
		<div class="entry-footer card-footer text-muted">
	
		<p> Страна Производитель:
			<?php  				
				$post_id = get_the_ID();
				$terms = get_the_terms( $post_id, 'country' );
				if(!empty($terms))
				{
					foreach($terms as $term)
					echo'<a href="' .esc_url(get_term_link($term, $term->taxonomy)).'" class="terms">'.$term->name.'</a>';
				}
			?>
		</p>
		<p> Актёры:
			<?php  
					
				$post_id = get_the_ID();
				$terms = get_the_terms( $post_id, 'actor' );				
				if(!empty($terms))
				{
				    foreach($terms as $term)
					echo'<a href="' . esc_url(get_term_link($term, $term->taxonomy)).'" class="terms">'.$term->name.'</a>';
				}
			?>
		</p>
		<p> Жанры:
			<?php  
					
				$post_id = get_the_ID();
				$terms = get_the_terms( $post_id, 'genre' );
				if(!empty($terms))
				{
				    foreach($terms as $term)
					echo'<a href="' . esc_url(get_term_link($term, $term->taxonomy)).'" class="terms">'.$term->name.'</a>';
				}
			?>
		</p>
		
		<p>Стоимость:
			<?php 
				$value =  CFS()->get( 'Price');	
				if( $value ) {
					echo'<span >'.$value.'$</span>';				
				}
			?>	
		</p>
				<p>Дата Премьеры:
			<?php 
				$value =  CFS()->get( 'Дата выхода');	
				if( $value ) {
					echo'<span >'.$value.'</span>';				
				}
			?>	
		</p>
						

		</div><!-- .entry-footer -->
		
		
		
		
		
		
		
		<?//НЕ ПОНЯТНО НО ПОКА НИНАЧТО НЕ ПОВЛИЯЛО?>
		<?php if( is_singular() || get_theme_mod( 'default_blog_display', 'excerpt' ) === 'full' ) : ?>
			<div class="entry-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-bootstrap-4' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-4' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php else : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
				<div class="">
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Читать Далее', 'wp-bootstrap-4' ); ?> <small class="oi oi-chevron-right ml-1"></small></a>
				</div>
			</div><!-- .entry-summary -->
		<?php endif; ?>

	</div>
	<!-- /.card-body -->

	<? //ДОБАВЯЛЕТ ВОЗМОЖНОСТЬ РЕДАКТИРОВАНИЯ МОЖНО УБРАТЬ ПОЗЖЕ?>
	<?php if ( 'post' === get_post_type() ) : ?>
		<footer class="entry-footer card-footer text-muted">
			<?php wp_bootstrap_4_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
