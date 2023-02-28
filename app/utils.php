<?php

function make_room_key( $length = 6 ) {
	$str_result = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr( str_shuffle( $str_result ), 0, $length );
}