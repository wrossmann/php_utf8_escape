<?php
use wrossmann\utf8_escape\Escaper;

if( ! function_exists('utf8_escape') ) {
	function utf8_escape($string, $skip_low=true) {
		return Escaper::escape_string($string, $skip_low);
	}
}

