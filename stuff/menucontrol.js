/**
* Nav Bar Functions
* 2012-04-18 PC
* Last updated 2013-07-13
* 
* Adapted from MindShift (Argo Network). Works with jquery.hoverIntent.js
* 
* The footer nav works slightly differently from the header nav: the current section's secondary panel is 
* visible by default. To do this, we use these classes:
* "selected" = menu button with hover; current section's default state
* "current" = current section's fallback when other menu items have hover - to help differentiate
* Applying "selected" to any button with hover allows us to check using JS when the user has left the nav completely.
* 
*/


//
// KIP-26: Touch device detection.
// http://stackoverflow.com/questions/4817029/whats-the-best-way-to-detect-a-touch-screen-device-using-javascript#4819886
//

function is_touch_device() {
  return !!('ontouchstart' in window) 
      || !!('onmsgesturechange' in window); // For IE10
};


//
// Nav hover functions
//

function navButtonOver(){
//	jQuery(this).not('#kqed-footer .current').siblings('.current').removeClass('selected');
    jQuery(this).find('.secdv').stop().fadeTo('fast', 1).show();
	jQuery(this).addClass('selected');
}

function navButtonOut(){ 
	//alert('out');
    jQuery(this).find('.secdv').stop();
	jQuery(this).removeClass('selected');
	/* In footer, if it's not the current section, hide panel. */
    jQuery(this).find('.secdv').fadeTo('fast', 0, function() {
        jQuery(this).hide();
    });
	/* In footer, if we've left the nav completely, re-highlight the current section. */
//	if(jQuery('#kqed-footer .selected').length == 0){
//		jQuery('#kqed-footer .current').addClass('selected');
//	}
}


//
// HoverIntent config
//

var config = {    
    sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)    
    interval: 25, // number = milliseconds for onMouseOver polling interval    
    over: navButtonOver, // function = onMouseOver callback (REQUIRED)    
    timeout: 100, // number = milliseconds delay before onMouseOut    
    out: navButtonOut // function = onMouseOut callback (REQUIRED)    
};


//
// Initialize navs
//

jQuery(document).ready(function($){
//alert("ready");
	$(".menudv .secdv").css({'opacity':'0'}); /* Hide all secondary panels */
	$(".menudv > ul > li").hoverIntent(config); /* Activate HoverIntent config */

	// KIP-26: If touch device, display "close" button in secondary panels.
	if (is_touch_device()) {
//	alert("ss");
		$('.menudv').addClass('touch');
	}

	// "Close" link for secondary panels
	$('.secdv .bu-close').click(function() {
		$(this).parent().stop();
		$(this).parent().parent().removeClass('selected');
		$(this).parent().hide();
		// $(this).parent().fadeTo('fast', 0, function() {
        	// this.hide();
    	// });
		return false;
	});
});



