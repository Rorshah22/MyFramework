<?php

use MyProject\Exceptions\Forbidden;

//spl_autoload_register(function (string $className) {
//    $className = '/../src/' . str_ireplace('\\', '/', $className) . '.php';
//    require_once __DIR__ . $className;
//});
require __DIR__ . '/../vendor/autoload.php';

try {
    $route = $_GET['route'] ?? '';
    $routes = require_once __DIR__ . '/../src/MyProject/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);

        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }


    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];
    $controller = new $controllerName();
    $controller->$actionName(...$matches);

} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
    echo $e->getMessage();
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php',
        [
            'error' => $e->getMessage(),
            'user' => \MyProject\Models\Users\UsersAuthService::getUserByToken(),
            'categoryArticles' => \MyProject\Models\Articles\ArticleTheme::findAll('DESC')
        ],
        404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (Forbidden $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage(), 'user' => \MyProject\Models\Users\UsersAuthService::getUserByToken()], 403);
}
