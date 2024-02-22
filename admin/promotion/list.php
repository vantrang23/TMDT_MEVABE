<?php
session_start();
require_once '../../models/user.php';
require_once '../../libraries/connect.php';
$promotion_list = get_promotion_list($conn);
require 'list.tpl.php';


