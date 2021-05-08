<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Sales_Directory extends \Elementor\Widget_Base {

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
		return 'sales-directory';
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
		return __( 'Sales Directory', 'plugin-name' );
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
			'content_section_sales_directory',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'sd_section_bg',
			[
				'label' => __( 'Section Background Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'sd_section_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'sd_section_btn_label',
			[
				'label' => __( 'Button Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'sd_section_btn_url',
			[
				'label' => __( 'Button Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
		);
        

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'sd_box_icon', [
				'label' => __( 'Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'sd_box_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'sd_box_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'sd_boxes',
			[
				'label' => __( 'Sales Directory Boxes', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ sd_box_title }}}',
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

        <section class="sd-section" style="background-image:url(<?php echo $settings['sd_section_bg']['url'];?>);">
			<img class="halt-circle-left" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/half-circle-left.png" alt="">
			<img class="stroke-circle" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/stroke-circle.png" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title">
                            <h3><?php echo $settings['sd_section_title']; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php foreach($settings['sd_boxes'] as $single_sd_box) : ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="single-sd-box">
							<div class="single-sd-box-inner">
								<div class="sd-icon-table">
									<div class="sd-icon-tablecell">
										<img src="<?php echo $single_sd_box['sd_box_icon']['url']; ?>" alt="">
									</div>
								</div>
								<div class="sd-box-text">
									<h3><?php echo $single_sd_box['sd_box_title']; ?></h3>
									<p><?php echo $single_sd_box['sd_box_desc']; ?></p>
								</div>
							</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-button-wrapper">
							<a href="<?php echo $settings['sd_section_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $settings['sd_section_btn_label']; ?></a>
						</div>
					</div>
				</div>
            </div>
        </section>

<?php

	}

}