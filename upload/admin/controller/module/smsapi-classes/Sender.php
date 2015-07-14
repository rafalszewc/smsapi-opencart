<?php

class Sender extends AbstractSmsapi
{
    private $sender;

    private $settings;

    private $_default;

    public function __construct($username, $password, $sender = NULL, $settings = NULL, $_default)
    {
        parent::__construct($username, $password);
        $this->sender = $sender;
        $this->settings = $settings;
        $this->_default = $_default;
    }

    public function select_sender()
    {
        $client = $this->getSmsapiClient();

        $smsApi = new \SMSApi\Api\SenderFactory();
        $smsApi->setClient($client);


        $actionList = $smsApi->actionList();
        $response = $actionList->execute();

        if (!empty($this->settings['sender'])) {
            $names[$this->settings['sender']] = $this->settings['sender'];
            $names['DEFAULT'] = $this->_default;
        } else {
            if ($this->sender != NULL) {
                $names[$this->sender] = $this->sender;
                $names['DEFAULT'] = $this->_default;
            } else {
                $names['DEFAULT'] = $this->_default;
            }
        }

        if (!empty($this->settings))
            foreach ($response->getList() as $status) {
                if ($status->getStatus() == 'ACTIVE' && $status->getName() != $this->sender && $status->getName() != $this->settings['sender']) {
                    $names[$status->getName()] = $status->getName();
                }
            }
        else
            foreach ($response->getList() as $status) {
                if ($status->getStatus() == 'ACTIVE' && $status->getName() != $this->sender) {
                    $names[$status->getName()] = $status->getName();
                }
            }

        return $names;
    }
}