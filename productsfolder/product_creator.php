<?php
require_once('../backend/header.php');
require_once('../backend/admin.php');
require_once('../backend/product_infos.php');
require_once('../backend/connection_manager.php');
require_once('../backend/utilities.php');

class product_creator{
	public static function getProductPage($page){
		//Getting all information of a specific product (based on $page url (ex: sky.php))
		$infos = product_infos::getProductInfos($page);
		////////////

		//Getting versions of a specific product (based on $page url (ex: sky.php))
		$versions = product_infos::getProductVersions($page);
		////////////
		
		//Getting footer images of a specific product (based on $page url (ex: sky.php))
		$footer_images = product_infos::getProductFooterImages($page);
		////////////
		
		//Getting template content
		$DOM = file_get_contents('../html/template.html');
		////////////
	
		//Setting page title
		$DOM = str_replace('<title_page_to_insert/>', $infos['pagename'], $DOM);
		////////////
		
		//Setting css
		$DOM = str_replace('<stylesheets_to_insert/>', '<link rel="stylesheet" type="text/css" href="<relative_path_to_insert/>styles/style_all.css">
			<link rel="stylesheet" type="text/css" href="<relative_path_to_insert/>styles/style_color.css">
			<link rel="stylesheet" type="text/css" href="styles/style_common.css">
			<link rel="stylesheet" type="text/css" href="styles/<css_to_insert/>">
			<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">', $DOM);
		////////////
		
		//Setting javascripts
		$DOM = str_replace('<scripts_to_insert/>', '<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118544137-1"></script>
			<script src="<relative_path_to_insert/>scripts/google_analytics.js" type="text/javascript"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="<relative_path_to_insert/>scripts/menu_bar.js" type="text/javascript"></script>', $DOM);
		////////////
		
		//Changing description of page
		$DOM = str_replace('<description_to_insert/>', '', $DOM);
		////////////
		
		//Setting the product css file
		$DOM = str_replace('<css_to_insert/>', $infos['cssfilename'], $DOM);
		////////////
		
		//Try to init admin
		$errormessage = Admin::init_admin();
		////////////

		//Getting menubar
		$DOM = str_replace('<header_to_insert/>', file_get_contents('../html/header.html'), $DOM);
		$lis = header_cls::getHeader($page, Admin::verify());
		$DOM = str_replace('<products_li_to_insert/>', $lis, $DOM);
		////////////

		//Fixing information of menubar such as witch is selected
		$DOM = str_replace('<product_path_to_insert/>', '', $DOM);
		$DOM = str_replace('<home_selected_class_to_insert/>', '', $DOM);
		$DOM = str_replace('<products_selected_class_to_insert/>', 'class="selected"', $DOM);
		$DOM = str_replace('<info_selected_class_to_insert/>', '', $DOM);
		////////////

		//Getting page content
		if(Admin::verify()){	//IF LOGGED
			$DOM = str_replace('<admin_li_to_insert/>', '<li class="main"><a href="<relative_path_to_insert/>admin_page.php">Admin Page</a></li>', $DOM);
			$DOM = str_replace('<edit_li_to_insert/>', '<li class="main"><a href="<relative_path_to_insert/>../admin/edit_product.php?pagename=' . $page . '">Edit</a></li>', $DOM);
			$DOM = str_replace('<logout_li_to_insert/>', '<li class="main"><a href="<relative_path_to_insert/>products/' . $page . '?logout=true">Logout</a></li>', $DOM);
		}else{					//IF NOT
			$DOM = str_replace('<admin_li_to_insert/>', '', $DOM);
			$DOM = str_replace('<edit_li_to_insert/>', '', $DOM);
			$DOM = str_replace('<logout_li_to_insert/>', '', $DOM);
		}
		////////////	
		
		//Getting page content
		if($infos['isactive']==1 || Admin::verify()){
			if($infos['iscomingsoon']==0 || Admin::verify()){
				$DOM = str_replace('<page_to_insert/>', file_get_contents('html_products/product_template.html'), $DOM);

				//Replace strings in product_template
				
				$DOM = str_replace('<product_name_to_insert/>', $infos['productname'], $DOM);
				if($infos['youtubelink']!=''){
					$DOM = str_replace('<video_to_insert/>', '<div class="video">
						<iframe width="560" height="315" src="<youtube_link_to_insert/>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>', $DOM);
					$DOM = str_replace('<youtube_link_to_insert/>', $infos['youtubelink'], $DOM);
				}else{
					$DOM = str_replace('<video_to_insert/>', '', $DOM);
				}
				$DOM = str_replace('<description_to_insert/>', $infos['description'], $DOM);
				
				$isfirst = true;
				if($infos['dlink']!=''){
					$isfirst = false;
					$DOM = str_replace('<download_section_to_insert/>', '<a class="downstart" href="<download_link_to_insert/>" target="_blank"><download_or_buy_to_insert/></a>', $DOM);
					$DOM = str_replace('<download_link_to_insert/>', $infos['dlink'], $DOM);
					$DOM = str_replace('<download_or_buy_to_insert/>', $infos['downloadtype'], $DOM);
				}else{
					$DOM = str_replace('<download_section_to_insert/>', '', $DOM);
				}
				
				if($infos['guidelink']!=''){
					$DOM = str_replace('<guide_section_to_insert/>', '<a class="<download_class_to_insert/>" href="<guide_link_to_insert/>" target="_blank">Guide</a>', $DOM);
					$DOM = str_replace('<guide_link_to_insert/>', $infos['guidelink'], $DOM);
				}else{
					$DOM = str_replace('<guide_section_to_insert/>', '', $DOM);
				}
				if($isfirst){
					$isfirst = false;
					$DOM = str_replace('<download_class_to_insert/>', 'downstart', $DOM);
				}else{
					$DOM = str_replace('<download_class_to_insert/>', '', $DOM);
				}
				
				if(sizeof($versions)>0){
					$DOM = str_replace('<versions_section_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Version</button>
								<div class="collap">
									<versions_to_insert/>
								</div>', $DOM);
					$versionstring = '';
					foreach ($versions as $v){
						$productVersion = $v['version'];	
						$versionstring = $versionstring . '<p>' . $v['version'] . '</p>';
					}
					$DOM = str_replace('<versions_to_insert/>', $versionstring, $DOM);
				}else{
					$DOM = str_replace('<versions_section_to_insert/>', '', $DOM);
				}
				if($isfirst){
					$isfirst = false;
					$DOM = str_replace('<download_class_to_insert/>', 'downstart', $DOM);
				}else{
					$DOM = str_replace('<download_class_to_insert/>', '', $DOM);
				}
				
				
				
				if($infos['info']!=''){
					$DOM = str_replace('<info_section_to_insert/>', '<a class="<download_class_to_insert/>" href="' . $infos['info'] . '" target="_blank">Info</a>', $DOM);
				}else{
					$DOM = str_replace('<info_section_to_insert/>', '', $DOM);
				}
				if($isfirst){
					$isfirst = false;
					$DOM = str_replace('<download_class_to_insert/>', 'downstart', $DOM);
				}else{
					$DOM = str_replace('<download_class_to_insert/>', '', $DOM);
				}
				
				if($infos['changelog']!=''){
					$DOM = str_replace('<changelog_section_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Changelog</button>
					<div class="collap">
						<p><changelog_to_insert/></p>
					</div>', $DOM);
					$DOM = str_replace('<changelog_to_insert/>', $infos['changelog'], $DOM);
				}else{
					$DOM = str_replace('<changelog_section_to_insert/>', '', $DOM);
				}
				if($isfirst){
					$isfirst = false;
					$DOM = str_replace('<download_class_to_insert/>', 'downstart', $DOM);
				}else{
					$DOM = str_replace('<download_class_to_insert/>', '', $DOM);
				}
				
				if($infos['htmlfilename']=='environments.html'){
					$DOM = str_replace('<requirements_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Requirements</button>
						<div class="collap">
							<h2>Minimum</h2>
							<p>- 16GB of RAM</p>
							<p>- medium end CPU</p>
							<h2>Recommended</h2>
							<p>- 32GB of RAM</p>
							<p>- high end CPU</p>
						</div>', $DOM);
					
				}else if($infos['htmlfilename']=='grass.html'){
					$DOM = str_replace('<requirements_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Requirements</button>
						<div class="collap">
							<h2>Minimum</h2>
							<p>- 4GB of RAM</p>
							<p>- medium end CPU</p>
							<h2>Recommended</h2>
							<p>- 8GB of RAM</p>
							<p>- medium end CPU</p>
						</div>', $DOM);
					
				}else if($infos['htmlfilename']=='sky.html'){
					$DOM = str_replace('<requirements_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Requirements</button>
						<div class="collap">
							<h2>Minimum</h2>
							<p>- 4GB of RAM</p>
							<p>- medium end CPU</p>
							<h2>Recommended</h2>
							<p>- 8GB of RAM</p>
							<p>- high end CPU</p>
						</div>', $DOM);
					
				}else if($infos['htmlfilename']=='snow.html'){
					$DOM = str_replace('<requirements_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Requirements</button>
						<div class="collap">
							<h2>Minimum</h2>
							<p>- 4GB of RAM</p>
							<p>- medium end CPU</p>
							<h2>Recommended</h2>
							<p>- 8GB of RAM</p>
							<p>- medium end CPU</p>
						</div>', $DOM);
					
				}else if($infos['htmlfilename']=='trees.html'){
					$DOM = str_replace('<requirements_to_insert/>', '<button class="collapsible <download_class_to_insert/>">Requirements</button>
						<div class="collap">
							<h2>Minimum</h2>
							<p>- 8GB of RAM</p>
							<p>- medium end CPU</p>
							<h2>Recommended</h2>
							<p>- 16GB of RAM</p>
							<p>- high end CPU</p>
						</div>', $DOM);
					
				}
				if($isfirst){
					$isfirst = false;
					$DOM = str_replace('<download_class_to_insert/>', 'downstart', $DOM);
				}else{
					$DOM = str_replace('<download_class_to_insert/>', '', $DOM);
				}
				
				if($infos['acronymlicense']!=''){
					$DOM = str_replace('<license_section_to_insert/>', '<button class="collapsible downend">License</button>
					<div class="collap license">
						<h2><acronym_license_to_insert/></h2>
						<p><license_text_to_insert/></p>
					</div>', $DOM);
					$DOM = str_replace('<acronym_license_to_insert/>', $infos['acronymlicense'], $DOM);
					$DOM = str_replace('<license_text_to_insert/>', $infos['licensetext'], $DOM);
				}else{
					$DOM = str_replace('<license_section_to_insert/>', '', $DOM);
				}
				if($isfirst){
					$isfirst = false;
					$DOM = str_replace('<download_class_to_insert/>', 'downstart', $DOM);
				}else{
					$DOM = str_replace('<download_class_to_insert/>', '', $DOM);
				}

				//Import the rest of the product
				$DOM = str_replace('<content_product_to_insert/>', file_get_contents('html_products/'.$infos['htmlfilename']), $DOM);
				if($infos['htmlfilename']=='textures.html'){
					$DOM = textures::getTextures($DOM);
				}
				
				if($infos['coverimg']!=''){
					$DOM = str_replace('<cover_img_to_insert/>', '<div class="cover">
						<img class="covimage panels" src="<relative_path_to_insert/>' . $infos['coverimg'] . '">
						</div>
						<div class="space"></div>', $DOM);
				}else{
					$DOM = str_replace('<cover_img_to_insert/>', '', $DOM);
				}
				
				$DOM = str_replace('<link_comment_to_insert/>', $infos['commentlink'], $DOM);

				$parallaxtext = '';
				$imgtext = '';
				if(sizeof($footer_images)>0){
					$parallaxtext = '<div class="space"></div>';
				}
				foreach ($footer_images as $fi){
					$imagetype = $fi['imagetype'];
					$imagepath = $fi['imagepath'];
					$alt = $fi['alt'];
					if($imagetype == 'parallax'){
						$parallaxtext = $parallaxtext . '<div class="parallax" style="background-image: url(\'<relative_path_to_insert/>' . $imagepath .'\');"></div>' . PHP_EOL;
						$imgtext = $imgtext . '<img class="par-image" src="<relative_path_to_insert/>' . $imagepath .'" alt="' . $alt .'" loading="lazy">' . PHP_EOL;
					}
				}
				$DOM = str_replace('<renders_to_insert/>', $parallaxtext . $imgtext, $DOM);
			}else{
				$DOM = str_replace('<page_to_insert/>', file_get_contents('html_products/' . $infos['comingsoonlink']), $DOM);
			}
		}else{
			$DOM = str_replace('<page_to_insert/>', file_get_contents('html_products/product_not_found.html'), $DOM);
		}
		
		//Setting footer content
		$DOM = str_replace('<footer_script_to_insert/>', '<a class="chat" href="javascript:void(Tawk_API.toggle())"><i class="fas fa-comment"></i></a><script src="<relative_path_to_insert/>scripts/chat.js" type="text/javascript"></script>', $DOM);
		////////////


		//Fix RelativePath
		$DOM = str_replace('<relative_path_to_insert/>', '../', $DOM);
		////////////
		
		//Changing file extension for Safari >:-(
		if(Utilities::getBrowser()!='Safari'){	
			$DOM = str_replace('<extension_to_insert/>', 'png', $DOM);
		}else{
			$DOM = str_replace('<extension_to_insert/>', 'webp', $DOM);
		}
		////////////
		
		//Print Page
		return $DOM;
		////////////
	}
}

class textures{
	public static function getTextures($DOM){
		$types = connection_manager::getTexturesType();
		$textures = connection_manager::getTextures();
		foreach($types as $type){
			$texturesText = '';
			foreach($textures as $texture){
				if($texture['typename'] == $type['typename'] && $texture['active']==1){
					$texturesText = $texturesText . '<div class="container">
														<div class="tex halfpage1">
															<div class="column1">';
					$count = 0;
					$isFirst = true;
					if($texture['1k_path']!='' && $texture['1k_active']==1){$count = $count + 1;}
					if($texture['2k_path']!='' && $texture['2k_active']==1){$count = $count + 1;}
					if($texture['4k_path']!='' && $texture['4k_active']==1){$count = $count + 1;}
					if($texture['8k_path']!='' && $texture['8k_active']==1){$count = $count + 1;}
					
					if($texture['1k_path']!='' && $texture['1k_active']==1){
						$isFirst = false;
						$count = $count - 1;
						$texturesText = $texturesText . '<a href="' . $texture['1k_path'] . '" class="round1" download>' . $texture['1k_label'] . '</a>';
					}
					if($texture['2k_path']!='' && $texture['2k_active']==1){
						$texturesText = $texturesText . '<a href="' . $texture['2k_path'] . '" <class_to_insert/> download>' . $texture['2k_label'] . '</a>';
						if($isFirst == true){
							$texturesText = str_replace('<class_to_insert/>', 'class="round1"', $texturesText);
						}else{
							if($count == 1){
								$texturesText = str_replace('<class_to_insert/>', 'class="round2"', $texturesText);
							}else{
								$texturesText = str_replace('<class_to_insert/>', '', $texturesText);
							}
						}
						$count = $count - 1;
					}
					if($texture['4k_path']!='' && $texture['4k_active']==1){
						$texturesText = $texturesText . '<a href="' . $texture['4k_path'] . '" <class_to_insert/> download>' . $texture['4k_label'] . '</a>';
						if($isFirst == true){
							$texturesText = str_replace('<class_to_insert/>', 'class="round1"', $texturesText);
						}else{
							if($count == 1){
								$texturesText = str_replace('<class_to_insert/>', 'class="round2"', $texturesText);
							}else{
								$texturesText = str_replace('<class_to_insert/>', '', $texturesText);
							}
						}
						$count = $count - 1;
					}
					if($texture['8k_path']!='' && $texture['8k_active']==1){
						$texturesText = $texturesText . '<a href="' . $texture['8k_path'] . '" <class_to_insert/> download>' . $texture['8k_label'] . '</a>';
						if($isFirst == true){
							$texturesText = str_replace('<class_to_insert/>', 'class="round1"', $texturesText);
						}else{
							if($count == 1){
								$texturesText = str_replace('<class_to_insert/>', 'class="round2"', $texturesText);
							}else{
								$texturesText = str_replace('<class_to_insert/>', '', $texturesText);
							}
						}
						$count = $count - 1;
					}
					$texturesText = $texturesText . '</div>
														</div>
														<img  src="<relative_path_to_insert/>' . $texture['iconpath'] . '">
														<p>' . $texture['name'] . '</p>
													</div>';
				}
			}
			$DOM = str_replace('<' . strtolower($type['typename']) . '_to_insert/>', $texturesText,$DOM);
		}
		return $DOM;
	}
}
?>
