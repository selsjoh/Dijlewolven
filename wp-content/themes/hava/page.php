<?php get_header(); ?>

<div class="container">
	<div class="row">

		<div class="col-lg-10 offset-lg-1" id="firs">

			<?php while (have_posts()) : the_post(); ?>

				<div class="page-heading">
					<h1><?php the_title(); ?></h1>
				</div>

				<div class="post-content">

					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hava' ),
						'after'  => '</div>',
					) );

					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

				endwhile;
				?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();
