<?php 
	add_filter('show_admin_bar','__return_false');
	add_action('wp_enqueue_scripts', 'Test_Media');
	add_action('init','Create_Post_Film');
	add_action('init','Create_Films_Taxonomy');
	add_action( 'pre_get_posts', 'action_function_name_11' );
	add_shortcode( 'recentfilms', 'RecentFilms' );
	
	function Create_Films_Taxonomy()
	{
		$argsGen=[		
					'labels'=>[
							'name'=>'Жанры',
							'singular_name'=>'Жанры',
							'all_items'=>'Все Жанры',
							'add_new_item'=>'Добавить новый жанр',
							'edit_item'=>'Редактировать жанр',
							'view_item'=>'Отобразить жанр',
							'search_item'=>'Поиск жанра',
							'new_item_name'=>'Not Found',	
							'add_new item'=>'GENRES',
							'update_item'=>'GENRES',
							'menu_name'=>'Жанры'
						],
					'description'=>'',
					'public'=>true,
					'hierarchical'=>false
				];	
		register_taxonomy('genre',array('films'),$argsGen);

		$argsCoun=[		
					'labels'=>[
							'name'=>'Страны',
							'singular_name'=>'Страна',
							'all_items'=>'Все Страны',
							'add_new_item'=>'Добавить новую страну',
							'edit_item'=>'Редактировать страну',
							'view_item'=>'Отобразить страну',
							'search_item'=>'Поиск страны',
							'new_item_name'=>'Not Found',	
							'add_new item'=>'CITIES',
							'update_item'=>'CITIES',
							'menu_name'=>'Страны'
						],
					'description'=>'',
					'public'=>true,
					'hierarchical'=>false
				];	
		
		register_taxonomy('country',array('films'),$argsCoun);
	
		$argsYear=[		
					'labels'=>[
							'name'=>'Годы',
							'singular_name'=>'Год',
							'all_items'=>'Все годы',
							'add_new_item'=>'Добавить новый год',
							'edit_item'=>'Редактировать Год',
							'view_item'=>'Отобразить год',
							'search_item'=>'Поиск года',
							'new_item_name'=>'Not Found',	
							'add_new item'=>'YEARS',
							'update_item'=>'YEARS',
							'menu_name'=>'Годы'
						],
					'description'=>'',
					'public'=>true,
					'hierarchical'=>false
				];		
		register_taxonomy('annum',array('films'),$argsYear);
		
		$argsAct=[		
					'labels'=>[
							'name'=>'Актёр',
							'singular_name'=>'Актёры',
							'all_items'=>'Все Актёры',
							'add_new_item'=>'Добавить нового актёра',
							'edit_item'=>'Редактировать актёра',
							'view_item'=>'Отобразить актёра',
							'search_item'=>'Поиск актёра',
							'new_item_name'=>'Not Found',	
							'add_new item'=>'ACTORS',
							'update_item'=>'ACTORS',
							'menu_name'=>'Актёры'
						],
					'description'=>'',
					'public'=>true,
					'hierarchical'=>false
				];
		register_taxonomy('actor',array('films'),$argsAct);	

	}
	
	function Create_Post_Film()
	{
		$args=[
				'labels'=>
					[
						'name'=>'Фильмы',
						'singular_name'=>'Фильм',
						'add_new'=>'Добавить фильм',
						'add_new_item'=>'Добавить новый фильм',
						'edit_item'=>'Редактировать Фильм',
						'view_item'=>'Отобразить Фильм',
						'search_item'=>'Поиск Фильма',
						'not_found_in_trash'=>'Не найдено',
						'parent_item_colon'=>'',
						'menu_name'=>'Фильмы'						
					],
				'description'=>'',
				'public'=>true,
				'menu_position'=>25,
				'hierarchical'=>false,
				'supports'=>['title','editor','thumbnail','custom-fields'],
				'taxonomies'=>array( 'actor','annum','country','genre'),
				'has_archive'=>true
		];	
		
		register_post_type('films',$args);		
	}

	function RecentFilms( $atts )
	{
		
		$params = shortcode_atts( array( 'num' => 5), $atts );
		$args = array(
						'numberposts' => $params['num'],
						'order'       => 'DESC',
						'post_type'   => 'films',
					);
			$result='<section id="reviews">
					<h4>Киноновинки</h4>
					<div class="reviews-box owl-carousel owl-theme">';
					
							 $posts=get_posts($args);
							foreach($posts as $post)
							{							
							
								$result .='<a class="reviewItem" href="'. get_the_permalink( $post->ID).' ">
									<div class="reviewItem__title">'. $post->post_title.'</div>';	
															
								$result .='<div class="reviewItem__content">'.  get_the_post_thumbnail(  $post->ID, 'thumbnail' ).'</div></a>';	
								
							}
						 wp_reset_postdata();
				$result.='	</div></section>';
		return $result;
	}
	function action_function_name_11( $query ) 
	{
		if( $query->is_home and  is_main_query () )
		{
			 $query->set('post_type', 'films');
			 $query->set('meta_query',  array
				(
									array
									(
											'key' => 'Дата выхода',
											'value' => current_time('Y-m-d'),
											 'compare' => '>',
											'type' => 'DATE'
									)
				));
		}
	}

	function Test_Media()
	{
        //	echo get_template_directory_uri();
		//echo get_stylesheet_directory_uri(). '/assets/css/owl.carousel.min.css';
		wp_enqueue_style('test-owl', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css');
		wp_enqueue_style('test-owl-theme', get_stylesheet_directory_uri() . '/assets/css/owl.theme.default.min.css');
		wp_enqueue_style('child_theme', get_stylesheet_uri().'/style.css');
		wp_enqueue_style('parent_theme', get_template_directory_uri().'/style.css');

		wp_enqueue_script('test-script-jquery', get_stylesheet_directory_uri() . '/assets/js/jquery-3.2.0.min.js');
		wp_enqueue_script('test-script-owl', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js');
		wp_enqueue_script('test-script-main', get_stylesheet_directory_uri() . '/assets/js/script.js');
		
	}
?>