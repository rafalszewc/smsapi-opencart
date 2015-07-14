<?php

require dirname(dirname(dirname(dirname(__DIR__)))) . '/smsapi-client/vendor/autoload.php';

class Sms
{
    private $username;

    private $password;

    private $db_sender;

    private $options = array();

    public function __construct($options, $db_sender, $username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
        $this->db_sender = $db_sender;
    }


    public function send($to, $message, $sender = NULL)
    {
        $client = new \SMSApi\Client($this->username);
        $client->setPasswordHash($this->password);

        $smsapi = new \SMSApi\Api\SmsFactory();
        $smsapi->setClient($client);

        try {

            $actionSend = $smsapi->actionSend();

            if ($this->options['special_chars']) {
                $actionSend->setNormalize(1);
            }
            if ($this->options['fast']) {
                $actionSend->setFast(1);
            }

            if ($sender && $sender != 'DEFAULT') {
                $actionSend->setSender($sender);
            } elseif ($sender == NULL) {
                if ($this->db_sender != 'DEFAULT') {
                    $actionSend->setSender($this->db_sender);
                }
            }

            $actionSend->setTo($to);
            $actionSend->setText($message);
            $actionSend->execute();

        } catch (\SMSApi\Exception\SmsapiException $e) {
            return $e->getMessage();
        }
        return TRUE;
    }
}