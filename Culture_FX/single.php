<?php
/**
 * @package WordPress
 * @subpackage clean
 */
get_header(); // Подключаем хедер?> 
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // Начало цикла ?>
<h1><?php the_title(); // Заголовок ?></h1>
<?php the_content(); // Содержимое страницы ?>
<?php echo 'Рубрики: '; the_category( ' | ' ); // Выводим категории поста ?>
<?php the_tags( 'Тэги: ', ' | ', '' ); // Выводим тэги(метки) поста ?>
<?php endwhile; // Конец цикла ?>
<?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); // Ссылка на предидущий пост?>
<?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); // Ссылка на следующий пост?> 
<?php comments_template( '', true ); // Комментарии ?>
<?php get_sidebar(); // Подключаем сайдбар ?>
<?php get_footer(); // Подключаем футер ?>