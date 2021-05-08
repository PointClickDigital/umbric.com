<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Featured_Item extends \Elementor\Widget_Base {

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
		return 'featured-item';
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
		return __( 'Featured Item', 'plugin-name' );
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
			'content_section_featured_content',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'featured_thumbnail', [
				'label' => __( 'Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'featured_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'featured_description', [
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'featured_btn_label', [
				'label' => __( 'Button Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'featured_btn_url', [
				'label' => __( 'Button Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
			]
		);

		$this->add_control(
			'featured_items',
			[
				'label' => __( 'Featured Items', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ featured_title }}}',
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

        <section class="featured-items">
			<img class="half-circle-right" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/half-circle-right.png" alt="">
            <?php
            $i = 0;  
            foreach($settings['featured_items'] as $single_featured_item) :
            $i++;
            ?>
            <?php if($i%2 != 0) : ?>
            <div class="single-featured-item">            
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="featured-thumbnail">
                                <img src="<?php echo $single_featured_item['featured_thumbnail']['url']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 my-auto">
                            <div class="featured-content">
                                <h2><?php echo $single_featured_item['featured_title']; ?></h2>
                                <p><?php echo $single_featured_item['featured_description']; ?></p>
                                <a href="<?php echo $single_featured_item['featured_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $single_featured_item['featured_btn_label']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="single-featured-item featured-item-reverse" >            
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 my-auto order-xl-1 order-lg-1 order-md-1 order-sm-2 order-last">
                            <div class="featured-content">
                                <h2><?php echo $single_featured_item['featured_title']; ?></h2>
                                <p><?php echo $single_featured_item['featured_description']; ?></p>
                                <a href="<?php echo $single_featured_item['featured_btn_url']['url']; ?>" class="primary-btn rounded"><?php echo $single_featured_item['featured_btn_label']; ?></a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 order-xl-2 order-lg-2 order-md-2 order-sm-1 order-first">
                            <div class="featured-thumbnail">
                                <img src="<?php echo $single_featured_item['featured_thumbnail']['url']; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </section>

<?php

	}

}