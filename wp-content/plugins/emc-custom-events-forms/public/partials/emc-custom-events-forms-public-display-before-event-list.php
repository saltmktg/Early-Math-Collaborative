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
			<a href="<?php echo get_site_url();?>/events/month">
				<button class="emc-big-btn alignleft" type="button">
					<img src="<?php echo plugin_dir_url( __FILE__ ) .'images/events.png' ?>" alt="Schedule an Event"/>
					<span>View Calendar</span>
				</button>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<table id="emc-events-list" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Team / Team Member</th>
						<th>Type</th>
						<th>Date</th>
						<th>Event</th>
						<th>Form(s)</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Team / Team Member</th>
						<th>Type</th>
						<th>Date</th>
						<th>Event</th>
						<th>Form(s)</th>
					</tr>
				</tfoot>
				<tbody>

