<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Footer_Section extends \Elementor\Widget_Base {

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
		return 'footer-section';
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
		return __( 'Footer Section', 'plugin-name' );
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
			'content_section_footer_content',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'footer_bg', [
				'label' => __( 'Footer Background Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );

		$this->add_control(
			'footer_top_section_selector', [
				'label' => __( 'Section Selector', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => 'Cta With Image',
					'2' => 'Cta Without Image',
					'3' => 'Newsletter'
				],
				'label_block' => true,
			]
        );

		$this->add_control(
			'cta_thumbnail', [
				'label' => __( 'Cta Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );
        
        
		$this->add_control(
			'cta_title', [
				'label' => __( 'Cta Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        
		$this->add_control(
			'cta_desc', [
				'label' => __( 'Cta Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );
        
		$this->add_control(
			'cta_btn_label', [
				'label' => __( 'Cta Button Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        
		$this->add_control(
			'cta_btn_url', [
				'label' => __( 'Cta Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
			]
		);
        
		$this->add_control(
			'first_footer_box', [
				'label' => __( 'First Footer Box', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);
        
		$this->add_control(
			'second_footer_box', [
				'label' => __( 'Second Footer Box', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
        
		$this->add_control(
			'copyright_text', [
				'label' => __( 'Copyright Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
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

        <footer class="site-footer-section" style="background-image:url(<?php echo $settings['footer_bg']['url']; ?>);">
			<?php if($settings['footer_top_section_selector'] == '1') : ?>
            <div class="cta-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="cta-thumbnail">
                                <img src="<?php echo $settings['cta_thumbnail']['url']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 my-auto col-md-6">
                            <div class="cta-content">
                                <h3><?php echo $settings['cta_title']; ?></h3>
                                <p><?php echo $settings['cta_desc']; ?></p>
                                <a href="<?php echo $settings['cta_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $settings['cta_btn_label']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php elseif($settings['footer_top_section_selector'] == '2') : ?>
			<div class="cta-section cta-without-thumbnail">
                <div class="container">
					<img class="quarter-circle-left" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/left-quarter-circle.png" alt="">
					<img class="quarter-circle-right" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/right-quarter-circle.png" alt="">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-10 col-md-10 text-center">
                            <div class="cta-content">
                                <h3><?php echo $settings['cta_title']; ?></h3>
                                <p><?php echo $settings['cta_desc']; ?></p>
                                <a href="<?php echo $settings['cta_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $settings['cta_btn_label']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php elseif($settings['footer_top_section_selector'] == '3') : ?>
			<h2>Newsletter</h2>
			<?php endif; ?>


            <div class="footer-section-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="footer-box">
                                <img class="footer-logo" src="<?php echo $settings['first_footer_box']['url']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="footer-box">
                                <?php echo $settings['second_footer_box']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="copyright-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="copyright-text">
                                <p><?php echo $settings['copyright_text']; ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 text-right">
                            <div class="back-to-top">
                                <a href="#top_scroll">Back To Top <i class="fas fa-angle-up"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

<?php

	}

}