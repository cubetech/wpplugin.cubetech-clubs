jQuery(function() {

	jQuery("#cubetech-clubs-filter-select").change(function () {
		if ( jQuery("#cubetech-clubs-filter-select").val() == 'all' ) {
			jQuery(".cubetech-clubs").fadeIn(500);
		} else {
			jQuery(".cubetech-clubs").filter(":not(.cubetech-clubs-group-" + jQuery("#cubetech-clubs-filter-select").val() + ")").hide();
			jQuery(".cubetech-clubs").filter(".cubetech-clubs-group-" + jQuery("#cubetech-clubs-filter-select").val()).fadeIn(500);
		}
	})
	.change();
	
});