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
$divCount = 0;

query_posts( 'posts_per_page=-1');
$totalBlocksToShow = 10;



while ( have_posts() ) : the_post();
		array_push($month, get_the_time('M'));
		array_push($monthAndDay, array(get_the_time('M'), get_the_time('d')));
endwhile;

$month = array_unique($month);
$monthAndDay = multi_unique($monthAndDay);
$monthAndDay = array_slice($monthAndDay, 0, $totalBlocksToShow);

	foreach ($month as $val) {
		$stringToShow = '';
		$flag = false;
		foreach ($monthAndDay as $value) {
			if ($val == $value[0]) {
			$stringToShow .= $value[1] . " ";
			$flag = true;
			}
		}
		if ($flag) echo $val . ": " . $stringToShow; 
	}

$onePost  = [];
$allPosts = [];

while ( have_posts() ) : the_post();

$onePost['title']   = get_the_title();
$onePost['content'] = get_the_content();
$onePost['date'] = array('day'   => get_the_date('d'), 
						 'month' => get_the_date('m'),
						 'year'  => get_the_date('Y'));
$onePost['excerpt'] = get_the_excerpt();
$image_id = get_post_thumbnail_id(); 
$image_url = wp_get_attachment_image_src($image_id,array(320,250), true);  
$onePost['thumb'] = $image_url[0];
array_push($allPosts, $onePost);
endwhile;



wp_reset_query();
$divCount = 0;
for ($i=0; $i < (count($allPosts)); $i++) {		
if ($divCount == $totalBlocksToShow) break;					
	$similarDate = []; 														
	array_push($similarDate, $allPosts[$i]);

	for ($j=$i+1; $j < (count($allPosts)); $j++) { 						
	$tmp = 0;
			if ($allPosts[$i]['date'] == $allPosts[$j]['date']){
				array_push($similarDate, $allPosts[$j]);
				$tmp++;
			}
	$i += $tmp;
	}
    $divCount++;
?>






<!-- Вывод блоков -->


<br>
<div style='border:1px solid black;' class='div-<?php echo $divCount; ?>'>
<?php	foreach ($similarDate as $post) { ?>


			<br>
			<b> <?php echo $post['title']; ?> </b>
			<br>
			<i> <?php echo $post['excerpt']; ?> </i>
			<br>
			<i> <?php echo $post['date']['day'] . '.' . $post['date']['month'] . '.' . $post['date']['year']; ?> </i>
			<br>
			<img src='<?php echo $post['thumb']; ?>' alt="A picture supposed to be here... ">

<?php   } ?>

	</div>


<?php } ?>