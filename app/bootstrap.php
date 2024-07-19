<?php

session_start();

require_once 'app/config/config.php';
require_once 'app/core/model.php';
require_once 'app/core/controller.php';
require_once 'app/core/view.php';
require_once 'app/core/route.php';
require_once 'app/core/db.php';
require_once 'app/core/auth.php';
require_once 'app/models/user_model.php';
require_once 'app/models/vkuser_model.php';
require_once 'app/helpers/sqliteDbManager.php';
require_once 'app/helpers/randomString.php';
require_once 'app/logger/logger.php';

$db_file = new SQLiteDbManager();
$db_file->initDB();

Route::start();

