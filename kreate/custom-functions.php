<?
	function make_video_player( $id, $type, $width, $height ){
		$url = $type == "vimeo" ? "//player.vimeo.com/video/" . $id : "//www.youtube.com/embed/" . $id;
		$player = "<iframe src='$url' width='$width' height='$height' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";

		return $player;
	}

	function make_slider_image_array( array $ids ){
		$images = array();

		foreach($ids as $id){
			$attachment = get_post( $id );

			$images[] = array(
				"url" => $attachment->guid,
				"caption" => $attachment->post_excerpt,
				"desc" => $attachment->post_content,
				"id" => $id
			);
		}

		return $images;
	}

	function make_slider_markup( array $images ){
		$length = count($images);
		$arrows .= "<button type='button' class='prev'></button><button type='button' class='next'></button>";
		$markup .= "<div class='slider' data-amount='$length'>$arrows<div class='slider_images'>";

		foreach($images as $image){
			$url = $image["url"];
			$crop = wp_get_attachment_image($image["id"], array(720,480));
			$img .= "<div class='slide_image_holder'><img data-image='$url' " . substr($crop, 5, strlen($crop) - 5) . "</div>";
		}
		$markup .= $img . "</div></div>";

		return $markup;
	}

	// function get_post_terms(){
		
	// }

	// function addDefaultTerms(){
	// 	$country = get_option("plugin_options")["country"];
	// 	$city = get_option("plugin_options")["city"];

	// 	$countryExists = term_exists($country, "country");

	// 	echo $countryExists;
	// 	if( $countryExists == 0 || $countryExists == null){
	// 		wp_insert_term( $country, "country", array(
	// 			"slug" => strtolower($country),
	// 			"description" => "Country",
	// 			"parent" => 0
	// 		));

	// 		echo "Added";
	// 	}
	// }

	// add_action("after_setup_theme", addDefaultTerms);
?>