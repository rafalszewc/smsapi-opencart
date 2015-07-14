<?php

class ModelModuleSmsapi extends Model
{
    public function get_status($order_status_id)
    {
        return $this->db->query("SELECT * FROM smsapi_statuses WHERE status_id = '" . $order_status_id . "'")->rows;
    }

    public function get_order($order_id)
    {
        return $this->db->query("SELECT id FROM smsapi_orders WHERE order_id = '" . $order_id . "'")->rows;
    }

    public function get_repeat_order($order_info)
    {
        return $this->db->query("SELECT id FROM smsapi_orders WHERE order_id = '" . $order_info['order_id'] . "' AND status_id = '" . $order_info['order_status_id'] . "'")->rows;
    }

    public function set_order($order_info)
    {
        $this->db->query("INSERT INTO smsapi_orders (order_id, status_id) VALUES ('" . $order_info['order_id'] . "', '" . $order_info['order_status_id'] . "')");
    }

    public function get_settings()
    {
        return $this->db->query("SELECT * FROM smsapi_settings")->rows;
    }

    public function delete_order($order_id)
    {
        $this->db->query("DELETE FROM smsapi_orders WHERE order_id = '" . $order_id . "'");
    }

    public function add_history($message)
    {
        $this->db->query("INSERT INTO smsapi_history (date, message) VALUES ('" . time() . "','" . $message . "')");
    }
}