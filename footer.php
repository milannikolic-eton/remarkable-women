</div>
<!-- /body-content -->
</div>
<!-- /wrapper -->


<!-- footer -->
<footer class="footer" role="contentinfo">
  <div class="footer-top">
    <div class="container">
      <div class="footer-widget">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
      </div>
    </div><!-- /container -->
  </div><!-- /footer-top -->
  <div class="footer-bottom">
    <div class="container">

      <?php if (has_nav_menu('footer-menu2')) {
        wp_nav_menu(array('theme_location' => 'footer-menu2'));
      }
      ?>
    </div><!-- /container -->
  </div><!-- /footer-bottom -->
</footer>
<!-- /footer -->



</div>
<!-- /wrapper -->

<?php wp_footer(); ?>






<script>



  document.addEventListener('DOMContentLoaded', function () {
    /*** Venobox on the button */
    // Check if there are any elements with the class .video-btn
    const videoButtons = document.querySelectorAll('.video-btn > a');

    if (videoButtons.length > 0) {
      // Add the required attributes to each <a> element inside .video-btn
      videoButtons.forEach(btn => {
        btn.setAttribute('data-autoplay', 'true');
        btn.setAttribute('data-vbtype', 'video');
      });

      // Initialize Venobox
      new VenoBox({
        selector: '.video-btn > a'
      });
    }
/*** end of Venobox on the button */



    // Select all elements with the class "onscroll-view"
    const onScrollElements = document.querySelectorAll('.onscroll-view');

    // Create a new IntersectionObserver instance
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        // Check if the element is intersecting (in the viewport)
        if (entry.isIntersecting) {
          entry.target.classList.add('in-viewport');
        }/* else {
                entry.target.classList.remove('in-viewport');
            }*/
      });
    }, {
      // Set the threshold to 0.1, which means the callback will be triggered when 10% of the element is in the viewport
      threshold: 0.15
    });

    // Observe each selected element
    onScrollElements.forEach((el) => {
      observer.observe(el);
    });
  });



  // Get all elements with the class 'moving'
  /*const headings = document.querySelectorAll('.gutenberg > .wp-block-cover.has-parallax:first-child .wp-block-cover__image-background');

  // Loop through each element
  headings.forEach(heading => {
    window.addEventListener("scroll", function () {
      const scrollPosition = window.scrollY;

      // Set the transform style with !important for each heading
      heading.style.setProperty('transform', `translateY(-${scrollPosition * 0.1}px)`, 'important');
    });
  });
*/


  // Initialize Lenis after the document is fully loaded
  document.addEventListener('DOMContentLoaded', function () {
    const lenis = new Lenis({
      // Options for Lenis
      duration: 1.2, // Duration of the scroll animation
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: 'vertical', // Scroll orientation
      smoothWheel: true, // Enable smooth scrolling
    });

    // Start the scrolling animation
    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);
  });



  /*
    window.addEventListener('scroll', function() {
    const hero = document.querySelector('body:not(.page-id-209) .gutenberg > .wp-block-cover:first-child .wp-block-cover__image-background');
    const scrollPosition = window.scrollY;
    
    // Calculate a background size between 100% and 120% based on scroll position
    const zoomValue = 100 + (scrollPosition / 50); // Adjust divisor to control zoom speed
    hero.style.backgroundSize = `${Math.min(110, zoomValue)}%`; // Cap zoom at 120%
  });
  */
  window.addEventListener('scroll', function () {
    // Select the background element and the image inside the picture element
    const heroBg = document.querySelector('body:not(.page-id-209) .gutenberg > .wp-block-cover:first-child .wp-block-cover__image-background');
    const heroImg = document.querySelector('body:not(.page-id-209) .gutenberg > .wp-block-cover:first-child picture img'); // Adjust the selector to target your <picture> img element

    const scrollPosition = window.scrollY;

    // Calculate the zoom scale based on scroll position
    const zoomValue = 1 + (scrollPosition / 2000); // Adjust divisor to control zoom speed
    const scaleValue = Math.min(1.27, zoomValue); // Cap scale at 1.27 (127%)

    // For background image zoom using scale
    if (heroBg) {
      heroBg.style.transform = `scale(${scaleValue})`;
      heroBg.style.transition = 'transform 0.1s ease-out'; // Smooth transition effect
    }

    // For picture image zoom using scale
    if (heroImg) {
      heroImg.style.transform = `scale(${scaleValue})`;
      heroImg.style.transition = 'transform 0.1s ease-out'; // Smooth transition effect
    }
  });


</script>

</body>

</html>