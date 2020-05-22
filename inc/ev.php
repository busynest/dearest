<?php
/* ---------------------------------------------------------------------- */

/**
 *
 *
 * CPT -- EV Post
 *
 */

function av_cpt_evpost() {
	$supports = array(
		'title', // post title
		'editor', // post content
		'thumbnail', // featured images

	);

	$labels = array(
		'name' => _x('Electric Vehicles', 'plural'),
		'singular_name' => _x('Electric Vehicle', 'singular'),
		'menu_name' => _x('Electric Vehicles', 'admin menu'),
		'name_admin_bar' => _x('Electric Vehicles', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New Electric Vehicle'),
		'new_item' => __('New Electric Vehicles'),
		'edit_item' => __('Edit Electric Vehicles'),
		'view_item' => __('View Electric Vehicles'),
		'all_items' => __('All Electric Vehicles'),
		'search_items' => __('Search Electric Vehicles'),
		'not_found' => __('No Electric Vehicles found.'),
	);

	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'taxonomies' => array('post_tag'),
		'rewrite' => array('slug' => 'ev'),
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true
	);
	register_post_type('ev', $args);
}
add_action('init', 'av_cpt_evpost');

/* ---------------------------------------------------------------------- */


/**
 *
 *
 * Spec Metabox and Main Info Metabox for EV post
 *
 */
/**
* Meta box display callback.
*
* @param WP_Post $post Current post object.
*/

function ev_specs_display_callback( $post ) {
  include plugin_dir_path( __FILE__ ) . './meta-specs-form.php';
}

function ev_main_info_display_callback( $post ) {
  include plugin_dir_path( __FILE__ ) . './meta-main-info-form.php';
}

function ev_specs_register_meta_boxes() {
  add_meta_box( 'ev_specs', __( 'EV Specs', 'ev_specs' ), 'ev_specs_display_callback', 'ev', 'side' );
}
add_action( 'add_meta_boxes', 'ev_specs_register_meta_boxes' );

function ev_main_info_register_meta_boxes() {
  add_meta_box( 'ev_main_info', __( 'Main info', 'ev_main_info' ), 'ev_main_info_display_callback', 'ev', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ev_main_info_register_meta_boxes' );








/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function ev_save_meta_box( $post_id ) {

	if( 'ev' != get_post_type( $post_id ) )
  return;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if (get_post_status($post_id) === 'auto-draft') {
    return;
	}

  $fields = [
  	'ev_info__make',
		'ev_info__model',
		'ev_info__start-year',
    'ev_info__end-year',
		//'ev_info__price-usd',           //To be removed later
    'ev_info__price-cad',
    // 'ev_info__price-euro',          //To be removed later
    // 'ev_info__price-inr',           //To be removed later
		'ev_info__url',
    'ev_info__feature',
    'ev_info__description',
		'ev_specs__seating',
		// 'ev_specs__voltage',            //To be removed later
		'ev_specs__voltage-new',
		'ev_specs__body',
		'ev_specs__doors',
  	'ev_specs__chargetime',
    // 'ev_specs__chargetime-new',
		'ev_specs__quickcharge',
		'ev_specs__batterytype',
		// 'ev_specs__maxspeed',           //To be removed later
		'ev_specs__maxspeed-metric',
		// 'ev_specs__range',              //To be removed later
    'ev_specs__range-metric'
  ];





  foreach ( $fields as $field ) {
    if ( array_key_exists( $field, $_POST ) ) {
        update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
    }
 	}

}


add_action( 'save_post', 'ev_save_meta_box' );



function set_post_title( $post ) {

	if( 'ev' != get_post_type( $post_id ) )
  return;

  ?>
    <script type="text/javascript">
	    jQuery(document).ready(function($) {
	    	$("#title").prop("readonly", true);
	    	$("#ev_info__make, #ev_info__model").on("input", function () {
	    		var $title = $("#ev_info__make").val() + ' ' + $("#ev_info__model").val();
	        $("#title").val($title);

	      });
	    });
    </script>
    <?php
} // set_post_title
add_action( 'edit_form_after_title', 'set_post_title' );


/* ---------------------------------------------------------------------- */



/**
 *
 *
 * EV post content
 *
 */




//Post indiviual vehicle in archive page (1 call)
if ( ! function_exists( 'av_post_content' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0. 0
	 */
	function av_post_content() {

    $region = $_COOKIE['site_region'];
    $archive_post_src = get_the_post_thumbnail_url();
    $archive_year = esc_attr( get_post_meta( get_the_ID(), 'ev_info__start-year', true ));
    $archive_range = esc_attr( get_post_meta( get_the_ID(), 'ev_specs__range-metric', true ));

    if (!$archive_post_src) : $archive_post_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

    if (!$archive_year) : $archive_year = 'N/A';
    endif;

    if (!$archive_range == 0) {
      if ($region == 'usa') {
        $archive_range = $archive_range / 1.609;
        $archive_range = round($archive_range, -1);
        $archive_range = (string)$archive_range . ' miles';
      } else {
        round($archive_range, -2);
        $archive_range = (string)$archive_range . ' km';
      }
    } else {
      $archive_range = 'N/A';
    }

    $pull_price = esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-cad', true ));
    $price = currencyConversion($pull_price);



		?>
  		<article id="post-<?php the_ID(); ?>" <?php post_class('av_archive__article'); ?>>
        <div class="archive__img" style="background-image:url(<?php echo $archive_post_src ?>)">

          <?php
            //ADD FEATURED TAG TO ARTICLE POST
            $get_featured = esc_attr( get_post_meta( get_the_ID(), 'ev_info__feature', true ));
            if ($get_featured == 'enable'):  echo '<div class="av__feature">Featured</div>';
            endif;
          ?>

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

        <div class="archive__specs">

          <div class="specs__display">
            <p class="archive-specs__p archive-specs__partition">
              <img class="archive-specs__img" src="https://www.alter-verse.com/wp-content/uploads/2019/03/iconfinder_calendar-date-events-schedule-time_3828108.png" alt="" />
              <?php echo $archive_year; ?>
            </p>
          </div>

          <div class="specs__display">
            <p class="archive-specs__p">
              <img class="archive-specs__img" src="https://www.alter-verse.com/wp-content/uploads/2019/04/work-tools.png" alt="" />
              <?php echo $archive_range;?>
            </p>
          </div>

          <div class="specs__display specs__display_price">
            <?php echo $price; ?>
          </div>

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

//Post single vehicle title (1 call)
if ( ! function_exists( 'av_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_post_header() {
		?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			//storefront_posted_on();
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			if ( 'post' == get_post_type() ) {
				storefront_posted_on();
			}

			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

//Post individual specs of a vehicle (1 call)
if ( ! function_exists( 'av_post_content_single' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_post_content_single() {

    //Defaults
    $region = $_COOKIE['site_region'];
    $specs_checked = [];

    //Define specifications
    $specs = [
      'Seating' => 'ev_specs__seating',
      'Voltage' => 'ev_specs__voltage-new',
      'Body' => 'ev_specs__body',
      'Doors' => 'ev_specs__doors',
      'Charge Time' => 'ev_specs__chargetime',
      'Quick Charge' => 'ev_specs__quickcharge',
      'Battery Type' => 'ev_specs__batterytype',
      'Max Speed' => 'ev_specs__maxspeed-metric',
      'Range' => 'ev_specs__range-metric'
      ];

    $pull_price = esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-cad', true ));
    $price = currencyConversion($pull_price);

    foreach ( $specs as $key => $value ) {
      $meta_value = esc_attr( get_post_meta( get_the_ID(), $value, true ));

      if (!empty($meta_value)) {
        if ($key == "Voltage") {
          $true_value = $meta_value . 'V';
          } else if ($key == 'Max Speed' && $region == 'usa') {
          $true_value = (round($meta_value * 0.621371, -1)) . 'mph';
          } else if ($key == 'Max Speed') {
          $true_value = $meta_value . 'km/h';
          } else if ($key == 'Range' && $region == 'usa') {
          $true_value = (round($meta_value * 0.621371, -1)) . 'miles';
          }else if ($key == 'Range') {
          $true_value = $meta_value . 'km';
          }else {
          $true_value = $meta_value;
          }
        $arr = array($key => $true_value);
        array_push($specs_checked, $arr);
        }
   	}



    //Check if an image exists, otherwise use default
    $image_post_src = get_the_post_thumbnail_url();
    if (!$image_post_src): $image_post_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

		?>
		<div class="post__content">
      <div class="content__preview" style="background-image:url(<?php echo $image_post_src ?>)">

        <?php
          //Check if posting is a featured product
          $feature_post = esc_attr( get_post_meta( get_the_ID(), 'ev_info__feature', true ));
          if ($feature_post == "enable"): echo '<div class="archive-single__feature">featured</div>';
          endif;
        ?>

        <div class="preview__price-year">
          <p class="price-year__p">MSRP</p>
          <div class="price-year__p price-year__price">
            <div class="price">
              <?php
                echo $price;
              ?>
            </div>
          </div>


          <p class="price-year__p price-year__year">
            <?php
              $start_year = esc_attr( get_post_meta( get_the_ID(), 'ev_info__start-year', true ));
              $end_year = esc_attr( get_post_meta( get_the_ID(), 'ev_info__end-year', true ));
              if (!empty($end_year)) {
                echo $start_year . ' - ' . $end_year;
              } else {
                echo $start_year;
              }
            ?>
          </p>
        </div>


      </div><!-- End of content-preview-->

      <div class="content__specs">
        <div class="specs__list">
          <table class="list__table">
            <tr>
              <th colspan="2" class="list__head">Specifications:</th>
            </tr>
            <?php
              foreach ( $specs_checked as $arr) {
                foreach ($arr as $key => $value) {
                  echo '
                  <tr class="list__rows">
                    <td>' . $key . '</td>
                    <td>' . $value . '</td>
                  </tr>';
                }
             	}
            ?>
          </table>
        </div>
        <div class="specs__more-info">
          <p>For more information on this vehicle, visit:</p>
          <a href="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__url', true ));?>" target="_blank" class="more-info__visit button button--primary">
            Visit Site
          </a>
        </div>
      </div>

    </div>
    <div class="av_single__description">
      <p>
        <?php //echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__description', true ));?>
        <?php the_content();?>
      </p>
    </div>
		<?php
	}
}
