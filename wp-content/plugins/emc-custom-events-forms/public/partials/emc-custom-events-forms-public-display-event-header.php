<?php
/*
 *
 */
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<a href="<?php echo get_site_url(); ?>/events/community/add">
				<button class="emc-big-btn alignright" type="button">
					<img src="<?php echo  plugin_dir_url( __FILE__ ) .'images/schedule.png' ?>" alt="View Calendar"/>
					<span>Schedule an Event</span>
				</button>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6">
      <?php if( tribe_is_month() ) : ?>
			<a href="<?php echo get_site_url();?>/events/list">
				<button class="emc-big-btn alignleft" type="button">
					<img src="<?php echo plugin_dir_url( __FILE__ ) .'images/events.png' ?>" alt="Schedule an Event"/>
					<span>View List</span>
				</button>
			</a>

      <?php else: ?>
			<a href="<?php echo get_site_url();?>/events/month">
				<button class="emc-big-btn alignleft" type="button">
					<img src="<?php echo plugin_dir_url( __FILE__ ) .'images/events.png' ?>" alt="Schedule an Event"/>
					<span>View Calendar</span>
				</button>
			</a>
      <?php endif; ?>
		</div>
	</div>

