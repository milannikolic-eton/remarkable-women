<?php get_header();
$postsPageID = get_option('page_for_posts');
$author_id = get_post_field('post_author', get_the_id());
//$author_image = get_field('author_image', 'user_' . $author_id);
$author_id = get_post_field('post_author', get_the_id());
$author_name = get_the_author_meta('display_name', $author_id);
//$author_img_id = get_field('author_image', 'user_' . $author_id);
$author_bio = get_the_author_meta('description', $author_id);
$author_link = get_author_posts_url($author_id);
?>
<div class="gutenberg">
	<?php if (has_post_thumbnail()):
		$hero_url = get_the_post_thumbnail_url(get_the_ID(), 'hero');
		?>
		<div class="wp-block-cover has-parallax" style="min-height:55vh;aspect-ratio:unset;"><span aria-hidden="true"
				class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient"
				style="background:linear-gradient(90deg,rgb(0,0,0) 2%,rgba(0,0,0,0.57) 100%)"></span>
			<div class="wp-block-cover__image-background has-parallax"
				style="background-position:50% 50%;background-image:url(<?php echo esc_url($hero_url); ?>)">
			</div>
			<div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
				<p class="has-text-align-left animated fadeInDown moving" style="font-size: 2rem;"><strong><a
							href="<?php echo get_the_permalink($postsPageID); ?>"><?php echo get_the_title($postsPageID); ?></a></strong>
				</p>


				<h1 class="animated fadeInUp moving wp-block-post-title"><?php the_title(); ?></h1>


				<p class="animated fadeInUp delay1 moving has-medium-font-size"><span
						class="date"><?php the_time('d F Y'); ?></span></p>

			</div>
		</div>
	<?php endif; ?>


	<div class="container-narrow">
		<?php
		if (!has_excerpt()) {

		} else {
			echo '<div class="single-excerpt">' . get_the_excerpt() . '</div>';
		}
		?>
		<?php the_content(); // Dynamic Content ?>
	</div>



</div> <!-- /gutenberg -->



<?php get_template_part('template-parts/latest-posts'); ?>

<?php
if (function_exists('pll_current_language')) {
	// Get the current language
	$current_language = pll_current_language();

	// Output label based on language
	if ($current_language == 'en') {
		$pattern_id = 144;
	} elseif ($current_language == 'de') {
		$pattern_id = 820;
	}
} else {
	$pattern_id = 820;
}
// Fetch the pattern content (assuming it's stored in post content)
$pattern_post = get_post($pattern_id);

if ($pattern_post) {
	echo '<div class="gutenberg">';
	echo do_blocks($pattern_post->post_content);
	echo "</div>";
}
?>

<?php get_footer(); ?>