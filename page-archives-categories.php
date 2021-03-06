<?php
/**
* Template Name: Archives - Category Index
*/
get_header();
if ( have_posts() ) {
    if ( have_posts() ) {
        the_post();
?>
        <header>
            <h1><?php the_title(); ?></h1>
            <?php edit_post_link( __( 'Edit'), '<p>', '</p>' ); ?>
        </header>

        <article class="posts-listing">
            <?php the_content(); ?>
            <?php
                $cats = get_categories(array(
                    'order' => 'name',
                    'order' => 'asc',
                    'pad_counts' => false,
                ));
                foreach ( $cats as $cat ){
                    echo "<div class='category'>\n";
                    echo "<h4><a href=\"/blog/category/" . $cat->slug . "/\">" . $cat->name . " (". $cat->count .")</a></h4>\n";
                    echo "<div class='toggle'>\n";
                    $category_description = category_description( $cat->term_id );
                        if ( ! empty( $category_description ) ) {
                            printf("%s", $category_description);
                    }
                    echo "<ul>";
                    query_posts( array( 'category__in' => $cat->term_id, 'posts_per_page' => -1 ) );
                    while(have_posts()) { the_post();?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php } // end foreach
                    echo "</ul>\n";
                    echo "</div>\n";
                    echo "</div>\n";
                }

            ?>

        </article>
<?php
    }
}

get_footer();
