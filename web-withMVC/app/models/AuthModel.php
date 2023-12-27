<?php
class AuthModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function getUser($username)
    {
        $this->db->query("SELECT * FROM user WHERE username = '$username'");
        return $this->db->fetch();
    }
}
