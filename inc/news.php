<?php

//Post indiviual vehicle in archive news page (1 call)
if ( ! function_exists( 'av_news_post_content' ) ) {
  /**
   * Display the post header with a link to the single post
   *
   * @since 1.0.0
   */
  function av_news_post_content() {

    $archive_post_src = get_the_post_thumbnail_url();


    if (!$archive_post_src) : $archive_post_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

    ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('av_archive__article'); ?>>
        <div class="archive__img" style="background-image:url(<?php echo $archive_post_src ?>)">

        </div>

        <div class="archive__title">
          <?php
            if ( is_single() ) {
              the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
              the_title( sprintf( '<h2 class="alpha entry-title av_archive_post__header"><a href="%s" rel="bookmark">'  , esc_url( get_permalink() ) ), '</a></h2>' );
            }
            //storefront_post_taxonomy();
          ?>
        </div>

        <div class="archive__post-link">
          <a href="<?php echo get_the_permalink();?>" class="view-post__button button button--primary">
            <p>View More</p>
          </a>
        </div>

      </article>
    <?php
  }
}
