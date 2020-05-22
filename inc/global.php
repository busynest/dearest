<?php 

/* ---------------------------------------------------------------------- */


/**
 *
 *
 * Custom template functions
 *
 */



//Query ev posts for home page features (1 call)
if ( ! function_exists( 'av_section_feature' ) ) {
	/**
	 * Display single post within a section row
	 */
	function av_section_feature () {
		$args = array(
			'post_type' => 'ev',
      		'orderby'   => 'rand',
    		'posts_per_page' => 6,
      		'meta_key' => 'ev_info__feature',
      		'meta_value' => 'enable'
		);

		$the_query = new WP_Query( $args );

		while ($the_query -> have_posts()) : $the_query -> the_post();

			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */

			//get_template_part( 'content', 'ev' );
      // av_home_feature_news();
      av_post_content();
		endwhile;
		wp_reset_postdata();
	}
}

//Query three latest news articles from post, catagory='news' (1 call)
if ( ! function_exists( 'av_section_news' ) ) {
	/**
	 * Display single post within a section row
	 */
	function av_section_news () {

		$args = array(
			'category_name' => 'news',
    	'posts_per_page' => 3
		);
		$the_query = new WP_Query( $args );

		while ($the_query -> have_posts()) : $the_query -> the_post();

			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			//get_template_part( 'content', 'ev' );
      av_home_feature_news();

		endwhile;
		wp_reset_postdata();

	}
}

//Display homepage features and news (2 call)
if ( ! function_exists( 'av_home_feature_news' ) ) {

	function av_home_feature_news () {

    $post_url = get_post_permalink($post->ID);

    $image_src = get_the_post_thumbnail_url( $post->ID, 'full' );
    if (!$image_src): $image_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

		?>
      <div id="post-<?php the_ID(); ?>" class="av__grid-row-3">
        <div>
          <div class="av__feature">Featured</div>

          <a href="<?php echo $post_url ?>">
      	    <img src="<?php echo $image_src; ?>" alt="image" class="av__post-img"/>
          </a>
        </div>
        <div>
          <a href="<?php echo $post_url ?>">
            <?php the_title( '<h3 class="av__post-title">','</h3>' );?>
          </a>
          <a href="<?php echo $post_url ?>" target="_blank" class="more-info__visit button button--primary">
            View More
          </a>
        </div>
        <div class="home-news__content">
          <?php the_excerpt(); ?>
        </div>
      </div>
    <?php
	}
}

//Query archive posts that aren't 'featured' (1 call)
if ( ! function_exists( 'av_archive_post' ) ) {
  /**
   * Display single post within a section row
   */
  function av_archive_post($args) {


    $the_query = new WP_Query( $args );

    while ($the_query -> have_posts()) : $the_query -> the_post();

      /**
       * Include the Post-Format-specific template for the content.
       * If you want to override this in a child theme, then include a file
       * called content-___.php (where ___ is the Post Format name) and that will be used instead.
       */

      //get_template_part( 'content', 'ev' );
      av_post_content();

    endwhile;
    wp_reset_postdata();
  }
}



//Not assigned!
if ( ! function_exists( 'storefront_post_content' ) ) {
  /**
   * Display the post content with a link to the single post
   *
   * @since 1.0.0
   */
  function storefront_post_content() {
    ?>
    <div class="entry-content">
    <?php

    /**
     * Functions hooked in to storefront_post_content_before action.
     *
     * @hooked storefront_post_thumbnail - 10
     */
    do_action( 'storefront_post_content_before' );

    the_content(
      sprintf(
        __( 'Continue reading %s', 'storefront' ),
        '<span class="screen-reader-text">' . get_the_title() . '</span>'
      )
    );

    do_action( 'storefront_post_content_after' );

    wp_link_pages( array(
      'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
      'after'  => '</div>',
    ) );
    ?>
    </div><!-- .entry-content -->
    <?php
  }
}


/* ---------------------------------------------------------------------- */

/**
 * Revamped storefront template functions
 *
 */

 if ( ! function_exists( 'storefront_site_branding' ) ) {
  /**
   * The header container
   */
  function storefront_site_branding() {
    ?>
      <div class="beta site-title av_site_header_logo">
        <a href="https://www.alter-verse.com/">
          <?php
        if(is_front_page()) :?>
          <img src="https://www.alter-verse.com/wp-content/uploads/2019/06/alterverse2.png" alt="Alter-verse" />
          <?php else : ?>
        <img src="https://www.alter-verse.com/wp-content/uploads/2019/06/alterverse.png" alt="Alter-verse" />
          <?php endif; ?>
        </a>
      </div>
    <?php
    }
 }


 if ( ! function_exists( 'storefront_header_container' ) ) {
  /**
   * The header container
   */
  function storefront_header_container() {
    echo '<div class="col-full header__grid">';
  }
 }

if ( ! function_exists( 'storefront_primary_navigation_wrapper' ) ) {
  /**
   * The primary navigation wrapper
   */
  function storefront_primary_navigation_wrapper() {
    echo '<div class="storefront-primary-navigation">';
  }
}

if ( ! function_exists( 'storefront_primary_navigation_wrapper_close' ) ) {
  /**
   * The primary navigation wrapper close
   */
  function storefront_primary_navigation_wrapper_close() {
    echo '
      </div>
        ';

  }
}

if ( ! function_exists( 'storefront_header_container_close' ) ) {
  /**
   * The header container close
   */
  function storefront_header_container_close() {
    echo do_shortcode( '[searchandfilter fields="search" search_placeholder="Search vehicles..." class="home-filter__plugin"]' );
    echo '</div>';
  }
}

/* ---------------------------------------------------------------------- */

/**
 * Template Hooks
 *
 */

/**
 * General
 *
 * @see  storefront_header_widget_region()
 * @see  storefront_get_sidebar()
 */
add_action( 'storefront_before_content', 'storefront_header_widget_region', 10 );
add_action( 'storefront_sidebar',        'storefront_get_sidebar',          10 );

/**
 * Custom ev posts
 *
 */
add_action( 'av_evpost_content', 'av_home_feature_news', 10 );

/**
 * Custom Alter-verse header
 *
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */
add_action( 'av_storefront_header', 'storefront_header_container',                 0 );
add_action( 'av_storefront_header', 'storefront_site_branding',                    0 );
add_action( 'av_storefront_header', 'storefront_primary_navigation_wrapper',       0 );
add_action( 'av_storefront_header', 'storefront_primary_navigation',               0 );
add_action( 'av_storefront_header', 'storefront_primary_navigation_wrapper_close', 0 );
add_action( 'av_storefront_header', 'storefront_header_container_close',           0 );
//add_action( 'av_storefront_header', 'storefront_product_search', 40 ); > inc/woocommerce
//add_action( 'av_storefront_header', 'storefront_header_cart',    60 ); > inc/woocommerce

?>