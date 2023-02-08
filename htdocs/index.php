<?php
spl_autoload_register(function (string $className) {
    $className = '/../src/' . str_ireplace('\\', '/', $className) . '.php';
    require_once __DIR__ . $className;
});

$route = $_GET['route'];

$isControllerFound = false;

$routes = require_once __DIR__ . '/../src/MyProject/routes.php';
foreach ($routes as $pattern => $controllerAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isControllerFound = true;
        break;
    }
}


if (!$isControllerFound) {
    echo 'Not Found';
    return;
}
unset($matches[0]);
$controllerName = $controllerAction[0];
$action = $controllerAction[1];

$controller = new $controllerName();
$controller->$action(...$matches);

