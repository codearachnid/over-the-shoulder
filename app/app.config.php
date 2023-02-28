<?php

include_once 'db.class.php';

DB::$user = '';
DB::$password = '';
DB::$dbName = '';

$tbl_room = 'rooms';
$tbl_track = 'track';
$tbl_user = 'users';

$room_expire = '30 minutes';
