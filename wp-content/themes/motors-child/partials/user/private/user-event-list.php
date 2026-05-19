<?php
$user_id = get_current_user_id();
//echo "+++".$user_id;


$args = array(
   'post_type' => 'event',
   'posts_per_page' => -1,
   'post_status' => 'publish',
   'author' => $user_id,
);

$event_query = new WP_Query( $args );


?>

<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
	<thead>						
		<tr>
			<th>Title</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Venue Name</th>
			<th>Action</th>
		</tr>				
	</thead>
	<tbody>
		<?php 
			if ( $event_query->have_posts() ){
				while ( $event_query->have_posts() ) : $event_query->the_post();
				$event_id = get_the_ID();
		?>
			<tr>
				<td><?php echo get_the_title(); ?></td>
				<td><?php echo get_field('start_date', $event_id); ?></td>
				<td><?php echo get_field('end_date', $event_id); ?></td>
				<td><?php echo get_field('venue_name', $event_id); ?></td>
				<td>
					<a href="<?php echo stm_get_author_link( '' ); ?>?page=add_event&id=<?php echo $event_id; ?>" class="button edit_btn">Edit <i class="fa fa-edit"></i></a>
					<a href="<?php echo stm_get_author_link( '' ); ?>?page=add_event&id=<?php echo $event_id; ?>&action=delete" class="button edit_btn" onclick="return confirm('Are you sure you want to delete this?');">Delete <i class="fa fa-trash"></i></a>
				</td>
			</tr>
		<?php 
				endwhile;
				wp_reset_postdata(); 
			}else{ 
		?>
				<tr><td colspan="5" class="text-center">No Event Found</td></tr>
		<?php } ?>
	</tbody>
</table>