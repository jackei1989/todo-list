<?php
include "bootstrap/init.php";


// connect to db and get tasks
$tasks = getTask();

include "tpl/tpl-index.php";