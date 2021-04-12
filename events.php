<?php
/**
*Template Name: Events Page
*/
get_header(); ?>

<div class="container" style="padding-top:60px;">
    <div class="row">
<?php $args = array(
        'post_type' => 'events',
		 'post_status' => 'publish',
         'order' => 'ASC',
         'orderby' => 'meta_value',
        'meta_query' => array(
            array(
            'key' => 'event_date',
            'compare' => '>=',
			'value' =>date('Ymd'),
            )
        ),
        'meta_key' => 'event_date',
		'meta_type' => 'DATE'
    );
    $cat = '';
	$event = new WP_Query( $args );
    if($event->have_posts() ) : while ( $event->have_posts() ) : $event->the_post();
		$cat = get_the_category(); 
        if ($cat) { $cat = $cat[0]->cat_name;
        }
    ?>

<div class = "col-md-4 col-sm-6 col-12" style="display: flex; margin-bottom: 20px;">
        <div class = "event_preview"  onclick="location.href='<?php the_permalink() ?>'">
        <div class="event_image" style="background-image:url(<?php the_field('event_image'); ?>);"></div>
<div class="info_wraper">
          <h2 class="event_title"><?php the_title() ?></h2>
          <div class="date-time-wraper">
          <i class="fas fa-calendar-day"></i><p class="event_date"><?php the_field('event_date'); ?></p>
          <i class="fas fa-clock"></i><p class="event_time"><?php the_field('event_time') ?></p></div>
          <div class="location-wraper"><i class="fas fa-map-marker-alt"></i><p class="location"><?php the_field('location') ?></p></div>
		  <div class="<?php echo $cat; ?>"><?php echo $cat; ?></div>
    </div>
        </div>
      </div>
	
    <?php endwhile; ?>
  <?php endif; ?>
		
</div>
</div>


<?php get_footer(); ?>