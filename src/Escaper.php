<?php
namespace wrossmann\utf8_escape;

class Escaper {
	/**
	 * Determine the length of a UTF8 sequence from the ordinal
	 * value of the leading byte.
	 *
	 * @param int $ord
	 * @retrun int
	 */
	public static function ord2seqlen($ord) {
		if($ord < 128){
			return 1;
		} else if($ord < 224) {
			return 2;
		} else if($ord < 240) {
			return 3;
		} else if($ord < 248) {
			return 4;
		} else {
			throw new \Exception("No support for 5 or 6 byte sequences.");
		}
	}

	/**
	 * Generate a series of UTF8 sequences from the input string.
	 *
	 * @param string $input
	 * @return \Iterable
	 */
	public static function utf8_seq_iter($input) {
		for($i=0,$c=strlen($input); $i<$c; ) {
			$bytes = self::ord2seqlen(ord($input[$i]));
			yield substr($input, $i, $bytes);
			$i += $bytes;
		}
	}

	/**
	 * Escape a single codepoint.
	 *
	 * @param string $codepoint
	 * @param bool $skip_low Skip escaping codepoints below 128
	 * @return string
	 */
	public static function escape_codepoint($codepoint, $skip_low=true) {
		$ord = mb_ord($codepoint);
		if( $skip_low && $ord < 128 ) {
			return $codepoint;
		} else {
			return sprintf("\\u%04x", $ord);
		}
	}

	/**
	 *	Escape a UTF8 string.
	 *
	 *	@param string $string
	 *	@param bool $skip_low Skip escaping codepoints below 128
	 *	@return string
	 */
	public static function escape_string($string, $skip_low=true) {
		$output = '';
		foreach( self::utf8_seq_iter($string) as $codepoint ) {
 		   $output .= self::escape_codepoint($codepoint, $skip_low);
		}
		return $output;
	}
}
