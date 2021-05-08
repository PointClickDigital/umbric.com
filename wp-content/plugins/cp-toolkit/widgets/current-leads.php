<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Current_Leads extends \Elementor\Widget_Base {

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
		return 'current-leads';
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
		return __( 'Current Leads', 'plugin-name' );
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
			'content_section_current_leads',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'current_leads_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'current_leads_desc',
			[
				'label' => __( 'Section Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );
        

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'cl_box_icon', [
				'label' => __( 'Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'cl_box_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'cl_box_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'cl_box_btn_label', [
				'label' => __( 'Button Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'cl_box_btn_url', [
				'label' => __( 'Button Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
			]
		);

		$this->add_control(
			'cl_boxes',
			[
				'label' => __( 'Current Leads Boxes', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ cl_box_title }}}',
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

        <section class="current-leads">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/half-circle-right.png" alt="" class="half-circle-right">
			<div class="current-lead-header">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-3">
							<div class="cl-section-title">
								<h3><?php echo $settings['current_leads_title']; ?></h3>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="cl-section-description">
								<?php echo $settings['current_leads_desc']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="current-lead-boxes">
				<div class="container">
					<div class="row justify-content-center">
						<?php foreach($settings['cl_boxes'] as $single_cl_box) : ?>
						<div class="col-xl-4 col-lg-6 col-md-6">
							<div class="single-current-lead-item">
								<div class="current-lead-item-tablecell">								
									<div class="cl-box-icon">
										<div class="cl-box-icon-tablecell">
											<img src="<?php echo $single_cl_box['cl_box_icon']['url']; ?>" alt="">
										</div>
									</div>
									<h3><?php echo $single_cl_box['cl_box_title']; ?></h3>
									<p><?php echo $single_cl_box['cl_box_desc']; ?></p>
									<a href="<?php echo $single_cl_box['cl_box_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $single_cl_box['cl_box_btn_label']; ?></a>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
        </section>

<?php

	}

}