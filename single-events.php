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

<div class="row">
    <div id="mc_embed_signup">
        <form action="https://pelargosquartet.us1.list-manage.com/subscribe/post?u=4387b84fbb2ea8c9a666c6506&amp;id=4f6aebfa83" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
            <label for="mce-EMAIL">Subscribe</label>
            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4387b84fbb2ea8c9a666c6506_4f6aebfa83" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
    </div>
</div>

<!--End mc_embed_signup—>
<?php get_footer(); ?>