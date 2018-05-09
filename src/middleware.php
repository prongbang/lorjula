<?php
// Application middleware

use App\Utils\TokenGenerator;
use App\Utils\IPUtil;

// e.g: $app->add(new \Slim\Csrf\Guard);
$container = $app->getContainer();
// $container['csrf'] = function ($c) {
//     return new \Slim\Csrf\Guard;
// };
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};

// Register middleware for all routes
// If you are implementing per-route checks you must not add this
$app->add($container->get('csrf'));

// Enable CORS
$app->options('/api/v1/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

// This is the middleware
// It will add the Access-Control-Allow-Methods header to every request
// Validate Token

$app->add(function($request, $response, $next) use ($app) {

    $ip = IPUtil::get_ip_address();
    // $ip = $request->getServerParam('REMOTE_ADDR');
    $path = $request->getUri()->getPath();
    $method = $request->getMethod();
    $container = $app->getContainer();

    if(strpos($path, '/api/v1/') > -1) {

        if($method == "OPTIONS" || $method == "options") {
            $container->get("logger")->error("$ip $method $path");
            $response = $next($request, $response);
        } else {

            try {

                $access_token = $request->getHeader("Authorization"); 

                if(count($access_token) == 0) {
                    $container->get("logger")->error("$ip $method $path Token Not found");
                    return unAuthorization($response);
                } else {
                    $access_token = $access_token[0];
                    if(TokenGenerator::validate($access_token)) {
                        $container->get("logger")->info("$ip $method $path");
                        $response = $next($request, $response);
                        return corsEnable($response);
                    } else {
                        $container->get("logger")->error("$ip $method $path Unauthorization");
                        return unAuthorization($response);
                    }
                }
            } catch(Exception $e) {
                $container->get("logger")->error("$ip $method $path $e");
            }
        }
    } else {
        $container->get("logger")->error("$ip $method $path");
        $response = $next($request, $response);
    }

    return $response;
});

function unAuthorization($response) {
    return $response->withStatus(401)
    ->withHeader('Content-Type', 'application/json')
    ->withJson(array("message" => "Access credentials not supplied"));
}

function corsEnable($response) {
    return $response
    ->withHeader('Access-Control-Allow-Origin', 'https://lorjula.com')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
}