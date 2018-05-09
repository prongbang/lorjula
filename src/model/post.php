<?php 

namespace App\Model;

class Post extends \Illuminate\Database\Eloquent\Model {
    
    protected $tables = "posts";

    // public function findByOffset($offset, $limit) {
    //     $data = array();
    //     $sql_limit = "";
    //     $next = 0;
    //     $back = 0;
    //     $backto = 0;
    //     if(is_numeric($limit) && is_numeric($offset))  {
    //         $sql_limit = "LIMIT ? OFFSET ?"; 
    //         $next = intval($offset) + intval($limit);
    //         $back = intval($offset);
    //         if($back > 0) $backto = $back - intval($limit);
    //     } 
    //     $l = intval($limit);
    //     $o = intval($offset);
    //     $sql = "SELECT 
    //         ps.id, ps.category_id, ps.category_name, ps.title, ps.description, 
	// 		ps.path, ps.image, ps.medium, ps.small, ps.views, ps.create_dt, 
    //         ps.create_by, ps.update_dt, us.fullname as update_by, ps.flag
    //         FROM ( 
    //             SELECT 
    //                 p.id, p.category_id, c.name as category_name, 
    //                 p.title, p.description, p.path, p.image, 
    //                 p.medium, p.small, p.views, p.create_dt, 
    //                 u.fullname as create_by, p.update_dt, p.update_by, p.flag
    //             FROM post p 
    //             INNER JOIN user u 
    //             ON p.create_by = u.id 
    //             INNER JOIN category c 
    //             ON p.category_id = c.id 
    //         ) as ps 
    //         LEFT JOIN user us
    //         ON ps.update_by = us.id
    //         ORDER BY ps.id ASC $sql_limit
    //     ";
    //     if ($stmt = $this->db->prepare($sql)) { 
    //         $stmt->bind_param("ii", $l, $o);
    //         $stmt->execute(); 
    //         $result = $stmt->get_result();
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         $stmt->free_result();
    //         $stmt->close();
    //     }
    //     return array(
    //         'data'=> $data,
    //         'offset' => $o,
    //         'next'=> $next,
    //         'nextto'=> count($data) < $limit,
    //         'back' => $backto,
    //         'backto' => $back > 0
    //     );
    // }

    // public function findLastId() {
    //     $data = array();
    //     $sql = "SELECT id, category_id, title, description, image, medium, small, views, flag, create_dt, create_by, update_dt, update_by FROM post ORDER BY id DESC LIMIT 1";
    //     $stmt = $this->db->query($sql);
    //     // while ($row = $stmt->fetch()) {
    //     //     $data[] = $row;
    //     // }
    //     while ($row = mysqli_fetch_assoc($stmt)) {
    //         $data[] = $row;
    //     }
    //     return $data;
    // }

    // public function checkPostById($id) { 
    //     $data = array();
    //     $sql = "SELECT * FROM post WHERE id = ?";
    //     // $stmt = $this->db->prepare($sql);
    //     // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     // $stmt->execute();
    //     // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     // $data[] = $rows;
    //     if ($stmt = $this->db->prepare($sql)) {
    //         $id = intval($id."");
    //         $stmt->bind_param("i", $id);
    //         $stmt->execute(); 
    //         $result = $stmt->get_result();
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         $stmt->free_result();
    //         $stmt->close();
    //     }
    //     return $data;
    // }

    // public function findByIdForAdmin($id) {

    //     return $this->findByIdFunc($id, "");
    // }

    // public function findById($id) {
    //     $forApi = $api ? "AND (p.flag = 0 OR p.flag = 1)" : ""; 

    //     return $this->findByIdFunc($id, $forApi);
    // }

    // public function findByIdFunc($id, $forApi) {
    //     $data = array();
    //     $sql = "SELECT 
    //         ps.id, ps.category_id, ps.category_name, ps.title, ps.description, 
    //         ps.content, ps.path, ps.image, ps.medium, ps.small, ps.views, ps.create_dt, 
    //         ps.create_by, ps.update_dt, us.fullname as update_by 
    //         FROM ( 
    //             SELECT 
    //                 p.id, p.category_id, c.name as category_name, 
    //                 p.title, p.description, p.content, p.path, p.image, 
    //                 p.medium, p.small, p.views, p.create_dt, 
    //                 u.fullname as create_by, p.update_dt, p.update_by 
    //             FROM post p 
    //             INNER JOIN user u 
    //             ON p.create_by = u.id 
    //             INNER JOIN category c 
    //             ON p.category_id = c.id 
    //             WHERE p.id = ? $forApi
    //         ) as ps 
    //         LEFT JOIN user us
    //         ON ps.update_by = us.id
    //     ";
    //     if ($stmt = $this->db->prepare($sql)) {
    //         $id = intval($id."");
    //         $stmt->bind_param("i", $id);
    //         $stmt->execute(); 
    //         $result = $stmt->get_result();
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         $stmt->free_result();
    //         $stmt->close();
    //     }
        
    //     if(count($data) == 1) {
    //         // $data[0]['details'] = $this->findDetailByPostId($id);
    //     }

    //     return $data;
    // }

    // public function findDetailByPostId($id) {
    //     $data = array();
    //     $sql = 'SELECT id, post_id, image, desc_image, content, create_dt, update_dt FROM post_details pd WHERE pd.post_id = ?';

    //     if ($stmt = $this->db->prepare($sql)) {
    //         $id = intval($id);
    //         $stmt->bind_param("i", $id);
    //         $stmt->execute(); 
    //         $result = $stmt->get_result();
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         $stmt->free_result(); 
    //         $stmt->close();
    //     }
    //     return $data;
    // }
    
    // public function update($post) { 

    //     // เตรียม set sql
    //     // i - integer
    //     // d - double
    //     // s - string
    //     // b - BLOB
    //     $set = "";
    //     $type = "";
    //     $map = array();
    //     if(!empty($post['category_id'])) {
    //         $set .= "category_id = ?,";
    //         $type .= "i";
    //         array_push($map, intval($post['category_id'].""));
    //     }
    //     if(!empty($post['title'])) {
    //         $set .= "title = ?,";
    //         $type .= "s";
    //         array_push($map, $post['title']);
    //     }
    //     if(!empty($post['description'])) {
    //         $set .= "description = ?,";
    //         $type .= "s";
    //         array_push($map, $post['description']);
    //     }
    //     if(!empty($post['content'])) {
    //         $set .= "content = ?,";
    //         $type .= "s";
    //         array_push($map, $post['content']);
    //     }
    //     if(!empty($post['path'])) {
    //         $set .= "path = ?,";
    //         $type .= "s";
    //         array_push($map, $post['path']);
    //     }           
    //     if(!empty($post['image'])) {
    //         $set .= "image = ?,";
    //         $type .= "s";
    //         array_push($map, $post['image']);
    //     }
    //     if(!empty($post['medium'])) {
    //         $set .= "medium = ?,";
    //         $type .= "s";
    //         array_push($map, $post['medium']);
    //     }
    //     if(!empty($post['small'])) {
    //         $set .= "small = ?,";
    //         $type .= "s";
    //         array_push($map, $post['small']);
    //     }
    //     if(!empty($post['views'])) {
    //         $set .= "views = ?,";
    //         $type .= "i";
    //         array_push($map, intval($post['views'].""));
    //     }
    //     if(!empty($post['flag'])) {
    //         $set .= "flag = ?,";
    //         $type .= "i";
    //         array_push($map, intval($post['flag'].""));
    //     }
        
    //     $set .= "update_dt = now(),";

    //     if(!empty($post['update_by'])) {
    //         $set .= "update_by = ?,";
    //         $type .= "i";
    //         array_push($map, intval($post['update_by'].""));
    //     }     
    //     if(!empty($post['id'])) { 
    //         $type .= "i";
    //         array_push($map, intval(trim(($post['id'].""),"")));
    //     }
    //     // print_r($post);
    //     // print_r($type);
    //     // print_r($map);
    //     // delete ,
    //     $set = substr($set, 0, strlen($set) - 1); 
    //     $sql = "UPDATE post SET $set WHERE id = ?";
        
    //     // prepare sql and bind parameters
    //     $stmt = $this->db->prepare($sql);

    //     $stmt->bind_param($type, ...$map);
    //     // $stmt->bind_param($type, 1,2,3,4);

    //     $rs = $stmt->execute();

    //     $stmt->close();

    //     return $rs;        
    // }
    
    // public function delete($id) {
    //     $data = array();

    //     return $data;        
    // }
    
    // public function create($post) {
    //     $sql = "INSERT INTO post (id, category_id, title, description, content, path, image, medium, small, create_by, create_dt) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param(
    //         "isssssssi", 
    //         $post['category_id'], 
    //         $post['title'], 
    //         $post['description'], 
    //         $post['content'],
    //         $post['path'],
    //         $post['image'],
    //         $post['medium'],
    //         $post['small'],
    //         $post['create_by']
    //     );
    //     $status = $stmt->execute();
    //     $last_id = $this->db->insert_id;
    //     $stmt->close();
    //     return $last_id;
    // }

}