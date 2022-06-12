<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findAllPosts()
    {
        $this->db->query("SELECT * FROM posts ORDER BY created_at ASC");
        return $results = $this->db->resultset();
    }

    public function insertPost($data)
    {
        $this->db->query("INSERT INTO posts (user_id, title, body)
        VALUES (:user_id, :title, :body)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['postTitle']);
        $this->db->bind(':body', $data['body']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
