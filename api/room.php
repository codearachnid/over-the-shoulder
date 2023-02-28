<?php

include_once '../app/app.config.php';
include_once '../app/utils.php';

$r = [];
$r['s_msg'] = '';
$r['s_code'] = '';
$r['status'] = 'fail';

if( isset($_REQUEST['action']) ){
  switch ( $_REQUEST['action'] ){
    case 'make':
      $r['room_key'] = make_room_key();
      $r['expires'] = $room_expire;
  
      $room = DB::queryFirstRow('SELECT ID FROM rooms WHERE code=%s LIMIT 1', $r['room_key'] );
      
      if( empty($room) ){
        DB::insert('rooms', [
          'code' => $r['room_key'],
          'requested' => date('Y-m-d H:m:s'),
          'expires' => date('Y-m-d H:m:s', strtotime( 'NOW + ' . $r['expires'] )),
        ]);
      }
      
      $r['s_msg'] = sprintf( "room '%s' created successfully", $r['room_key'] );
      $r['status'] = 'success';
      $r['s_code'] = '200';
      
      break;
    case 'get':
      $room = DB::queryFirstRow('SELECT * FROM rooms WHERE requested < NOW() AND expires > NOW() LIMIT', );
      break;
    case 'validate':
      // TODO fix now expression
      // $room = DB::queryFirstRow('SELECT code AS `room_key`, expires FROM rooms WHERE code=%s AND (status IS NULL OR LOWER(status) <> "destroyed") AND requested < NOW() AND expires > NOW() LIMIT 1',  $_REQUEST['room_key'] );
      $room = DB::queryFirstRow('SELECT code AS `room_key`, expires FROM rooms WHERE code=%s AND (status IS NULL OR LOWER(status) <> "destroyed") LIMIT 1',  $_REQUEST['room_key'] );
      // print_r(DB::lastQuery());
        
      if( $room ) {
        $r['room'] = $room;
        $r['status'] = 'success';  
        $r['s_msg'] = 'room found';
        $r['s_code'] = '200';
      } else {
        $r['status'] = 'success';  
        $r['s_msg'] = 'room not found';
        $r['s_code'] = '404';
      }
      
      break;
    case 'destroy':
      DB::update('rooms', [
        'status' => 'destroyed'
      ], 'code=%s', $_REQUEST['room_key']);
      $r['s_code'] = '200';
      $r['s_msg'] = sprintf("room '%s' has been destroyed", $_REQUEST['room_key'] );
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