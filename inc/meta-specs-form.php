
<!-- META DATA - EV Specs -->

<div class="meta-box">
    <style scoped>
        .meta-box {
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .meta-box__item{
            display: contents;
        }
        .clear-meta label, .clear-meta input {background-color: #96c6f2; display: none;}
    </style>


    <p class="meta-options meta-box__item">
        <label for="ev_specs__seating">Seating</label>
        <input
			type="number"
      min="0"
			name="ev_specs__seating"
			id="ev_specs__seating"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__seating', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item clear-meta">
        <label for="ev_specs__voltage">Voltage (temporary)</label>
        <input
			type="text"
			name="ev_specs__voltage"
			id="ev_specs__voltage"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__voltage', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__voltage-new">Voltage (V)</label>
        <input
      type="number"
      min="0"
      name="ev_specs__voltage-new"
      id="ev_specs__voltage-new"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__voltage-new', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__body">Body</label>
        <input
			type="text"
			name="ev_specs__body"
			id="ev_specs__body"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__body', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__doors">Doors</label>
        <input
			type="number"
      min="0"
			name="ev_specs__doors"
			id="ev_specs__doors"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__doors', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item">
        <label for="ev_specs__chargetime">Charge Time (temporary)</label>
        <input
			type="text"
			name="ev_specs__chargetime"
			id="ev_specs__chargetime"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__chargetime', true ) ); ?>">
    </p>
    <!-- <p class="meta-options meta-box__item ">
        <label for="ev_specs__chargetime-new">Est Charge Time (#hrs #min)</label>
        <input
			type="text"
			name="ev_specs__chargetime-new"
			id="ev_specs__chargetime-new"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__chargetime-new', true ) ); ?>">
    </p> -->
    <p class="meta-options meta-box__item clear-meta">
        <label for="ev_specs__quickcharge">Quick Charge (temporary)</label>
        <input
			type="text"
			name="ev_specs__quickcharge"
			id="ev_specs__quickcharge"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__quickcharge', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__quickcharge-new">Quick Charge (hrs)</label>
        <input
      type="number"
      min="0"
      name="ev_specs__quickcharge-new"
      id="ev_specs__quickcharge-new"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__quickcharge-new', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__batterytype">Battery Type (AH)</label>
        <input
			type="text"
			name="ev_specs__batterytype"
			id="ev_specs__batterytype"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__batterytype', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item clear-meta">
        <label for="ev_specs__maxspeed">Max Speed (temporary)</label>
        <input
			type="text"
			name="ev_specs__maxspeed"
			id="ev_specs__maxspeed"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__maxspeed', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__maxspeed-metric">Max Speed (km/h)</label>
        <input
      type="number"
      min="0"
      name="ev_specs__maxspeed-metric"
      id="ev_specs__maxspeed-metric"
      value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__maxspeed-metric', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item clear-meta">
        <label for="ev_specs__range">Range (temporary)</label>
        <input
			type="text"
			name="ev_specs__range"
			id="ev_specs__range"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__range', true ) ); ?>">
    </p>
    <p class="meta-options meta-box__item ">
        <label for="ev_specs__range-metric">Range (km)</label>
        <input
			type="number"
      min="0"
			name="ev_specs__range-metric"
			id="ev_specs__range-metric"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_specs__range-metric', true ) ); ?>">
    </p>
    <!-- <p style="grid-column: span 2; color: red;">*ALL ITEMS IN <span style="background-color: #96c6f2;padding: 2px 3px;color: #fff">BLUE</span> WILL BE DELETED LATER, PLEASE UPDATE ALL OTHER FIELDS*</p> -->
</div>
