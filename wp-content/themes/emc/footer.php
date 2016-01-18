<?php
/**
 * The template for displaying the footer.
 *
 * (Feel free to remove all links if you choose.)
 *
 * @package EMC 
 * @since 1.0 
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="widget-area footer-left" role="complementary">
				<?php dynamic_sidebar( 'footer-left' ); ?>
			</div>
			<div class="widget-area footer-center" role="complementary">
				<?php dynamic_sidebar( 'footer-center' ); ?>
			</div>
			<div class="widget-area footer-right" role="complementary">
				<?php dynamic_sidebar( 'footer-right' ); ?>
			</div>
		</div>
	</footer><!-- #colophon .site-footer -->

</div><!-- .page -->

<?php wp_footer(); ?>

<!-- Modal Script -->
<!--<script>
document.getElementById('modal-presentation').onclick = function() {
  Modal.open({
    content: '<iframe src="http://slides.com/ryankarpeles/this-is-the-title/fullscreen" width="100%" height="100%" scrolling="no" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
    width: '90%', // Can be set to px, em, %, or whatever else is out there.
    height: '90%',
    hideclose: true
  });
}
</script>-->

<!-- Tipso Script -->
<script>
  jQuery('.show-hide-tipso').on('click', function(e){
    if(jQuery(this).hasClass('clicked')){
    jQuery(this).removeClass('clicked');
    jQuery('.show-hide').tipso('hide');
    } else {
    jQuery(this).addClass('clicked');
    jQuery('.show-hide').tipso('show');
    }
    e.preventDefault();
  });
</script>

<script>
jQuery('.hover-tipso-tooltip').tipso({
    position: 'top',
    background: 'rgba(10,10,10,.8)',
    useTitle: false,
    width: false,
    maxWidth: 320,
    tooltipHover: true,
    content: function(){
      return 'These are Foundational Math Concepts and Common Core domains. <a class="show-hide-tipso" href="http://earlymath.erikson.edu/about-early-math-programming-for-teachers-and-teacher-educators/website-for-online-learning-math/"><strong>More information &raquo;</strong></a>';
    }
  });
</script>


</body>
</html>