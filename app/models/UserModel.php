<?php


class UserModel
{
    private $table = 'user';
    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserByEmail($email)
    {
        $this->db->query(
            "SELECT email,password,username FROM {$this->table} WHERE email=:email"
        );
        $this->db->bind('email', $email);

        return $this->db->single();
    }

    public function saveCookietoDB($username, $token)
    {
        $query =
            "UPDATE  {$this->table} set login_token = :token WHERE username=:username";

        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->bind('token', $token);
        $this->db->execute();


        return $this->db->rowCount();
    }

    public function setLoginCookie($username)
    {
        $cookieNameUser = 'engima_user';
        $cookieValueUser = $username;
        $cookieNameToken = 'engima_token';
        $cookieValueToken = bin2hex(openssl_random_pseudo_bytes(32));
        if ($this->saveCookietoDB($cookieValueUser, $cookieValueToken)) {
            //set cookie ke browser kalo udah sukses masukin ke db
            setcookie($cookieNameUser, $cookieValueUser, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie($cookieNameToken, $cookieValueToken, time() + (86400 * 30), "/");
        }
    }

    public function getValidCookie($username)
    {
        //dipake di register
        $this->db->query(
            "SELECT login_token FROM {$this->table} WHERE username=:username"
        );
        $this->db->bind('username', $username);
        return $this->db->single();
    }


    public function isRedirectedToHome()
    {
        if (isset($_COOKIE['engima_token']) && isset($_COOKIE['engima_user'])) {
            $retrievedDBCookie = $this->getValidCookie($_COOKIE['engima_user']);
            if ($retrievedDBCookie > 0 && !is_null($retrievedDBCookie['login_token'])) {
                return true;
            }
        }
        return false;
    }

    public function resetCookie()
    {
        $query =
            "UPDATE  {$this->table} set login_token = NULL ";

        $this->db->query($query);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            if (isset($_COOKIE['engima_user'])) {
                unset($_COOKIE['engima_user']);
                unset($_COOKIE['engima_token']);
                setcookie('engima_user', null, -1, '/');
                setcookie('engima_token', null, -1, '/');
                return true;
            }
        }

        return $this->db->rowCount();
    }

    public function isUsernameValid($username)
    {
        return preg_match('/^[\w-]+$/', $username);
    }

    public function isPhoneNumValid($input)
    {
        return (strlen($input) >= 10 && strlen($input) <= 14);
    }

    public function isInputExist($key, $value)
    {
        $this->db->query(
            "
                SELECT * from {$this->table} WHERE " . $key . " = :value
            "
        );
        $this->db->bind('value', $value);
        return $this->db->single();
    }

    public function addNewUser($data)
    {
        $blob = fopen($data['profile_picture'], 'rb');
        $this->db->query(
            "INSERT INTO {$this->table} (
                username,
                password,
                email,
                phone_num,
                profile_picture,
                mime
            ) VALUES
            (
                :username,
                :password,
                :email,
                :phone_num,
                :profile_picture,
                :mime
            )"
        );
        // die(print_r($data));
        $this->db->bind('username', $data["username"]);
        $this->db->bind('password', $data["password"]);
        $this->db->bind('email', $data["email"]);
        $this->db->bind('phone_num', $data["phone_num"]);
        $this->db->bind('profile_picture', $blob);
        $this->db->bind('mime', $data["mime"]);

        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            $this->setLoginCookie($data["username"]);
        }
        return $this->db->rowCount();
    }

    public function getCurrentUser()
    {
        return $_COOKIE['engima_user'];
    }

    public function getUserID()
    {
        $this->db->query(
            "SELECT user_id FROM {$this->table} WHERE username = :username"
        );
        $this->db->bind('username', $_COOKIE['engima_user']);


        return $this->db->single();
    }
}