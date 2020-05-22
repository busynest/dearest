<?php

//Get currency based on region
function currencyConversion($price) {
  $region = $_COOKIE['site_region'];
  $cad_to_usd = 0.74;
  $cad_to_euro = 0.66;
  $cad_to_inr = 52.08;

  if(!empty($price)) {
    if ($region == 'can') {
      return '$' . $price . '<span>CAD</span>';
      } else if ($region == 'usa') {
      return '$' . (round($price * $cad_to_usd, -2)) . '<span>USD</span>';
      } else if ($region == 'eur') {
      return '&euro;' . (round($price * $cad_to_euro, -2));
      } else if ($region == 'inr') {
      return '&#8377' . (round($price * $cad_to_inr, -2));
      }
    } else {
      return "Current price unavailable";
    }
  }