<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Banner_Widget extends \Elementor\Widget_Base {

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
		return 'banner';
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
		return __( 'Banner', 'plugin-name' );
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
			'content_section_banner',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'banner_bg',
			[
				'label' => __( 'Banner Background Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'banner_title',
			[
				'label' => __( 'Banner Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'banner_description',
			[
				'label' => __( 'Banner Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
		);
        
        $this->add_control(
			'banner_thumbnail',
			[
				'label' => __( 'Banner Thumbnail', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
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
        <section id="top_scroll" class="banner-section" style="background-image:url(<?php echo $settings['banner_bg']['url']; ?>);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="banner-text">
                            <h1><?php echo $settings['banner_title']; ?></h1>
                            <p><?php echo $settings['banner_description']; ?></p>
                            <img src="<?php echo $settings['banner_thumbnail']['url']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php

	}

}