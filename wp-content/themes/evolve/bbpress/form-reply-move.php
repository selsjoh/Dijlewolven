<?php
/**
 * Move Reply
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<div id="bbpress-forums">

	<?php if ( is_user_logged_in() && current_user_can( 'edit_topic', bbp_get_topic_id() ) ) : ?>

        <div id="move-reply-<?php bbp_topic_id(); ?>" class="bbp-reply-move">

            <form id="move_reply" name="move_reply" method="post" action="<?php the_permalink(); ?>">

                <h3 class="mb-3"><?php printf( __( 'Move reply "%s"', 'evolve' ), bbp_get_reply_title() ); ?></h3>

                <p class="alert alert-warning" role="alert">
					<?php esc_html_e( 'You can either make this reply a new topic with a new title, or merge it into an existing topic', 'evolve' ); ?>
                </p>

                <p class="alert alert-warning" role="alert">
					<?php esc_html_e( 'If you choose an existing topic, replies will be ordered by the time and date they were created', 'evolve' ); ?>
                </p>

                <h3 class="mb-3"><?php esc_html_e( 'Move method', 'evolve' ); ?></h3>

                <p class="custom-control custom-radio">
                    <input class="custom-control-input" name="bbp_reply_move_option" id="bbp_reply_move_option_reply"
                           type="radio"
                           checked="checked" value="topic" tabindex="<?php bbp_tab_index(); ?>"/>
                    <label class="custom-control-label"
                           for="bbp_reply_move_option_reply"><?php printf( __( 'New topic in <strong>%s</strong> titled:', 'evolve' ), bbp_get_forum_title( bbp_get_reply_forum_id( bbp_get_reply_id() ) ) ); ?></label>
                </p>
                <p>
                    <input type="text" id="bbp_reply_move_destination_title"
                           value="<?php printf( __( 'Moved: %s', 'evolve' ), bbp_get_reply_title() ); ?>"
                           tabindex="<?php bbp_tab_index(); ?>" size="35"
                           name="bbp_reply_move_destination_title"/>
                </p>

				<?php if ( bbp_has_topics( array(
					'show_stickies' => false,
					'post_parent'   => bbp_get_reply_forum_id( bbp_get_reply_id() ),
					'post__not_in'  => array( bbp_get_reply_topic_id( bbp_get_reply_id() ) )
				) ) ) : ?>

                    <p class="custom-control custom-radio">
                        <input class="custom-control-input" name="bbp_reply_move_option"
                               id="bbp_reply_move_option_existing" type="radio"
                               value="existing" tabindex="<?php bbp_tab_index(); ?>"/>
                        <label class="custom-control-label"
                               for="bbp_reply_move_option_existing"><?php esc_html_e( 'Use an existing topic in this forum:', 'evolve' ); ?></label>

                    </p>
                    <p>
						<?php bbp_dropdown( array(
							'post_type'   => bbp_get_topic_post_type(),
							'post_parent' => bbp_get_reply_forum_id( bbp_get_reply_id() ),
							'selected'    => - 1,
							'exclude'     => bbp_get_reply_topic_id( bbp_get_reply_id() ),
							'select_id'   => 'bbp_destination_topic',
							'none_found'  => __( 'No other topics found!', 'evolve' )
						) ); ?>
                    </p>
				<?php endif; ?>

                <p class="alert alert-danger" role="alert">
					<?php _e( '<strong>WARNING:</strong> This process cannot be undone', 'evolve' ); ?>
                </p>

                <p>
                    <button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_move_reply_submit"
                            name="bbp_move_reply_submit"
                            class="btn"><?php esc_html_e( 'Submit', 'evolve' ); ?></button>
                </p>

				<?php bbp_move_reply_form_fields(); ?>

            </form>
        </div>

	<?php else : ?>

        <p class="alert alert-danger" role="alert">
			<?php is_user_logged_in() ? esc_html_e( 'You do not have the permissions to edit this reply!', 'evolve' ) : esc_html_e( 'You cannot edit this reply', 'evolve' ); ?>
        </p>

	<?php endif; ?>

</div>
