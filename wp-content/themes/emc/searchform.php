<?php
/**
 * The template for displaying search forms
 *
 * @package EMC
 * @since 1.0
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'emc' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'emc' ); ?>" />
		<input type="submit" class="submit searchsubmit" name="submit" value="<?php esc_attr_e( 'Search', 'emc' ); ?>" />
	</form>