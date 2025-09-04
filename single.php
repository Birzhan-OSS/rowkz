<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rowkz
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Post Header Section -->
    <section class="post-header bg-light py-5 text-center position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn"><?php the_title(); ?></h1>
            <div class="post-meta text-muted mb-4 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                <span><i class="bi bi-person-fill me-2"></i><?php the_author(); ?></span> | 
                <span><i class="bi bi-calendar-fill me-2"></i><?php echo get_the_date(); ?></span> | 
                <span><i class="bi bi-tag-fill me-2"></i><?php the_category(', '); ?></span>
            </div>
        </div>
        <div class="hero-overlay position-absolute bottom-0 start-0 w-100" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,1), transparent);"></div>
    </section>

    <!-- Post Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('animate__animated animate__fadeInUp'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail mb-4">
                                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid rounded shadow-sm">
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <?php
                                the_content();
                                
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rowkz' ),
                                    'after'  => '</div>',
                                ) );
                                ?>
                            </div>

                            <?php if ( has_tag() ) : ?>
                                <div class="post-tags mt-4">
                                    <i class="bi bi-tags-fill text-primary me-2"></i>
                                    <?php the_tags( '<span class="badge bg-light text-dark">', '</span> <span class="badge bg-light text-dark">', '</span>' ); ?>
                                </div>
                            <?php endif; ?>
                        </article>

                        <!-- Post Navigation -->
                        <nav class="post-navigation mt-5 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                            <?php
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle d-block text-muted">' . esc_html__( 'Previous:', 'rowkz' ) . '</span> <span class="nav-title h5 text-primary">%title</span>',
                                    'next_text' => '<span class="nav-subtitle d-block text-muted">' . esc_html__( 'Next:', 'rowkz' ) . '</span> <span class="nav-title h5 text-primary">%title</span>',
                                )
                            );
                            ?>
                        </nav>

                        <!-- Comments Section -->
                        <?php
                        if ( comments_open() || get_comments_number() ) :
                            ?>
                            <div class="comments-section mt-5 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                                <?php comments_template(); ?>
                            </div>
                            <?php
                        endif;
                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </div>
    </section>


</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
?>