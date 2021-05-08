<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Case_Study extends \Elementor\Widget_Base {

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
		return 'case-study';
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
		return __( 'Case Study', 'plugin-name' );
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
			'content_section_case_study',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'case_study_bg', [
				'label' => __( 'Background Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'case_study_thumbnail', [
				'label' => __( 'Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);
        
		$repeater->add_control(
			'case_study_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'case_study_desc', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'case_study_testimonial', [
				'label' => __( 'Testimonial', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'case_study_btn_label', [
				'label' => __( 'Button Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'case_study_btn_url', [
				'label' => __( 'Button Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'case_study_avatar', [
				'label' => __( 'Avatar', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'case_study_name', [
				'label' => __( 'Name', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
		$repeater->add_control(
			'case_study_designation', [
				'label' => __( 'Designation', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
        
		$this->add_control(
			'case_studies',
			[
				'label' => __( 'Case Study Items', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ case_study_title }}}',
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

                <section class="case-study-section">   
					<img class="step-fat-round-shape" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/half-fat-circle.png" alt="" >     
					<img class="fat-cirle-right" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fat-circle-right.png" alt="">       
                    <?php  
                    $i;
                    foreach($settings['case_studies'] as $case_study) :
                    $i++;
                    ?>
                        <?php if($i%2 != 0) : ?>
                        <div class="single-casestudy-item" style="background-image:url(<?php echo $case_study['case_study_bg']['url']; ?>);">
                            <div class="container">
                                <div class="row">                        
                                    <div class="col-xl-6 col-lg-6 col-md-6 my-auto order-xl-1 order-lg-1 order-md-1 order-sm-2 order-last">
                                        <div class="case-study-content">
                                            <h3><?php echo $case_study['case_study_title']; ?></h3>
                                            <p class="casestudy-description"><?php echo $case_study['case_study_desc']; ?></p>
											<p class="testimonial-casestudy"><?php echo $case_study['case_study_testimonial']; ?></p>
                                            <?php if($case_study['case_study_btn_label']) : ?>
                                            <a href="<?php echo $case_study['case_study_btn_url']['url']; ?>" class="primary-btn yellow rounded"><?php echo $case_study['case_study_btn_label']; ?></a>
                                            <?php endif; ?>
                                            <?php if($case_study['case_study_avatar']['url']) : ?>
                                            <div class="case-study-meta">
                                                <img src="<?php echo $case_study['case_study_avatar']['url']; ?>" alt="">
                                                <div class="case-meta-desc">
                                                    <h4><?php echo $case_study['case_study_name']; ?></h4>
                                                    <p class="case-designation"><?php echo $case_study['case_study_designation']; ?></p>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 order-xl-2 order-lg-2 order-md-2 order-sm-1 order-first">
                                        <div class="case-study-thumbnail">
                                            <img src="<?php echo $case_study['case_study_thumbnail']['url']; ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else : ?>
                            <div class="single-casestudy-item case-study-inverted" style="background-image:url(<?php echo $case_study['case_study_bg']['url']; ?>);">
                            <div class="container">
                                <div class="row">                        
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="case-study-thumbnail">
                                            <img src="<?php echo $case_study['case_study_thumbnail']['url']; ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 my-auto">
                                        <div class="case-study-content">
                                            <h3><?php echo $case_study['case_study_title']; ?></h3>
                                            <p class="casestudy-description"><?php echo $case_study['case_study_desc']; ?></p>
											<p class="testimonial-casestudy"><?php echo $case_study['case_study_testimonial']; ?></p>
                                            <?php if($case_study['case_study_btn_label']) : ?>
                                            <a href="<?php echo $case_study['case_study_btn_url']['url']; ?>" class="primary-btn yellow rounded"><?php echo $case_study['case_study_btn_label']; ?></a>
                                            <?php endif; ?>
                                            <?php if($case_study['case_study_avatar']['url']) : ?>
                                            <div class="case-study-meta">
                                                <img src="<?php echo $case_study['case_study_avatar']['url']; ?>" alt="">
                                                <div class="case-meta-desc">
                                                    <h4><?php echo $case_study['case_study_name']; ?></h4>
                                                    <p class="case-designation"><?php echo $case_study['case_study_designation']; ?></p>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php 
                    endforeach; 
                    ?>
                </section>

<?php

	}

}