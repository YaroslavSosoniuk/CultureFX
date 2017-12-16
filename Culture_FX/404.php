<?php
/**
 * Чистый Шаблон для разработки
 * Это шаблон 404 ошибки, отрабатывает, когда написали фигни в адресную строку
 * @package WordPress
 * @subpackage clean
 */
 /*
 Template Name: 404
 */
get_header(); // Подключаем хедер ?>
<h1 class="attack">Error establishing a database conection</h1>

<?php get_sidebar();  // Подключаем сайдбар ?>
<?php get_footer(); // Подключаем футер ?>
