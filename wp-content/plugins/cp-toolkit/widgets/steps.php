<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Steps extends \Elementor\Widget_Base {

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
		return 'steps';
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
		return __( 'Steps', 'plugin-name' );
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
			'content_section_steps',
			[
				'label' => __( 'Steps Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'steps_section_title',
			[
				'label' => __( 'Section Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
			]
        );

		$this->add_control(
			'steps_section_desc',
			[
				'label' => __( 'Steps Section Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true
			]
        );
		

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'step_box_thumbnail', [
				'label' => __( 'Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );

		$repeater->add_control(
			'step_box_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'step_box_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );

		$this->add_control(
			'step_items',
			[
				'label' => __( 'Step Items', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ step_box_title }}}',
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


        <section class="steps">
            <img class="step-fat-round-shape" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/half-fat-circle.png" alt="">
            <img class="step-wave-shape" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape-wave-right.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title">
                            <h2><?php echo $settings['steps_section_title']; ?></h2>
                            <p><?php echo $settings['steps_section_desc']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="step-items">
                            <?php 
                            $i;
                            foreach($settings['step_items'] as $step) :
                            $i++;
                            ?>
                            <?php if($i%2 != 0) : ?>
                            <div class="single-step-item">
                                <div class="row">
									<div class="col-xl-6 col-lg-6 order-lg-2">
                                        <div class="step-thumbnail">
                                            <img src="<?php echo $step['step_box_thumbnail']['url'] ?>" alt="">
                                        </div>
									</div>
									<div class="col-xl-6 col-lg-6 my-auto order-lg-1">
                                        <div class="step-text-content">
                                            <span class="count"><?php printf("0%s", $i); ?></span>
                                            <h3><?php echo $step['step_box_title']; ?></h3>
                                            <p><?php echo $step['step_box_desc']; ?></p>
                                        </div>
									</div>
                                </div>
                            </div>
                            <?php else : ?>
                                <div class="single-step-item right-content">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="step-thumbnail">
                                            <img src="<?php echo $step['step_box_thumbnail']['url'] ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 my-auto">
                                        <div class="step-text-content">
                                            <span class="count"><?php printf("0%s", $i); ?></span>
                                            <h3><?php echo $step['step_box_title']; ?></h3>
                                            <p><?php echo $step['step_box_desc']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php

	}

}