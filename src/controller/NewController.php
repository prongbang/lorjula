<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Slim\Csrf\Guard;
use App\Controller\Controller;
use App\Model\Post;

class NewController extends Controller {
    
    private $csrf;
    private $logger;
    private $view;

    public function __construct(Guard $csrf, Logger $logger, $view){
        $this->csrf     = $csrf;
        $this->logger   = $logger;
        $this->view     = $view;
    }

    public function index(RequestInterface $request, ResponseInterface $response, $args){
        $offset = $args['offset'];
        $limit = $args['limit'];
        if (is_numeric($offset) && is_numeric($limit)) {
            $results  = Post::where('status', 'PUBLISHED')->orderBy('id', 'desc')->take($limit)->skip($offset)->get();
            if($results != null) 
                return $response->withJson($results);
        }
        return $response->withStatus(404)->withJson(array('message' => 'Not found'));
    }

    public function throwException(RequestInterface $request, ResponseInterface $response, array $args){
        $this->logger->info("GET '/throw' route");
        throw new \Exception('testing errors 1.2.3..');
    }
}