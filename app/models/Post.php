<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // --INNER JOIN-- fetch the data in users and posts table by ID.
    public function findUserPost($id)
    {
        $this->db->query("SELECT users.username, posts.* FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $results = $this->db->resultset();
    }

    // --INNER JOIN-- fetch the data in users and posts table by ID.
    public function findAllPosts()
    {
        $this->db->query("SELECT users.username, posts.* FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY created_at ASC");
        return $results = $this->db->resultset();
    }

    public function insertPost($data)
    {
        $this->db->query("INSERT INTO posts (user_id, title, body, image, created_at)
        VALUES (:user_id, :title, :body, :image, :date)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['postTitle']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':image', $data['path']);
        $this->db->bind(':date', date("Y-m-d H:i:s"))
        ;
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findPostById($id)
    {
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);
        return $row = $this->db->single();
    }

    public function updatePost($data)
    {
        $this->db->query("UPDATE posts SET title = :title, body = :body, image = :image WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['postTitle']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':image', $data['path']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
