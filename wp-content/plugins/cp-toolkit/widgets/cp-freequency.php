<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class freequency_area_Widget extends \Elementor\Widget_Base {

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
		return 'cp-freequency-area';
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
		return __( 'Cp Freequency Area', 'plugin-name' );
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
			'freequency_area_content',
			[
				'label' => __( 'Freequency Area Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'freequency_title', [
				'label' => __( 'Freequency Section title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Frequently Asked Questions' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		 
		$this->add_control(
			'freequency_top_shape', [
				'label' => __( 'Freequency top shape', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA, 
				'label_block' => true,
			]
		);
		$this->add_control(
			'freequency_left_shape', [
				'label' => __( 'Freequency left shape', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA, 
				'label_block' => true,
			]
		);
		 

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'freequency_title_list', [
				'label' => __( 'Freequency Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'How does the free trial work?' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		 

		$repeater->add_control(
			'freequency_content', [
				'label' => __( 'Freequency Content', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG, 
				'show_label' => true,
			]
		); 

		$this->add_control(
			'list',
			[
				'label' => __( 'Freequency List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(), 
				'title_field' => '{{{ freequency_title }}}',
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

		$freequency_title = $this->get_settings('freequency_title'); 
		$freequency_title = $this->get_settings('freequency_title'); 
		$freequency_top_shape = $this->get_settings('freequency_top_shape'); 
		$freequency_left_shape = $this->get_settings('freequency_left_shape'); 

		$list = $this->get_settings('list'); 
?>

	<script>
		;(function($){
			$(document).ready(function(){
				$(".freequency-asked-area .card:first-child").addClass('active');
				$(".freequency-asked-area .card").on('click',function(){
					$(".freequency-asked-area .card").removeClass('active');
					$(this).addClass('active');
				})
			})
		}(jQuery));
	</script>

  <section class="freequency-asked-area">
  	<div class="freequency-asked-area-top-shape"><img src="<?php echo $freequency_top_shape['url'] ?>" alt=""></div>
  	<div class="container">
  		<div class="row">
  			<div class="col-lg-12">
  				<div class="freequency-asked-question-inner-content">
  					<h1 class="freequency-title"><?php echo $freequency_title ?></h1>
  					<div class="accordion" id="accordionExample">

					<?php 
					$count = 0; 
					foreach ($list as $key => $frlist): 
					$count++ 
					?>
					  <div class="card">
					    <div class="card-header" id="heading<?php echo $count ?>">
					      <h2 class="mb-0">
					        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $count ?>" aria-expanded="<?php if ($count == 1): ?>true <?php else: ?>false <?php endif ;?>" aria-controls="collapse<?php echo $count ?>">
					          <span><?php echo $count ?>.</span><?php echo $frlist['freequency_title_list'] ?>
					          <i class="fas fa-minus"></i>
                            	<i class="fas fa-plus"></i>
					        </button>
					      </h2>
					    </div>
					    <div id="collapse<?php echo $count ?>" class=" <?php if ($count == 1): ?>collapse show <?php else: ?>collapse <?php endif ;?> " aria-labelledby="headingOne" data-parent="#accordionExample">
					      <div class="card-body">
					        <?php echo $frlist['freequency_content'] ?>
					      </div>
					    </div>
					  </div>
				<?php endforeach ?>





					</div>

  				</div>
  			</div>
  		</div>
  	</div>
  	<div class="freequency-asked-area-left-shape"><img src="<?php echo $freequency_left_shape['url'] ?>" alt=""></div>
  </section>      
<?php

	}

}