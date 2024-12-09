<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'accordions-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordions';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
$accordions = get_field('accordions');
?>
<?php if( $accordions ): $i = 0; ?>
<div class="accordions-wrapper" id="<?php echo $id; ?>">

   <?php foreach( $accordions as $a ): ?>
    <div class="accordion">
        <div class="accordion-title"><?php echo $a['title']; ?></div>
        <div class="accordion-content">
            <?php echo $a['text']; ?>

            <?php 
            $link = $a['link'];
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
            <div class="wp-block-button is-style-btn-outline-dark flex flex-end" style="margin-top: 20px;">
                <a class="wp-block-button__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>   
    <?php endforeach; ?>

</div>

<script>
    jQuery(document).ready(function(){
        jQuery('.accordion-title').click( function() {
            jQuery(this).toggleClass('opened');
                        jQuery(this).next().slideToggle().stop();
                       // jQuery(this).parent().siblings().find('.accordion-content').slideUp();
                     //   jQuery(this).parent().siblings().find('.accordion-title').removeClass('opened');
        });//accordion
});//ready
</script>

<?php endif; ?>
