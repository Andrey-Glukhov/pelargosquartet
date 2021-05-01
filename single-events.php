<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="single_title_wraper">
        <h2 class="single_event_title"><?php the_title() ?></h2>
        <div class="date-time-wraper">
            <i class="fas fa-calendar-day"></i>
            <p class="event_date"><?php the_field('event_date'); ?></p>
            <i class="fas fa-clock"></i>
            <p class="event_time"><?php the_field('event_time') ?></p>
        </div>
        <div class="location-wraper"><i class="fas fa-map-marker-alt"></i>
            <p class="location"><?php the_field('location') ?></p>
        </div>
    </div>

<div class="single_event_wrapper">

    <div class="left_wraper">
        <div class="event_image" style="background-image:url(<?php the_field('event_image'); ?>);"></div>
    </div>

    <div class="single_info_wraper">
        <div class="about_single_event"><?php the_content(''); ?></div>
        
        <button class="join_button">JOIN THE EVENT</button>
    </div>
</div>

<?php endwhile; else : ?>
<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>