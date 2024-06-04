<?php
/**
 * Template Name: Projects Archive
 * Description: A custom template for displaying the archive of Projects.
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'project',
            'posts_per_page' => 6,
            'paged'          => $paged,
        );
        $projects_query = new WP_Query( $args );

        if ( $projects_query->have_posts() ) :
            while ( $projects_query->have_posts() ) : $projects_query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;

            // Pagination
            echo paginate_links( array(
                'total' => $projects_query->max_num_pages,
            ) );

            wp_reset_postdata();
        else :
            echo 'No projects found.';
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>