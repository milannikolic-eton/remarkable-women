<?php
$postsPageID = get_option('page_for_posts'); 
// Default arguments
$args = array(
  'posts_per_page' => 3, // How many items to display
  'post__not_in'   => array( get_the_ID() ), // Exclude current post
  'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
  'orderby' => array( 'rand', 'name' ),
  'meta_query' => array( 
        array(
            'key' => '_thumbnail_id'
        ) 
    )
);

// Check for current post category and add tax_query to the query arguments
$cats = wp_get_post_terms( get_the_ID(), 'category' ); 
$cats_ids = array();  
foreach( $cats as $wpex_related_cat ) {
  $cats_ids[] = $wpex_related_cat->term_id; 
}
if ( ! empty( $cats_ids ) ) {
  $args['category__in'] = $cats_ids;
}

// Query posts
$wpex_query = new wp_query( $args );

if ($wpex_query->have_posts() ) {

?>
<div class="related-block">
  <div class="container">
    <div class="latest-posts-header flex flex-vertical-center">
      <h3 class="section-title">Related Articles</h3>
            
    </div>
<div class="row" id="relatedposts">
<?php
// Loop through posts
foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
<article class="post-in-loop flex flex-column col4">

    <!-- post thumbnail -->
    <?php if ( has_post_thumbnail()) : ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_post_thumbnail('grid-item'); ?>
      </a>
    <?php endif; ?>
    <!-- /post thumbnail -->




      <h3>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h3>
      <div class="excerpt"><?php echo get_the_excerpt(); ?></div>
    <div class="flex post-metas flex-center flex-left">
        <?php 
          $author_id = get_post_field ('post_author', get_the_id());
          $author_name = get_the_author_meta( 'display_name', $author_id );
          $author_img_id = get_field('author_image', 'user_' . $author_id);
          $author_bio = get_the_author_meta('description', $author_id);
          $author_link = get_author_posts_url($author_id); 

            echo '<span>by </span><a href="'.$author_link.'">' . $author_name. '</a>';

          
        ?>
        <span class="date"><?php the_time('M j, Y'); ?></span>
        <?php $content = get_post_field( 'post_content', get_the_id() );
          $word_count = str_word_count( strip_tags( $content ) );
          $readingtime = ceil($word_count / 200);
        echo $readingtime . ' min read'; ?>
        <div class="author-card">

      </div>
    </div>

      


              <?php $terms = get_the_terms( get_the_ID(), 'category' ); 
      if ($terms) {
        echo "<div class='post-cats-loop'>";
        foreach ($terms as $term) {
          echo "<span><a class='btn' href='". get_term_link($term) ."'>". $term->name ."</a></span>";
        }
        echo "</div>";
      }

    ?>
    

</article>
<?php
// End loop
endforeach;

// Reset post data
wp_reset_postdata(); 
?>
</div>
  </div>
</div>
<?php
} // if has relates posts
?>

