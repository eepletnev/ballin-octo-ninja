<?php

/*
Template Name: ballin-ninja
*/


query_posts( 'posts_per_page=8' );


      $month = [];
$monthAndDay = [];


while ( have_posts() ) : the_post();
		array_push($month, get_the_time('M'));
		array_push($monthAndDay, array(get_the_time('M'), get_the_time('d')));
endwhile;

$month = array_unique($month);



	foreach ($month as $key => $val) {
		echo $val . ": ";

		foreach ($monthAndDay as $value) {
			if ($val == $value[0]) echo $value[1] . " ";
		}

	}
wp_reset_query();
?>