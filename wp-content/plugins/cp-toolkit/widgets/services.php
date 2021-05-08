<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Services extends \Elementor\Widget_Base {

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
		return 'services';
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
		return __( 'Services', 'plugin-name' );
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
			'content_section_services',
			[
				'label' => __( 'Icon Cards Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'services_section_bg',
			[
				'label' => __( 'Section Background Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
        );

		$this->add_control(
			'services_section_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'services_section_desc',
			[
				'label' => __( 'Section Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'services_section_btn_label',
			[
				'label' => __( 'Service Button Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'services_section_btn_url',
			[
				'label' => __( 'Service Button Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'service_box_thumbnail', [
				'label' => __( 'Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'service_box_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'service_box_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );

		$this->add_control(
			'service_boxes',
			[
				'label' => __( 'Service Boxes', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ service_box_title }}}',
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


        <section class="service-section" style="background-image:url(<?php echo $settings['services_section_bg']['url']; ?>);">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape-wave-right.png" alt="" class="shape-wave-right">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <div class="section-title">
                            <h2><?php echo $settings['services_section_title']; ?></h2>
                            <p><?php echo $settings['services_section_desc']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach($settings['service_boxes'] as $single_service_box) : ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="single-service-item">
                            <div class="service-icon">
                                <div class="service-icon-inner">
                                    <img src="<?php echo $single_service_box['service_box_thumbnail']['url']; ?>" alt="">
                                </div>
                            </div>
                            <h4><?php echo $single_service_box['service_box_title']; ?></h4>
                            <p><?php echo $single_service_box['service_box_desc']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

				<div class="row">
					<div class="col-xl-12 text-center">
						<div class="section-btn-wrapper">
							<a href="<?php echo $settings['services_section_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $settings['services_section_btn_label']; ?></a>
						</div>
					</div>
				</div>
            </div>
        </section>

<?php

	}

}