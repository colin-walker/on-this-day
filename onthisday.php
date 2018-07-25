// get posts

$args = array('orderby'=>'date','order'=>'ASC','posts_per_page'=>1);
$oldestpost = get_posts($args);
$oldestyear = mysql2date('Y',$oldestpost[0]->post_date);

$count = $oldestyear;
$first = true;

while ($count < $today["year"]) {

  $dayargs = array(
    'year'=>$count,
    'monthnum'=>$today["mon"],
    'day'=>date('d'),
    'order'=>'ASC',
    'posts_per_page'=>-1
  );

  $day_query = new WP_Query($dayargs);

  if ( $day_query->have_posts() ) :
	if ($first) {
		echo '<strong>On this day...</strong><br/><strong>'.$count.'</strong><br/>';
    while ( $day_query->have_posts() ) : $day_query->the_post(); ?>
        # <a href="<?php the_permalink(); ?>" class="directory-link"><?php the_title() ?></a><br/> <?php

    endwhile;

    wp_reset_query();
  endif;
  $count += 1;
}
