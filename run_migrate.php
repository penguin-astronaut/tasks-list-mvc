<?php

require './autoload.php';

use Core\Migration;

$migration = new Migration();
$migration->migrate();