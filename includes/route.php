<?php
$url_ = $_SERVER['REQUEST_URI'];
$url = parse_url($url_)['path'];

if ($url == '/api/') {
    require 'api/index.php';
    exit();
}

$ext = pathinfo($url_, PATHINFO_EXTENSION);
$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 30;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links = (isset($_GET['links'])) ? $_GET['links'] : 7;

require_once "includes/config.php";
require_once "includes/load.php";
require_once "includes/data.php";
if ($ext != '') {
    header("location:" . "/");
    exit();
} elseif ($url == '/reset') {
    require 'view/reset.php';
    exit();
} elseif ($url != '/login' && $_SESSION['auth'] != "logined" && !isset($_POST['username'])) {
    require 'view/login-page.php';
    exit();
} else {
    switch ($url) {
        case '':
            require 'view/home.php';
            break;
        case '/':
            require 'view/home.php';
            break;
        case '/index':
            require 'view/home.php';
            break;

        case '/home':
            require 'view/home.php';
            break;

        case '/dps':
            require 'view/dps.php';
            break;

        case '/map-download':
            require 'view/map-download.php';
            break;

        case '/property':
            require 'view/property.php';
            break;

        case '/users':
            require 'view/users.php';
            break;
        case '/edit-users':
            require 'view/edit-users.php';
            break;

        case '/api-key':
            require 'view/api-key.php';
            break;
        case '/edit-api-key':
            require 'view/edit-api-key.php';
            break;

        case '/api-usage':
            require 'view/api-usage.php';
            break;

        case '/home-setting':
            require 'view/home-setting.php';
            break;

        case '/login':
            require 'view/login.php';
            break;

        case '/save':
            require 'save.php';
            break;

        case '/logout':
            require 'view/logout.php';
            break;

        case '/upload':
            require 'control/upload.php';
            break;

        case '/control/update':
            require 'control/update.php';
            break;

        case '/control/load':
            require 'control/load.php';
            break;

        case '/iframe':
            require 'control/iframe.php';
            break;

        case '/export':
            require 'export/dps.php';
            break;

        case '/export/map-download':
            require 'export/map-download.php';
            break;

        case '/export/property':
            require 'export/property.php';
            break;

        default:
            http_response_code(404);
            require '404.php';
            break;
    }
}
