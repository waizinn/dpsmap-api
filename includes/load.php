<?php
spl_autoload_register(function ($class) {
    $class = strtolower($class);
    include_once 'includes/class/' . $class . '.php';
});
