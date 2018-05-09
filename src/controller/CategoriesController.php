<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Slim\Csrf\Guard;
use App\Controller\Controller;
use App\Model\Category;
use App\Model\Post;

class CategoriesController extends Controller {
    
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

    public function index(RequestInterface $request, ResponseInterface $response, $args) {

        return $response->withJson(Category::all());
    }

    public function home(RequestInterface $request, ResponseInterface $response, $args) {
        $id = $args['id'];
        if(is_numeric($id)) {
            $data = Category::find($id);
            if($data != null)
                return $this->view->render($response, 'index.html', array('page'=>'category', 'category'=>$data));
        }
        return $this->view->render($response, 'index.html', array('page'=>''));
    }  

    public function findById(RequestInterface $request, ResponseInterface $response, $args) {
        $id = $args['id'];
        if(is_numeric($id)) {
            $data = Category::find($id);
            if($data != null)
                return $response->withJson($data);
        }
        return $response->withStatus(404)->withJson(array('message' => 'Not found'));
    }

}