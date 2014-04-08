<?php

/*
Template Name: ballin-ninja
*/

 function multi_unique($array) {
        foreach ($array as $k=>$na)
            $new[$k] = serialize($na);
        $uniq = array_unique($new);
        foreach($uniq as $k=>$ser)
            $new1[$k] = unserialize($ser);
        return ($new1);
    }

      $month = [];
$monthAndDay = [];


query_posts( 'posts_per_page=8' );



while ( have_posts() ) : the_post();
		array_push($month, get_the_time('M'));
		array_push($monthAndDay, array(get_the_time('M'), get_the_time('d')));
endwhile;

$month = array_unique($month);

$monthAndDay = multi_unique($monthAndDay);



	foreach ($month as $key => $val) {
		echo $val . ": ";

		foreach ($monthAndDay as $value) {
			if ($val == $value[0]) echo $value[1] . " ";
		}

	}
wp_reset_query();
?>