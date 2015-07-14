<?php

require dirname(dirname(dirname(dirname(__DIR__)))) . '/smsapi-client/vendor/autoload.php';

abstract class AbstractSmsapi
{
    private $username;
    private $password;

    protected function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getSmsapiClient()
    {

        $client = new \SMSApi\Client($this->username);
        $client->setPasswordHash($this->password);

        return $client;
    }

}