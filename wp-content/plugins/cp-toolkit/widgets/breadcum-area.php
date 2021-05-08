<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class cp_breadcum_area_Widget extends \Elementor\Widget_Base {

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
		return 'cp-breadcum-area';
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
		return __( 'Cp breadcum area', 'plugin-name' );
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
			'breadcum_area_content',
			[
				'label' => __( 'Bredcum Area Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
 

		$this->add_control(
			'cp_breadcum_bg', [
				'label' => __( 'Breadcum area bg', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA, 
				'label_block' => true,
			]
		);


		$this->add_control(
			'cp_breadcum_title', [
				'label' => __( 'Breadcum Big Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Simple & Flexible Pricing' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'cp_breadcum_description', [
				'label' => __( 'Breadcum Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'From small businesses to large enterprises: we cover it all.' , 'plugin-domain' ),
				'label_block' => true,
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
		$cp_breadcum_bg = $this->get_settings('cp_breadcum_bg'); 
		$cp_breadcum_title = $this->get_settings('cp_breadcum_title'); 
		$cp_breadcum_description = $this->get_settings('cp_breadcum_description'); 
?>
  <section class="cp-breadcum-area" style="background-image: url(<?php echo $cp_breadcum_bg['url'] ?>)">
  	<div class="container">
  		<div class="row">
  			<div class="col-lg-12">
  				<div class="cp-breadcum-inner-content text-center">
  					<h1><?php echo $cp_breadcum_title ?></h1>
  					<p><?php echo $cp_breadcum_description ?></p>
  				</div>
  			</div>
  		</div>
  	</div>
  </section>      
<?php

	}

}