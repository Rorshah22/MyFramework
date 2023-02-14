<?php

return [

    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~article/(\d)+^$~' => [\MyProject\Controllers\ArticleController::class, 'view']
];
