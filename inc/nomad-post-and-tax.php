<?php
// добавление запсии
add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'trip', array (
		'label'  => null,
		'labels' => array(
			'name'               => 'Путешествия', // основное название для типа записи
			'singular_name'      => 'Путешествие', // название для одной записи этого типа
			'add_new'            => 'Добавить Путешествия', // для добавления новой записи
			'add_new_item'       => 'Добавление Путешествия', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Путешествия', // для редактирования типа записи
			'new_item'           => 'Новое Путешествие', // текст новой записи
			'view_item'          => 'Смотреть Путешествия', // для просмотра записи этого типа.
			'search_items'       => 'Искать Путешествия', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Путешествия', // название меню
	) ,
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor','editor','author','thumbnail','excerpt' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['trip_type'],
		'has_archive'         => 'trip',
		'rewrite'             => array('slug' => 'trip/%trip_type%', 'with_front' => false),
		'query_var'           => true,
	 ) );
}

// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'trip_type', [ 'trip' ], [ 
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Тип путешествия',
			'singular_name'     => 'Тип путешествия',
			'search_items'      => 'Поиск тип путешествия',
			'all_items'         => 'Все типы путешествия',
			'view_item '        => 'Посмотреть тип путешествия',
			'parent_item'       => 'Родительский тип путешествия',
			'parent_item_colon' => 'Родительский тип путешествия:',
			'edit_item'         => 'Редактирвоать тип путешествия',
			'update_item'       => 'Обновить тип путешествия',
			'add_new_item'      => 'Добавить новый  тип путешествия',
			'new_item_name'     => 'Новый тип путешествия Name',
			'menu_name'         => 'тип путешествия',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => true,

		'rewrite'               => array('slug' => 'trip', 'with_front' => false),
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}

add_filter('post_type_link', 'trip_permalink', 1, 2);
function trip_permalink($permalink, $post){
	if (strpos($permalink, '%trip_type%')===false)
	return $permalink;
	$terms = get_the_terms($post, 'trip_type');

	if(! is_wp_error($terms) && !empty($terms)&& is_object($terms[0]))
	$term_slug = array_pop($terms) -> slug;
	else
		$term_slug = 'no-trip_type';
	return str_replace('%trip_type%', $term_slug, $permalink);
}



// add_filter( 'upload_mimes', 'svg_upload_allow' );

// # Добавляет SVG в список разрешенных для загрузки файлов.
// function svg_upload_allow( $mimes ) {
// 	$mimes['svg']  = 'image/plain';

// 	return $mimes;
// }

//загрузка новых типов медиафайлов start
function wph_add_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['pls'] = 'text/playlist';
    return $mimes;
}
add_filter('upload_mimes', 'wph_add_mime_types');
//загрузка новых типов медиафайлов end