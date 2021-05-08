<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Hero_Area extends \Elementor\Widget_Base {

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
		return 'hero_area';
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
		return __( 'Hero Area', 'plugin-name' );
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
			'content_section_hero_area',
			[
				'label' => __( 'Hero Area Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hero_bg',
			[
				'label' => __( 'Hero Background Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
		);

		$this->add_control(
			'hero_subheading',
			[
				'label' => __( 'Hero Sub Heading', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);

		$this->add_control(
			'hero_heading',
			[
				'label' => __( 'Hero Heading', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
		$this->add_control(
			'hero_description',
			[
				'label' => __( 'Hero Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );
        
        
		$this->add_control(
			'hero_thumbnail',
			[
				'label' => __( 'Hero Thumbnail', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'hero_btn_one_label',
			[
				'label' => __( 'Hero Button One Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'hero_btn_one_url',
			[
				'label' => __( 'Hero Button One Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'hero_btn_two_label',
			[
				'label' => __( 'Hero Button Two Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'hero_btn_two_url',
			[
				'label' => __( 'Hero Button Two Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
		);

		$this->add_control(
			'hero_extra_classes',
			[
				'label' => __( 'Hero Extra Classes', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
		$this->add_control(
			'left_container_width',
			[
				'label' => __( 'Left Container Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-xl-6 col-lg-6 col-md-6' => '6 Bootstrap Column',
					'col-xl-5 col-lg-5 col-md-5' => '5 Bootstrap Column',
					'col-xl-7 col-lg-7 col-md-7' => '7 Bootstrap Column',
				],
                'label_block' => true
			]
		);
        
		$this->add_control(
			'right_container_width',
			[
				'label' => __( 'Right Container Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-xl-6 col-lg-6 col-md-6' => '6 Bootstrap Column',
					'col-xl-5 col-lg-5 col-md-5' => '5 Bootstrap Column',
					'col-xl-7 col-lg-7 col-md-7' => '7 Bootstrap Column',
				],
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
        <section class="hero-area <?php echo $settings['hero_extra_classes']; ?>" style="background-image:url(<?php echo $settings['hero_bg']['url']; ?>);">
            <div class="container">
                <div class="row">
                    <div class="<?php echo $settings['left_container_width']; ?> my-auto">
                        <div class="hero-content">
                            <?php if($settings['hero_subheading']) : ?>
                            <h3><?php echo $settings['hero_subheading']; ?></h3>
                            <?php endif; ?>
                            <?php if($settings['hero_heading']) : ?>
                            <h1><?php echo $settings['hero_heading']; ?></h1>
                            <?php endif; ?>
                            <?php if($settings['hero_description']) : ?>
                            <p><?php echo $settings['hero_description']; ?></p>
                            <?php endif; ?>
                            <div class="hero-buttons">
                                <?php if($settings['hero_btn_one_label']) : ?>
                                    <a href="<?php echo $settings['hero_btn_one_url']['url']; ?>" class="primary-btn rounded yellow"><?php echo $settings['hero_btn_one_label']; ?></a>
                                <?php endif; ?>
                                <?php if($settings['hero_btn_two_label']) : ?>
                                <a href="<?php echo $settings['hero_btn_two_url']['url']; ?>" class="primary-btn rounded bordered"><?php echo $settings['hero_btn_two_label']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo $settings['right_container_width']; ?> my-auto">
                        <div class="hero-thumbnail">
                            <img src="<?php echo $settings['hero_thumbnail']['url']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php

	}

}