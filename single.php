<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container wrap">
			<? get_template_part("nav"); ?>
		</div>
	</div>
	<div class="div wrap" id="wrapper">
		<div class="container single" id="main">
			<ol class="breadcrumbs"></ol>
			<?
				if(have_posts()): while(have_posts()): the_post();

				$cats = array();

				$terms = wp_get_post_terms(get_the_ID(), "special-post-type");
				for( $i=0; $i < count($terms); $i++){
					$isFeature = $terms[$i]->slug == "features" ? true : $isFeature;
					array_push($cats, $terms[$i]->name);
				}

				$postID = $post->ID;
				if($isFeature) :
			?>
			<div class="feature single">
				<? if( $galleries = get_post_galleries($post) ) :?>
				<? 
					$ids = get_post_meta($postID, "_perrier2_slider_ids", true);
					$images = make_slider_image_array(explode(",", $ids));
					echo make_slider_markup($images);
				?>
				<? elseif( ( $videoID = get_post_meta($postID, "_perrier2_video_id", true) ) && $useVideo = get_post_meta($postID, "_perrier2_video_as_feature", true) ) : ?>
				<? echo make_video_player($videoID, get_post_meta($postID, "_perrier2_video_type", true), 720, 480) ?>
				<? else: ?>
				<img class="hero" src="<? echo theme_uri; ?>/assets/images/test.jpg" alt="">
				<? endif; ?>
				<ul class="metadata">
					<li class="categories"><? echo join(", ", $cats); ?></li>
					<li class="divider"></li>
					<li class="date"><? the_date(); ?></li>
					<li class="comments-meta-link"><? comments_number("","",""); ?></li>
					<li class="addthis">
						<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet"></a>
							<a class="addthis_button_pinterest_pinit"></a>
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
					</li>
				</ul>
				<h2 class="title"><? the_title(); ?></h2>
				<h6 class="author"><strong>By:</strong> <? the_author(); ?></h6>
				<div class="content"><? the_content(); ?></div>
				<div class="tags"><? the_tags("<strong>Tags:</strong> "); ?></div>
			</div>
			<? else: ?>
			<div class="single">
				<? if( $galleries = get_post_galleries($post) ) :?>
				<? print_r($galleries); ?>
				<? endif; ?>
				<? if( ( $videoID = get_post_meta($postID, "_perrier2_video_id", true) ) && $useVideo = get_post_meta($postID, "_perrier2_video_as_feature", true) ) : ?>
				<? echo make_video_player($videoID, get_post_meta($postID, "_perrier2_video_type", true), 720, 480) ?>
				<? else: ?>
				<img class="hero" src="<? echo theme_uri; ?>/assets/images/test.jpg" alt="">
				<? endif; ?>
				<ul class="metadata">
					<li class="categories"><? echo join(", ", $cats); ?></li>
					<li class="divider"></li>
					<li class="date"><? the_date(); ?></li>
					<li class="comments-meta-link"><? comments_number("","",""); ?></li>
					<li class="addthis">
						<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet"></a>
							<a class="addthis_button_pinterest_pinit"></a>
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
					</li>
				</ul>
				<h2 class="title"><? the_title(); ?></h2>
				<h6 class="author"><strong>By:</strong> <? the_author(); ?></h6>
				<div class="content"><? the_content(); ?></div>
				<div class="tags"><? the_tags("<strong>Tags:</strong> "); ?></div>
			</div>
			<? endif; ?>
			<?
				endwhile;
				endif;
			?>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>