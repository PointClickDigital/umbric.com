<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Demos extends \Elementor\Widget_Base {

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
		return 'demos';
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
		return __( 'Demos', 'plugin-name' );
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
			'content_section_demos',
			[
				'label' => __( 'Demos Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'demo_section_bg',
			[
				'label' => __( 'Demo Background Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
        );

		$this->add_control(
			'demo_section_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );

		$this->add_control(
			'demo_section_desc',
			[
				'label' => __( 'Demo Section Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );

		$this->add_control(
			'demo_section_btn_label',
			[
				'label' => __( 'Demo Section Button Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );

		$this->add_control(
			'demo_section_btn_url',
			[
				'label' => __( 'Demo Section Button Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
        );

		

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'demo_box_thumbnail', [
				'label' => __( 'Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'demo_box_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'demo_box_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );

		$this->add_control(
			'demo_boxes',
			[
				'label' => __( 'Demo Boxes', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ demo_box_title }}}',
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


        <section class="demos-section" style="background-image:url(<?php echo $settings['demo_section_bg']['url']; ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 my-auto">
                        <div class="demo-section-title">
                            <h3><?php echo $settings['demo_section_title']; ?></h3>
                            <p><?php echo $settings['demo_section_desc']; ?></p>
                            <a href="<?php echo $settings['demo_section_btn_url']['url']; ?>" class="primary-btn rounded yellow"><?php echo $settings['demo_section_btn_label']; ?></a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9">
                        <div class="row">
                            <?php  
                            foreach($settings['demo_boxes'] as $card) :
                            ?>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-card-item">
                                    <div class="card-icon-wrapper">
                                        <div class="card-icon-inner">
                                            <img src="<?php echo $card['demo_box_thumbnail']['url']; ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h3><?php echo $card['demo_box_title']; ?></h3>
                                        <p><?php echo $card['demo_box_desc']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php

	}

}