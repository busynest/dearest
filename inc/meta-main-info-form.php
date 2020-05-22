
<!-- META DATA - Main Info -->

<div class="meta-box">
    <style scoped>
        .meta-box {
            display: grid;
            grid-template-columns: 200px 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .meta-box__item{
            display: contents;
        }
.clear-meta label, .clear-meta input {background-color: #96c6f2; display: none}
    </style>



    <!-- **********************************
          MAKE and MODEL
     ********************************** -->

    <p class="meta-options meta-box__item">
        <label for="ev_info__make">Make</label>
        <input
			type="text"
			name="ev_info__make"
			id="ev_info__make"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__make', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item">
        <label for="ev_info__model">Model</label>
        <input
			type="text"
			name="ev_info__model"
			id="ev_info__model"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__model', true ) ); ?>">
    </p>

    <!-- **********************************
          START and END YEAR
     ********************************** -->

    <p class="meta-options meta-box__item">
        <label for="ev_info__start-year">Start Year</label>
        <input
      type="text"
      name="ev_info__start-year"
      id="ev_info__start-year"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__start-year', true ) ); ?>">
    </p>
  	<p class="meta-options meta-box__item">
        <label for="ev_info__end-year">End Year (optional)</label>
        <input
      type="text"
      name="ev_info__end-year"
      id="ev_info__end-year"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__end-year', true ) ); ?>">
    </p>

    <!-- **********************************
          PRICE and CURRENCIES
     ********************************** -->

    <p class="meta-options meta-box__item  clear-meta">
        <label for="ev_info__price-usd">MSRP Price (USD)</label>
        <input
			type="number"
			name="ev_info__price-usd"
			id="ev_info__price-usd"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-usd', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item">
        <label for="ev_info__price-cad">MSRP Price (CAD)</label>
        <input
			type="number"
      min="0"
			name="ev_info__price-cad"
			id="ev_info__price-cad"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-cad', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item  clear-meta">
        <label for="ev_info__price-euro">MSRP Price (EUR)</label>
        <input
      type="number"
      name="ev_info__price-euro"
      id="ev_info__price-euro"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-euro', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item  clear-meta">
        <label for="ev_info__price-inr">MSRP Price (INR)</label>
        <input
      type="number"
      name="ev_info__price-inr"
      id="ev_info__price-inr"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-inr', true ) ); ?>">
    </p>

    <!-- **********************************
          EXTERNAL LINK
     ********************************** -->

    <p class="meta-options meta-box__item">
        <label for="ev_info__url">URL (To view more info)</label>
        <input
      type="text"
      name="ev_info__url"
      id="ev_info__url"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__url', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item">
      <label for="ev_info__feature">Featured?</label>
      <input type="checkbox" id="feature_meta_box">
      <input
        type="text"
        name="ev_info__feature"
        id="ev_info__feature"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__feature', true ) ); ?>"
        style="display: none;"
        >
    </p>
    <p class="meta-options meta-box__item">
        <label for="ev_info__description">Description</label>
        <input
      type="text"
      name="ev_info__description"
      id="ev_info__description"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__description', true ) ); ?>">
    </p>


</div>


<script>
  var featureInput = jQuery('#ev_info__feature');
  var featureMeta = jQuery('#feature_meta_box');

  if (featureInput.attr('value') == 'enable') {
    featureMeta.prop('checked', true);
    console.log(featureInput.attr('value'));
  } else {
    featureMeta.prop('checked', false);
    featureInput.removeAttr('value');
    console.log(featureInput.attr('value'));
  }

  jQuery('#feature_meta_box').change(function() {
    if (jQuery(this).is(':checked')) {
      featureInput.attr('value', 'enable');
    } else {
      //featureInput.removeAttr('value');
      featureInput.attr('value', '');
    }
})
</script>
