<?php $this->layout( 'templates::default' ) ?>

<?php $this->start('content');
	$query_carousel = array(
								'numberposts' => 3, 
								'orderby'=>'post_date',
								'category' => 1
							);
	echo Carousel::mk_output_carousel( $query_carousel );
$this->end() ?>