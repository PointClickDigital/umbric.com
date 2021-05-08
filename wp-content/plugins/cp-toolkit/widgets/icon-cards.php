<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Icon_Cards extends \Elementor\Widget_Base {

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
		return 'icon_cards';
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
		return __( 'Icon Cards', 'plugin-name' );
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
			'content_section_icon_cards_content',
			[
				'label' => __( 'Icon Cards Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_card_section_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'icon_card_section_desc',
			[
				'label' => __( 'Section Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );
        
		$this->add_control(
			'icon_card_section_btn_label',
			[
				'label' => __( 'Button Label', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
		);
        
		$this->add_control(
			'icon_card_section_btn_url',
			[
				'label' => __( 'Button Url', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
			]
        );
        
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_card_icon', [
				'label' => __( 'Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'icon_card_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'icon_card_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'icon_card_url', [
				'label' => __( 'Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'icon_card_color', [
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'icon_card_boxes',
			[
				'label' => __( 'Icon Card Boxes', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ icon_card_title }}}',
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


        <section class="icon-card-section">
			<img class="fat-cirle-right" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fat-circle-right.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="icon-card-section-title">
                            <?php if($settings['icon_card_section_title']) : ?>
                            <h2><?php echo $settings['icon_card_section_title']; ?></h2>
                            <?php endif; ?>
                            <?php if($settings['icon_card_section_desc']) : ?>
                            <p><?php echo $settings['icon_card_section_desc']; ?></p>
                            <?php endif; ?>
                            <?php if($settings['icon_card_section_btn_label']) : ?>
                            <a href="<?php echo $settings['icon_card_section_btn_url']['url']; ?>" class="primary-btn rounded yellow"><?php echo $settings['icon_card_section_btn_label']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php  
                    foreach($settings['icon_card_boxes'] as $single_icon_card) :
                    ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="single-card-item">
                            <div class="card-icon-wrapper">
                                <div class="card-icon-inner">
                                    <img src="<?php echo $single_icon_card['icon_card_icon']['url']; ?>" alt="">
                                </div>
                            </div>
                            <div class="card-content">
                                <h3><?php echo $single_icon_card['icon_card_title']; ?></h3>
								<p><?php echo $single_icon_card['icon_card_desc']; ?><?php if($single_icon_card['icon_card_url']['url']) : ?><a style="color:<?php echo $single_icon_card				['icon_card_color']; ?>;" href="<?php echo $single_icon_card['icon_card_url']['url']; ?>" class="inline-btn">Learn More</a><?php endif; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

<?php

	}

}