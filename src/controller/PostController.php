<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
// use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Slim\Csrf\Guard;
use App\Controller\Controller;
use App\Model\Post;
use App\Model\Category;

class PostController extends Controller {
    
    private $prefix = '/api/v1/post';
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
        $offset = $args['offset'];
        $limit = $args['limit'];
        if (is_numeric($offset) && is_numeric($limit)) {
            $results  = Post::where('status', 'PUBLISHED')->orderBy('id', 'desc')->take($limit)->skip($offset)->get();
            if($results != null) 
                return $response->withJson($results);
        }
        return $response->withStatus(404)->withJson(array('message' => 'Not found'));
    }

    public function home(RequestInterface $request, ResponseInterface $response, $args) {
        $id = $args['id'];
        if(is_numeric($id)) {
            $data = Post::where('id', $id)
            ->where('status', 'PUBLISHED')
            ->get()->first();
            if($data != null) {
                return $this->view->render($response, 'post.html', array('page'=>'', 'post' => $data));
            }
        }
        return $this->view->render($response, 'post.html', array('page'=>''));
    }

    public function findPostByCtyId(RequestInterface $request, ResponseInterface $response, $args) {
        $id = $args['id'];
        $offset = $args['offset'];
        $limit = $args['limit'];
        if(is_numeric($id) && is_numeric($offset) && is_numeric($limit)) {
            $data = Post::where('category_id', $id)
            ->where('status', 'PUBLISHED')
            ->orderBy('id', 'desc')
            ->take($limit)->skip($offset)
            ->get();
            if($data != null)
                return $response->withJson($data);
        }
        return $response->withStatus(404)->withJson(array('message' => 'Not found'));
    }

    public function findGroupCty(RequestInterface $request, ResponseInterface $response, $args) {
        $offset = $args['offset'];
        $limit = $args['limit'];
        if(is_numeric($offset) && is_numeric($limit)) {
            $ctys = Category::all();
            if ($ctys != null) {
                $results = array();
                foreach($ctys as $c) {
                    $c['posts'] = Post::where('category_id', $c->id)
                    ->where('status', 'PUBLISHED')
                    ->orderBy('id', 'desc')
                    ->take($limit)->skip($offset)
                    ->get();
                }
                return $response->withJson($ctys);
            }
        }
        return $response->withStatus(404)->withJson(array('message' => 'Not found'));
    }

    public function findById(RequestInterface $request, ResponseInterface $response, $args) {
        $id = $args['id'];
        if(is_numeric($id)) {
            $data = Post::where('id', $id)
            ->where('status', 'PUBLISHED')
            ->get()->first();
            if($data != null) {
                try {
                    $data->views = $data->views + 1;
                    $data->save();
                } catch(Exception $e){}
                return $response->withJson($data);
            }
        }
        return $response->withStatus(404)->withJson(array('message' => 'Not found'));
    }



}
