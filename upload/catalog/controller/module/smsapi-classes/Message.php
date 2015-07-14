<?php

class Message
{
    private $order_info;
    private $message;

    public function __construct($order_info, $message)
    {
        $this->order_info = $order_info;
        $this->message = $message;
    }

    public function get_admin_message()
    {
        $replace = array('{customer}', '{number}', '{total_price}', '{phone}');
        $to = array($this->order_info['firstname'] . ' ' . $this->order_info['lastname'], $this->order_info['order_id'], $this->order_info['total'] . ' ' . $this->order_info['currency_code'], $this->order_info['telephone']);
        $message = str_replace($replace, $to, $this->message);
        return $message;
    }

    public function get_customer_message()
    {
        $replace = array('{customer}', '{number}', '{total_price}', '{status}');
        $to = array($this->order_info['firstname'] . ' ' . $this->order_info['lastname'], $this->order_info['order_id'], $this->order_info['total'] . ' ' . $this->order_info['currency_code'], $this->order_info['order_status']);
        $message = str_replace($replace, $to, $this->message);
        return $message;
    }
}