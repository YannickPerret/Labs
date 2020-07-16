<?php

require '../app/Autoloader.php';
App\Autoloader::register();

require 'Template/default.php';

ob_start();


if (isset($_GET['p']))
{
 $_GET['p'] == "home";
 require '../pages/index.php';

}
else if($_GET['p'] === "slider")
{
    require '../public/slider.php';
}
else
{
    require '../public/index.php';
}

ob_get_clean();