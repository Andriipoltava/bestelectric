<?php

/*------------------------------------*\
	Radiators functions
\*------------------------------------*/

//remove unncessary core code
include "radiators-functions/strip.php";

//woo
include "radiators-functions/woo-mini-cart.php";

include "radiators-functions/helpers.php";
include "radiators-functions/old-functions.php";
include "radiators-functions/wvs-mods.php";

// page functions
include "radiators-functions/page-functions.php";

////svg icons
include "radiators-functions/svg-icons.php";
//
////shortcodes
include "shortcode.php";
//
//
//////wp rocket clach
//include "wp-rocket-exclude_elementor_uploaded_css.php";
//
////wp rocket clach
include "elementor.php";
//


?>