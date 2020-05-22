<?php

//Append search filter (2 call)
if ( ! function_exists( 'av_search_filter' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_search_filter() {
		?>

    <div class="av_filter">
      <div class="av_filter__search">
        <?php echo do_shortcode( '[searchandfilter fields="search" submit_label="Filter" class="archive-filter__plugin"]' ); ?>
      </div>
      <form class="av_filter__sort" method="post">
        <div>Sort By:</div>

          <div>
            <ul>
              <input type="radio" id="sort_model_asc" name="sortby" value="model_asc">
              <label for="sort_model_asc">Model <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_model_desc" name="sortby" value="model_desc">
              <label for="sort_model_desc">Model <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_year_asc" name="sortby" value="year_asc">
              <label for="sort_year_asc">Year <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_year_desc" name="sortby" value="year_desc">
              <label for="sort_year_desc">Year <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_range_asc" name="sortby" value="range_asc">
              <label for="sort_range_asc">Range <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_range_desc" name="sortby" value="range_desc">
              <label for="sort_range_desc">Range <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_price_asc" name="sortby" value="price_asc">
              <label for="sort_price_asc">Price <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_price_desc" name="sortby" value="price_desc">
              <label for="sort_price_desc">Price <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_feature" name="sortby" value="feature">
              <label for="sort_feature">Featured</label>
            </ul>
          </div>



      </form>

    </div>
		<?php

    $sortby = $_COOKIE['archive_sort'];
    $region = $_COOKIE['site_region'];

    $sort_currencies = [
      'usa' => 'usd',
      'can' => 'can',
      'eur' => 'euro',
      'inr' => 'inr'
      ];

    $usecurrency = $sort_currencies[$region];


    $sort_args = [
      //Default
      '' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1,
        'meta_query'      => array(
                          array(
                          'key' => 'ev_info__feature',
                          'value' => 'enable'
                            )
                          )
        ),
      'model_asc' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1
        ),
      'model_desc' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'DESC',
        'posts_per_page'  => -1
        ),
      'year_asc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_info__start-year',
        'orderby'         => 'meta_value_num',
        'order'           => 'ASC',
        'posts_per_page'  => -1
        ),
      'year_desc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_info__start-year',
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
        'posts_per_page'  => -1
        ),
      'range_asc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_specs__range-metric',
        'orderby'         => 'meta_value_num',
        'order'           => 'ASC',
        'posts_per_page'  => -1
        ),
      'range_desc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_specs__range-metric',
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
        'posts_per_page'  => -1
        ),

      'feature' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1,
        'meta_query'      => array(
                          array(
                          'key' => 'ev_info__feature',
                          'value' => 'enable'
                            )
                          )
        ),
      'feature_not' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1,
        'meta_query'      => array(
                          array(
                          'key' => 'ev_info__feature',
                          'value' => ''
                            )
                          )
        ),
        'price_asc' => array(
          'post_type'       => 'ev',
          'meta_key'        => 'ev_info__price-cad',
          'orderby'         => 'meta_value_num',
          'order'           => 'ASC',
          'posts_per_page'  => -1
          ),
        'price_desc' => array(
          'post_type'       => 'ev',
          'meta_key'        => 'ev_info__price-cad',
          'orderby'         => 'meta_value_num',
          'order'           => 'DESC',
          'posts_per_page'  => -1
          ),

    ];




  av_archive_post($sort_args[$sortby]);


  if ($sortby == 'feature' || $sortby == '') {
    av_archive_post($sort_args['feature_not']);
    }
  }
}
