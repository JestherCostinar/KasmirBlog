<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Registration of Account
    public function register($data)
    {
        $this->db->query("INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute query. Return the last row
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // One time password for verification of account
    public function oneTimePassword($id)
    {
        $this->db->query("INSERT INTO account_verification (user_id, verification_code, otp_expiry) VALUES (:id, :code, :date)");
        $this->db->bind(":id", $id);
        $this->db->bind(":code", substr(number_format(time() * rand(), 0, '', ''), 0, 6));
        $this->db->bind(":date", date("Y/m/d H:i:s", strtotime("+30 minutes")));

        // Execute query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // fetch the otp 
    public function findOneTimePasswordById($id)
    {
        $this->db->query("SELECT * FROM account_verification WHERE user_id = :id");
        $this->db->bind(":id", $id);
        return $row = $this->db->single();
    }

    // fetch the account to verify using specific id
    public function findUserVerificationCodeByID($id)
    {
        $this->db->query("SELECT * FROM account_verification WHERE user_id = :id");
        $this->db->bind(":id", $id);
        return $row = $this->db->single();
    }

    // Update the status if the account is verified
    public function updateAccountStatus($id)
    {
        $this->db->query("UPDATE users SET is_verify = :status WHERE id = :id");
        $this->db->bind(':status', 1);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by email using email data passed in by Controller
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email and is_verify = :status");
        $this->db->bind(":email", $email);
        $this->db->bind(":status", 1);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find specific Using ID
    public function findUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $row = $this->db->single();
    }

    // Update Profile 
    public function updateUser($data)
    {
        $this->db->query("UPDATE users SET image = :image, username = :name, description = :description WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':image', $data['path']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login user function
    public function login($username, $password)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username AND is_verify = :status");
        $this->db->bind(':username', $username);
        $this->db->bind(':status', 1);
        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row->password;
        } else {
            $hashedPassword = $password;
        }

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}
