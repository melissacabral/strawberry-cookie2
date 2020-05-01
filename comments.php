<?php 
//exit this file if a password is required
if( post_password_required() ){
	return;
}
?>

<section class="comments">
	<h3><?php comments_number(); ?> on this post</h3>

	<ol>
		<?php wp_list_comments( array(
			'avatar_size' => 50,
			'type' 	=> 'comment', //remove trackbacks and pingbacks
		) ); ?>
	</ol>

	<div class="pagination">
		<?php 
		previous_comments_link();
		next_comments_link();
		?>
	</div>

</section>

<section class="comment-form">
	<?php comment_form(); ?>
</section>

<section class="pings">
	<h3><?php sc_pings_count(); ?></h3>
	<ol>
		<?php wp_list_comments( array(
			'type' => 'pings', //pingbacks and trackbacks
			'short_ping' => true,
		) ); ?>
	</ol>
</section>