<?php  
/** 
 * Template Name: CreativePeoples Elementor
*/
the_post();
get_header();
?>

<?php
if(is_page(array('lead-fabric','pricing'))) {
?>
    <style>
        span.site-logo-img {
            position: relative;
        }
        .site-logo-img:after {
            background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lead-fabric-logo.png');
            content: "";
            width: 225px!important;
            height: 67px;
            position: absolute;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .site-logo-img:after {
            margin-left: 5px;
        }
    </style>
<?php
} 
?>

<div class="section-creativepeoples-elementor">
    <?php the_content(); ?>
</div>

<?php 
get_footer(); 
?>