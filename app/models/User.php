<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query("INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute Query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Find user by email using email data passed in by Controller
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(":email", $email);
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Login user function
    public function login($username, $password = '') {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        $hashedPassword = $row->password;

        if(password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}
