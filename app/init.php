<?php

require_once 'core/App.php';
require_once 'core/Controller.php';

require_once 'config/config.php';

require_once 'core/Database.php';

// Load Helpers
require_once 'helpers/LogHelper.php';

// Autoload class models
spl_autoload_register(function ($className) {
    require_once 'models/' . $className . '.php';
});
