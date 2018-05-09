<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Slim\Csrf\Guard;
use App\Model\Post;
use App\Controller\Controller;
use App\Utils\TokenGenerator;


class DefaultController extends Controller {
    
    private $csrf;
    private $logger;
    private $view;
    private $db;
    
    public function __construct(Guard $csrf, Logger $logger, $view, $db) {
        $this->csrf     = $csrf;
        $this->logger   = $logger;
        $this->view     = $view;
        $this->db       = $db;
    }

    public function index(RequestInterface $request, ResponseInterface $response, $args){
        
        // setcookie("_xs", TokenGenerator::generate(), time() + (86400 * 30) * 30, "/");

        $uri = $request->getUri();
        $url = $uri->getPath();
        $pat = '/post/';
        $pos = strpos($url, $pat);
        $id = substr($url, $pos + (strlen($pat)));
        if($pos !== FALSE) {
            $data = Post::where('id', intval($id))
            ->where('status', 'PUBLISHED')
            ->get()->first();
            if($data != null) {
                return $this->view->render($response, 'index.html', array('page'=>'post', 'post' => $data));
            }
        }

        // Render index view
        return $this->view->render($response, 'index.html', array('page'=>'home'));
        // $clientIp = $request->getAttribute('ip_address');
        // $clientIp = $request->getIp();
        // $clientIp = $request->getServerParam('REMOTE_ADDR');
        // echo $clientIp."IP";
    }

    public function throwException(RequestInterface $request, ResponseInterface $response, array $args){
        $this->logger->info("GET '/throw' route");
        throw new \Exception('testing errors 1.2.3..');
    }
}