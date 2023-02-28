<?php

include_once 'db.class.php';

DB::$user = 'ssotest';
DB::$password = 'password';
DB::$dbName = 'screenshare';

$tbl_room = 'rooms';
$tbl_track = 'track';
$tbl_user = 'users';

$room_expire = '30 minutes';