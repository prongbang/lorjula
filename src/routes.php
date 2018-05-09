<?php

$app->get('/'                       , 'DefaultController:index' );
$app->get('/index.html'             , 'DefaultController:index' );
$app->get('/post/{id:[0-9]+}'       , 'PostController:home'     );
$app->get('/category/{id:[0-9]+}'   , 'CategoriesController:home');

// $nonce = microtime() . rand(0,100000);

// ##### WEB API ########################################################################################################################################
$app->group('/api', function () use ($app) {

    // Library group
    $app->group('/v1', function () use ($app) {

        // $app->get('/post/{offset:[0-9]+}/{limit:[0-9]+}'                        , 'PostController:index'            );
        $app->get('/post/{id:[0-9]+}'                                           , 'PostController:findById'         );
        $app->get('/post/category/{id:[0-9]+}/{offset:[0-9]+}/{limit:[0-9]+}'   , 'PostController:findPostByCtyId'  );
        $app->get('/post/category/{offset:[0-9]+}/{limit:[0-9]+}'               , 'PostController:findGroupCty'     );
        $app->get('/category'                                                   , 'CategoriesController:index'      );
        $app->get('/category/{id:[0-9]+}'                                       , 'CategoriesController:findById'   );
        $app->get('/news/{offset:[0-9]+}/{limit:[0-9]+}'                        , 'NewController:index'             );
        $app->get('/recommend/{offset:[0-9]+}/{limit:[0-9]+}'                   , 'RecommendController:index'       );
        $app->get('/popular/{offset:[0-9]+}/{limit:[0-9]+}'                     , 'PopularController:index'         );

    });

});
// ######################################################################################################################################################