<?php

include_once '../app/app.config.php';
include_once '../app/utils.php';

$r = [];
$r['s_msg'] = '';
$r['s_code'] = '';
$r['status'] = 'fail';

if( isset($_REQUEST['action']) ){
  switch ( $_REQUEST['action'] ){
	case 'client':
		
	if( !empty($_REQUEST['x']) && !empty($_REQUEST['y']) ){
		DB::insert('track', [
			'room_key' => $_REQUEST['room_key'],
			'm_x' => $_REQUEST['x'],
			'm_y' => $_REQUEST['y'],
			'user_type' => 'client',
			'timestamp' => date('Y-m-d H:m:s'),
		  ]);
	  }
		  	
	  $position = DB::queryFirstRow("SELECT `track`.`m_x` AS `x`, `track`.`m_y` AS `y` FROM track WHERE room_key=%s AND user_type = 'observer' ORDER BY ID DESC LIMIT 1", $_REQUEST['room_key']);

	  $r['position'] = $position;
	  $r['s_msg'] = sprintf( "tracking '%s'", $_REQUEST['room_key'] );
	  $r['status'] = 'success';
	  $r['s_code'] = '200';
	  
	  break;
	case 'observer':
	  
	  
	  if( !empty($_REQUEST['x']) && !empty($_REQUEST['y']) ){
	  	DB::insert('track', [
		  	'room_key' => $_REQUEST['room_key'],
		  	'm_x' => $_REQUEST['x'],
		  	'm_y' => $_REQUEST['y'],
		  	'user_type' => 'observer',
		  	'timestamp' => date('Y-m-d H:m:s'),
			]);
		}
		
		$position = DB::queryFirstRow("SELECT `track`.`m_x` AS `x`, `track`.`m_y` AS `y` FROM track WHERE room_key=%s AND user_type = 'client' ORDER BY ID DESC LIMIT 1", $_REQUEST['room_key']);
		
		  $r['position'] = $position;
		  $r['s_msg'] = sprintf( "tracking '%s'", $_REQUEST['room_key'] );
		  $r['status'] = 'success';
		  $r['s_code'] = '200';
		  
	  break;
	default:
	  $r['s_code'] = '404';
	  $r['s_msg'] = 'nothing to do';
	  break;  
  }
} else {
  $r['s_msg'] = 'incorrect parameters';
  $r['s_code'] = '500';
}

echo json_encode($r);