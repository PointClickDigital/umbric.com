<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Checklist_featrued extends \Elementor\Widget_Base {

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
		return 'checklist-featured';
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
		return __( 'Checklist Featured', 'plugin-name' );
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
			'content_section_checklist_feeatured',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'cehcklist_featured_thumbnail',
			[
				'label' => __( 'Checklist Featured Thumbnail', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'checklist_featured_title',
			[
				'label' => __( 'Checklist Featured Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        
        $this->add_control(
			'checklist_featured_description',
			[
				'label' => __( 'Checklist Featured Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );
        
        
        $this->add_control(
			'checklist_featured_btn_label',
			[
				'label' => __( 'Checklist Featured Button Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
        
        $this->add_control(
			'checklist_featured_btn_url',
			[
				'label' => __( 'Checklist Featured Button Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'featured_first_check_title',
			[
				'label' => __( 'First Checkbox Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'featured_first_check_list',
			[
				'label' => __( 'First Checkboxes', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'featured_second_check_title',
			[
				'label' => __( 'Second Checkbox Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'featured_second_check_list',
			[
				'label' => __( 'Second Checkboxes', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true
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

        <section class="check-list-featured">
			<img class="half-circle-left" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/half-circle-left.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 my-auto order-xl-1 order-lg-1 order-md-1 order-last">
                        <div class="cehck-list-featured-content">
                            <h2><?php echo $settings['checklist_featured_title']; ?></h2>
                            <p><?php echo $settings['checklist_featured_description']; ?></p>
                            <a href="<?php echo $settings['checklist_featured_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $settings['checklist_featured_btn_label']; ?></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 order-xl-2 order-lg-2 order-md-2 order-first">
                        <div class="checklist-featured-thumbnail">
                            <img src="<?php echo $settings['cehcklist_featured_thumbnail']['url']; ?>" alt="">
                        </div>
                    </div>
                </div>

                <div class="row check-list-box-row">
                    <div class="col-xl-5 col-lg-5 col-md-5 my-auto">
                        <div class="featured-checkbox-card">
                            <h3><?php echo $settings['featured_first_check_title']; ?></h3>
                            <div class="featured-checkes">
                                <?php echo $settings['featured_first_check_list']; ?>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-2 col-lg-2 col-md-2 text-center my-auto">
						<div class="devider-image">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/devider.png" alt="">
						</div>
					</div>
                    <div class="col-xl-5 col-lg-5 col-md-5 my-auto">
                        <div class="featured-checkbox-card">
                            <h3><?php echo $settings['featured_second_check_title']; ?></h3>
                            <div class="featured-checkes">
                                <?php echo $settings['featured_second_check_list']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php

	}

}