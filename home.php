<?php
require_once('backend/connection_manager.php');
require_once('backend/admin.php');
require_once('backend/header.php');
require_once('backend/utilities.php');

//Getting template content
$DOM = file_get_contents('html/template.html');
////////////
	
//Setting page title
$DOM = str_replace('<title_page_to_insert/>', 'Wolf', $DOM);
////////////

//Setting css
$DOM = str_replace('<stylesheets_to_insert/>', '<link rel="stylesheet" type="text/css" href="<relative_path_to_insert/>styles/style_home.css">', $DOM);
////////////
	
//Setting javascripts
$DOM = str_replace('<scripts_to_insert/>', '<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118544137-1"></script>
	<script src="<relative_path_to_insert/>scripts/google_analytics.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<relative_path_to_insert/>scripts/menu_bar.js" type="text/javascript"></script>
	<script src="<relative_path_to_insert/>scripts/particles.js" type="text/javascript"></script>', $DOM);
////////////

//Changing description of page
$DOM = str_replace('<description_to_insert/>', '<meta name="description" content="We are a group of 3D artists and we make Blender addons">', $DOM);
////////////

//Try to init admin
$errormessage = Admin::init_admin();
////////////

//Getting menubar
$DOM = str_replace('<header_to_insert/>', file_get_contents('html/header.html'), $DOM);
$lis = header_cls::getHeader(basename(__FILE__), Admin::verify());
$DOM = str_replace('<products_li_to_insert/>', $lis, $DOM);
////////////

//Fixing information of menubar such as witch is selected
$DOM = str_replace('<product_path_to_insert/>', '<relative_path_to_insert/>products/', $DOM);
$DOM = str_replace('<home_selected_class_to_insert/>', 'class="selected"', $DOM);
$DOM = str_replace('<products_selected_class_to_insert/>', '', $DOM);
$DOM = str_replace('<info_selected_class_to_insert/>', '', $DOM);
////////////

//Getting page content
if(Admin::verify()){	//IF LOGGED
	$DOM = str_replace('<admin_li_to_insert/>', '<li class="main"><a href="<relative_path_to_insert/>admin_page.php">Admin Page</a></li>', $DOM);	
	$DOM = str_replace('<edit_li_to_insert/>', '<li class="main"><a href="<relative_path_to_insert/>admin/editpage.php?pagename=home.php">Edit</a></li>', $DOM);
	$DOM = str_replace('<logout_li_to_insert/>', '<li class="main"><a href="<relative_path_to_insert/>home.php?logout=true">Logout</a></li>', $DOM);
}else{					//IF NOT
	$DOM = str_replace('<admin_li_to_insert/>', '', $DOM);
	$DOM = str_replace('<edit_li_to_insert/>', '', $DOM);
	$DOM = str_replace('<logout_li_to_insert/>', '', $DOM);
}
////////////

//Getting page content
$DOM = str_replace('<page_to_insert/>', file_get_contents('html/home.html'), $DOM);
////////////

//Setting footer content
$DOM = str_replace('<footer_script_to_insert/>', '<a class="chat" href="javascript:void(Tawk_API.toggle())">
	<i class="fas fa-comment"></i>
	</a>
	<script src="<relative_path_to_insert/>scripts/chat.js" type="text/javascript"></script>', $DOM);
////////////

//Fix RelativePath
$DOM = str_replace('<relative_path_to_insert/>', '', $DOM);
////////////

//Changing file extension for Safari >:-(
if(Utilities::getBrowser() == 'Safari'){	
	$DOM = str_replace('webp', 'png', $DOM);
}
////////////
	
//Print Page
echo($DOM);
////////////
?>