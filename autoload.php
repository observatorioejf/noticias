<?php

spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', __DIR__ . DIRECTORY_SEPARATOR . $class . '.php'));
});
