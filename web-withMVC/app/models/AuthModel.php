<?php
class AuthModel
{
    private $db; // Statement (query)

    function __construct()
    {
        $this->db = new Database;
    }

    function getUser($username, $password)
    {
        $this->db->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
        return $this->db->fetch();
    }
}
