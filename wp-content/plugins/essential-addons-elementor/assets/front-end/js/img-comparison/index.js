
var ImageComparisonHandler = function ($scope, $) {
	var $img_comp = $(".eael-img-comp-container", $scope);
	var $options = {
		default_offset_pct: $img_comp.data("offset") || 0.7,
		orientation: $img_comp.data("orientation") || "horizontal",
		before_label: $img_comp.data("before_label") || "Before",
		after_label: $img_comp.data("after_label") || "After",
		no_overlay: $img_comp.data("overlay") == "yes" ? false : true,
		move_slider_on_hover: $img_comp.data("onhover") == "yes" ? true : false,
		move_with_handle_only: true,
		click_to_move: $img_comp.data("onclick") == "yes" ? true : false
	};

	$img_comp.imagesLoaded().done(function () {
		$img_comp.twentytwenty($options);
	});
};

jQuery(window).on("elementor/frontend/init", function () {
	elementorFrontend.hooks.addAction(
		"frontend/element_ready/eael-image-comparison.default",
		ImageComparisonHandler
	);
});
