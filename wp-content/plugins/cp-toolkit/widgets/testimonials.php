<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Testimonials_Section extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'testimonials';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonials', 'plugin-name' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'creative-peoples' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section_testimonials',
			[
				'label' => __( 'Testimonials Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'testimonial_section_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
    
		$this->add_control(
			'testimonial_section_thumbnail',
			[
				'label' => __( 'Section Thumbnail', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'testimonial_btn_label',
			[
				'label' => __( 'Button Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'testimonial_btn_url',
			[
				'label' => __( 'Button Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'testimonial_ratings', [
				'label' => __( 'Ratings', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => '1 star',
                    '2' => '2 star',
                    '3' => '3 star',
                    '4' => '4 star',
                    '5' => '5 star'
                ],
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'testimonial_body', [
				'label' => __( 'Body', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'testimonial_avatar', [
				'label' => __( 'Avatar', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'testimonial_name', [
				'label' => __( 'Name', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'testimonial_designation', [
				'label' => __( 'Designation', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'testimonial_works', [
				'label' => __( 'Working Place', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$this->add_control(
			'testimonial_sliders',
			[
				'label' => __( 'Testimonial Sliders', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ testimonial_name }}}',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

?>

        <script>
            ;(function($){
                $(document).ready(function(){
                    $(".testimonial-sliders").slick({
                        slidesToScroll: 1,
                        slidedToShow: 1,
                        infinite: true,
                        autoplay: false,
                        prevArrow: $('.test-prev'),
                        nextArrow: $('.test-next')
                    });
                });
            }(jQuery));
        </script>

        <section class="testimonial-section">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape-wave-left.png" alt="" class="shape_wave_left">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="testimonia-section-thumbnail">
							<h2 class="mobile-tst-title"><?php echo $settings['testimonial_section_title']; ?></h2>
                            <img src="<?php echo $settings['testimonial_section_thumbnail']['url']; ?>" alt="">
                            <div class="testimonial-arrows">
                                <span class="test-prev"><i class="fas fa-arrow-left"></i></span>
                                <span class="test-next"><i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="testimonial-content-wrapper">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bactaria.png" alt="" class="shape-bactaria">
                            <div class="testimonial-content">
                                <h2 class="desktop-tst-title"><?php echo $settings['testimonial_section_title']; ?></h2>
                                <div class="testimonial-sliders">
                                    <?php  
                                    foreach($settings['testimonial_sliders'] as $single_testimonial_item) :
                                    ?>
                                    <div class="single-testimonial-slide">
                                        <ul class="testimonial-ratings">
                                            <?php echo str_repeat('<li><i class="fas fa-star"></i></li>',$single_testimonial_item['testimonial_ratings']) ?>
                                        </ul>
                                        <p><?php echo $single_testimonial_item['testimonial_body']; ?></p>
                                        <div class="testimonial-author-meta">
                                            <img src="<?php echo $single_testimonial_item['testimonial_avatar']['url']; ?>" alt="">
                                            <div class="testimonial-author-details">
                                                <h3 class="test-name"><?php echo $single_testimonial_item['testimonial_name']; ?></h3>
                                                <p class="test-role"><?php echo $single_testimonial_item['testimonial_designation']; ?></p>
                                                <p class="works"><?php echo $single_testimonial_item['testimonial_works']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-btn">
                            <a href="<?php echo $settings['testimonial_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $settings['testimonial_btn_label']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

<?php

	}

}