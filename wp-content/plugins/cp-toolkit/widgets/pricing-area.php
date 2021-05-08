<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class pricing_area_Widget extends \Elementor\Widget_Base {

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
		return 'pricing-table';
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
		return __( 'Cp Pricing Table', 'plugin-name' );
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
			'pricing_area_content',
			[
				'label' => __( 'Pricing Area Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		 

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pricing_title', [
				'label' => __( 'Pricing Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Basic' , 'plugin-domain' ),
				'label_block' => true,
			]
		); 
		$repeater->add_control(
			'pricing_ammount', [
				'label' => __( 'Pricing Ammount', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '24' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_sub_title', [
				'label' => __( 'Pricing Ammount sub title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '/M' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'pricing_list', [
				'label' => __( 'Pricing list Content', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG, 
				'show_label' => true,
			]
		);

		$repeater->add_control(
			'btn_lebel',
			[
				'label' => __( 'Btn lebel', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Try It Free',
				'label_block' => true, 
			]
		);
		$repeater->add_control(
			'btn_links',
			[
				'label' => __( 'Btn Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __( 'Why List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(), 
				'title_field' => '{{{ pricing_title }}}',
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
		$list = $this->get_settings('list'); 
?>
  <section class="cp-pricing-area">
  	<div class="container-fluid">
  		<div class="row">

  			<?php $count = 0; foreach ($list as $key => $pricinglist): 
  					$target = $pricinglist['btn_links']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $pricinglist['btn_links']['nofollow'] ? ' rel="nofollow"' : '';
					$count ++;
  				?>
  				<div class="col-lg-3 col-md-6 col-sm-6">
	  				<div class="cp-single-pricing-list cp-single-pricing-list-count-<?php echo $count ?> position-relative  text-center">
	  					<div class="cp-pricing-title">
	  						<h1><?php echo $pricinglist['pricing_title'] ?></h1>
	  					</div>
	  					<div class="cp-pricing-ammount">
	  						<h1>$<?php echo $pricinglist['pricing_ammount'] ?> <span><?php echo $pricinglist['pricing_sub_title'] ?></span></h1>
	  					</div>
	  					<div class="cp-pricing-body">
	  						<?php echo $pricinglist['pricing_list'] ?>
	  					</div>
	  					<div class="cp-pricing-btn">
	  						<a <?php echo $target ?> <?php echo $nofollow ?> href="<?php echo $pricinglist['btn_links']['url'] ?>" class="pricng-btn"><?php echo $pricinglist['btn_lebel'] ?></a>
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