<?php get_header(); ?>
<br><br><br>

<h1>EVENTS</h1>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<a href="<?php echo get_site_url(); ?>">
				<button class="emc-big-btn alignright" type="button">
					<img src="<?php echo get_template_directory_uri(); ?>/saucal/img/schedule.png" alt="View Calendar"/>
					<span>Schedule an Event</span>
				</button>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6">
			<a href="<?php echo get_site_url();?>/events">
				<button class="emc-big-btn alignleft" type="button">
					<img src="<?php echo get_template_directory_uri(); ?>/saucal/img/events.png" alt="Schedule an Event"/>
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
					<tr>
						<td>Coach Name</td>
						<td>Type1</td>
						<td>15/01/2016</td>
						<td><a href="<?php echo get_site_url();?>/event/example-event/">Event Example</a></td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 2</td>
						<td>Type2</td>
						<td>02/02/2016</td>
						<td>Event #2</td>
						<td>Planning(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 3</td>
						<td>Type1</td>
						<td>03/02/2016</td>
						<td>Event #3</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 4</td>
						<td>Type3</td>
						<td>04/02/2016</td>
						<td>Event #4</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 4</td>
						<td>Type1</td>
						<td>05/02/2016</td>
						<td>Event #5 </td>
						<td>Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 1</td>
						<td>Type1</td>
						<td>01/02/2016</td>
						<td>Event #1</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 2</td>
						<td>Type2</td>
						<td>02/02/2016</td>
						<td>Event #2</td>
						<td>Planning(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 3</td>
						<td>Type1</td>
						<td>03/02/2016</td>
						<td>Event #3</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 4</td>
						<td>Type3</td>
						<td>04/02/2016</td>
						<td>Event #4</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 4</td>
						<td>Type1</td>
						<td>05/02/2016</td>
						<td>Event #5 </td>
						<td>Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 1</td>
						<td>Type1</td>
						<td>01/02/2016</td>
						<td>Event #1</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 2</td>
						<td>Type2</td>
						<td>02/02/2016</td>
						<td>Event #2</td>
						<td>Planning(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 3</td>
						<td>Type1</td>
						<td>03/02/2016</td>
						<td>Event #3</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 4</td>
						<td>Type3</td>
						<td>04/02/2016</td>
						<td>Event #4</td>
						<td>Planning(#form_id), Observation(#form_id)</td>
					</tr>
					<tr>
						<td>Example Name 4</td>
						<td>Type1</td>
						<td>05/02/2016</td>
						<td>Event #5 </td>
						<td>Observation(#form_id)</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<br><br><br>
<?php get_footer(); ?>
