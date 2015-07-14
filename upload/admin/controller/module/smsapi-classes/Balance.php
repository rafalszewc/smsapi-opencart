<?php

class Balance extends AbstractSmsapi
{
    private $username;

    private $points;

    private $error;

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
        $this->username = $username;

        $client = $this->getSmsapiClient();

        $smsApi = new SMSApi\Api\UserFactory(null, $client);
        $action = $smsApi->actionGetPoints();
        $action->setDetails(1);

        try {
            $this->points = $action->execute();
        } catch (SMSApi\Exception\SmsapiException $e) {
            $this->points = null;
            $this->error = $e->getMessage();
        }
    }

    public function get_error()
    {
        return $this->error;
    }

    public function has_points()
    {
        return $this->points !== null;
    }

    public function get_balance()
    {
        return $this->points->getPoints();
    }

    public function getProCount()
    {
        return $this->points->getProCount();
    }

    public function getEcoCount()
    {
        return $this->points->getEcoCount();
    }

    public function getMmsCount()
    {
        return $this->points->getMmsCount();
    }

    public function getVmsGsmCount()
    {
        return $this->points->getVmsGsmCount();
    }

    public function getVmsLandCount()
    {
        return $this->points->getVmsLandCount();
    }
}