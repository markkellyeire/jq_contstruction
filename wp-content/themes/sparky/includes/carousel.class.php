<?php

class Carousel {
	
	/**
	 * Contains all functionality for out putting our responsive carousel.
	 *
	 */
	
	/**
	 * Build a carousel, given a WP_Query from the featured images of posts
	 *
	 * @param array $file
	 * 
	 * @return string
	 */
	public static function mk_output_carousel( $query_string )
	{
		$posts  = get_posts($query_string);
		$slides = static::mk_build_homepage_slides($posts);

		ob_start();
		include 'carousel.php';
		$carousel_content = ob_get_clean();
		//die(var_dump($carousel_content));

		return $carousel_content;
	}

	/**
	 * Build the $slides array of thumbnails for the homepage
	 *
	 * @param array $posts
	 * 
	 * @return array slides
	 */
	public static function mk_build_homepage_slides( $posts ) 
	{
		$slides = array();
		foreach($posts as $post) {
			setup_postdata($post);

			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			
			$slides[] = array(
				'large' => wp_get_attachment_image($post_thumbnail_id, 'large'),
				'title' => $post->post_title,
				'caption' => $post->post_excerpt,
				'date' => $post->post_date,
				'href' => get_permalink($post->ID),
			);
		}
		
		return $slides;	
	}

	/**
	 * Placeholder image
	 * 
	 * @param string $size
	 * @return string
	 */
	function mk_image( $image, $size ) {
		echo 'why';
		return ($image != '') ? $image : '<img src="' . get_bloginfo( 'template_url' ) . '/images/placeholder-' . $size . '.png"  class="thumb-'.$size.'" />';
	}
	
}