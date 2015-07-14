<?php

class Login
{

    private $balance;

    public function __construct($username, $password)
    {
        $this->balance = new Balance($username, $password);
    }

    public function logged_in()
    {
        return !$this->get_error();
    }

    public function get_error()
    {
        return $this->balance->get_error();
    }
}