<?php

namespace App\Model;

class Category extends \Illuminate\Database\Eloquent\Model {

    protected $tables = "categories";

    // public function findAll() {
    //     $data = array();
    //     $sql = "SELECT * FROM category ORDER BY id";
    //     $result = $this->db->query($sql);
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $data[] = $row;
    //     }
    //     $this->close();
    //     return $data;
    // }

    // public function findById($id, $post_offset, $post_limit) {
    //     $data = array();
    //     $sql = "SELECT c.id, c.name, c.create_dt, c.update_dt, c.update_by, c.create_by FROM category c WHERE c.id = ?";
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
    //     if(count($data) == 1) {
    //         $data[0]['posts'] = $this->findPostByCategoryId($id);
    //     } else {
    //         $this->close();
    //     }
    //     return $data;
    // }    

    // public function findPostByCategoryId($id) {
    //     $data = array();
    //     $sql = "SELECT ps.id, ps.title, ps.description, ps.image, ps.medium, ps.small, ps.views, ps.create_dt, ps.create_by, ps.update_dt, us.fullname as update_by FROM ( SELECT p.id, p.title, p.description, p.image, p.medium, p.small, p.views, p.create_dt, u.fullname as create_by, p.update_dt, p.update_by FROM post p INNER JOIN post_details pd ON p.id = pd.post_id INNER JOIN user u ON p.create_by = u.id INNER JOIN category c ON p.category_id = ? WHERE p.flag = 1 ) as ps INNER JOIN user us ON ps.update_by = us.id";

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
    //     $this->close();
    //     return $data;
    // }

    // public function create($data) {
    //     $sql = "INSERT INTO category (id, name, create_by, create_dt) VALUES (NULL, ?, ?, NOW())";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param(
    //         "si", 
    //         $data['name'], 
    //         $data['create_by']
    //     );
    //     $status = $stmt->execute();
    //     $last_id = $this->db->insert_id;
    //     $stmt->close();
    //     return $last_id;
    // }

}