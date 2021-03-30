<?php
include_once __DIR__ . "/exceptions/NotFoundEx.php";

$routes = explode('/', $_SERVER['REQUEST_URI']);

$staticPagesCfg = json_decode(file_get_contents('config/route.json'), true);
try {
    if ($routes[1] == '') {
        if (empty($_COOKIE['token'])) {
            print file_get_contents(__DIR__ . "/templates/signup.html");
        }
    } elseif (($routes[1] == 'signup' || $routes[1] == 'signin') && (!empty($_COOKIE['token']))) {
        print file_get_contents(__DIR__ . "/templates/index.html");
    } elseif ($routes[1] == 'signin') {
        print file_get_contents(__DIR__ . "/templates/signin.html");
    } else {
        if (array_key_exists($routes[1], $staticPagesCfg))
            print file_get_contents(__DIR__ . "/templates/" . $staticPagesCfg[$routes[1]]);
        else throw new NotFoundEx();
    }
} catch (RuntimeException $exception) {
    include_once __DIR__ . "/templates/exception.html";
}