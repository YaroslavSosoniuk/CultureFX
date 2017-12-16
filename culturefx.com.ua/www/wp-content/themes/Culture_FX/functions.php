<?php
/**
 * @package WordPress
 * @subpackage clean
 */
register_nav_menus( array( // Регистрируем 2 меню
	'top' => 'Верхнее меню',
	'left' => 'Нижнее'
) );
add_theme_support('post-thumbnails'); // Включаем поддержку миниатюр
set_post_thumbnail_size(254, 190); // Задаем размеры миниатюре

if ( function_exists('register_sidebar') )
register_sidebar(); // Регистрируем сайдбар

?>
<?php
add_action('admin_menu', function(){
	add_menu_page( 'Create your registration form', 'Admin reg form', 'read', 'reg-form', 'add_my_setting', '', 4 ); 
} );
function my_admin_head() {
    // Custom Style
    echo '<link rel="stylesheet" href="/wp-content/themes/Culture_FX/admin-panel/style_adm.css" type="text/css" />';
	echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="/wp-content/themes/Culture_FX/admin-panel/js_adm.js"></script>';
}
add_action('admin_head', 'my_admin_head');
// функция отвечает за вывод страницы настроек
// подробнее смотрите API Настроек: http://wp-kama.ru/id_3773/api-optsiy-nastroek.html
function add_my_setting(){
	$user_ID = get_current_user_id();
	$feedback = get_user_meta( $user_ID, 'feedback', true );
	?>
	<div id="feedback"><?php echo $feedback; update_user_meta($user_ID, 'feedback', ' '); ?></div>
	<div class="wrap" id="form_reg_panel">
		<div id="sidebar_admin">
			<div id="admin_title"><img src="/wp-content/uploads/2017/11/600_435691150.png"><p>Admin panel</p></div>
			<div id="admin_groups"><p>Your groups</p></div>
		</div>
		<div id="main_part">
		<?php
			include ('admin-panel/table_groups.php');
		?>
		</div>
	</div>
	<?php

}
add_filter('user_contactmethods', 'my_user_contactmethods');
function my_user_contactmethods($user_contactmethods){

  $user_contactmethods['feedback'] = 'Feedback';

  return $user_contactmethods;
}