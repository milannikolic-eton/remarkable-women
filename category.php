<?php get_header(); 
 $postsPageID = get_option('page_for_posts'); 
 $term = get_queried_object();
 $image = get_field('image', $term);
?>


<div class="category-heading">
	<div class="container flex flex-vertical-center">
		<div class="category-heading-content">
			<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
			<h1><?php single_cat_title(); ?></h1>
			<div><?php echo $term->description; ?></div>
		</div>

		<?php 
			if( $image ) {
			    echo wp_get_attachment_image( $image, 'large' );
			}
		 ?>
	</div>
</div>

<div class="container">
	<div class="articles-grid row">
		<div class="col8" >
			<h3 class="section-title">Latest <?php single_cat_title(); ?> News</h3>
			<div id="posts-feed">
			<?php get_template_part('template-parts/loop'); ?>

			</div>
									<?php
//global $wp_query; // you can remove this line if everything works for you
						 $total = get_queried_object()->category_count;
						 
 
// don't display the button if there are not enough posts
if (  $wp_query->max_num_pages > 1 ){
	
	$posts_on_page = 8;
	$bar = $posts_on_page / $total * 100;

	echo '<div class="text-center">';
	echo "<div class='pagination-bar-wrapper'>";
	echo "<div class='pagination-bar-text'> Showing <span class='loaded-posts'>". $posts_on_page ."</span> of a <span class='total-posts'>" . $total . "</span> Items </div>";
	echo "<div class='pagination-bar'><span style='width:".$bar."%'></span></div>";
	echo "</div>";
	echo '<div class="ajax_loadmore btn">Load more</div></div>';

} else {
	$posts_on_page = $total;
	$bar = $posts_on_page / $total * 100;
}
?>
		</div>
		<div class="col4">
			<div class="sidebar-widget">
	                <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	         </div>

		</div>
	</div>
</div>




<?php get_footer(); ?>