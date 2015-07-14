<?php

class ModelCatalogSmsapi extends Model
{
    public function install()
    {
        $this->load->language('module/smsapi');
        $data['smsapi_username'] = '';
        $data['smsapi_password'] = '';
        $data['sender'] = '';
        $data['new_order'] = 0;
        $data['new_order_message'] = $this->language->get('new_order_message');
        $data['special_chars'] = 0;
        $data['fast'] = 0;
        $data['payment'] = 0;
        $data['posting_payment'] = $this->language->get('posting_payment');
        $data['change_order_status'] = 0;
        $data['admin_phone'] = '';

        $this->db->query("
CREATE TABLE IF NOT EXISTS `smsapi_statuses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `checked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `smsapi_orders` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL,
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("
CREATE TABLE IF NOT EXISTS `smsapi_history` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `message` text NOT NULL,
  primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("
CREATE TABLE IF NOT EXISTS `smsapi_settings` (
  `sender` varchar(255) NOT NULL,
  `new_order` tinyint(1) NOT NULL,
  `new_order_message` text NOT NULL,
  `special_chars` tinyint(1) NOT NULL,
  `fast` tinyint(1) NOT NULL,
  `change_order_status` tinyint(1) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `smsapi_username` varchar(255) DEFAULT NULL,
  `smsapi_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("INSERT INTO smsapi_settings (sender, new_order, new_order_message, special_chars, fast, change_order_status, admin_phone, smsapi_username, smsapi_password) VALUES ('" . $data['sender'] . "', '" . $data['new_order'] . "', '" . $data['new_order_message'] . "', '" . $data['special_chars'] . "', '"
            . $data['fast'] . "', '" . $data['change_order_status'] . "', '"
            . $data['admin_phone'] . "', '" . $data['smsapi_username'] . "', '" . $data['smsapi_password'] . "')");
    }

    public function unistall()
    {
        $this->db->query("DROP TABLE smsapi_settings");
        $this->db->query("DROP TABLE smsapi_statuses");
        $this->db->query("DROP TABLE smsapi_orders");
        $this->db->query("DROP TABLE smsapi_history");
    }

    public function update_api($data)
    {
        $this->db->query("UPDATE smsapi_settings SET smsapi_username = '" . $data['smsapi_username'] . "', smsapi_password = '" . $data['smsapi_password'] . "'");
    }

    public function update_settings($data)
    {
        $this->db->query("UPDATE smsapi_settings SET sender = '" . $data['sender'] . "', new_order = '" . $data['new_order']
            . "', new_order_message = '" . $data['new_order_message'] . "', special_chars = '" . $data['special_chars'] . "', fast = '"
            . $data['fast'] . "', change_order_status = '"
            . $data['change_order_status'] . "', admin_phone = '" . $data['admin_phone'] . "'");
    }

    public function get_settings()
    {
        return $this->db->query("SELECT * FROM smsapi_settings")->rows;
    }

    public function save_statuses($data, $description)
    {
        foreach ($data as $d) {
            $result = $this->db->query("SELECT id FROM smsapi_statuses WHERE status_id = '" . $d['order_status_id'] . "'");
            if (!isset($result->rows[0]['id']))
                $this->db->query("INSERT INTO smsapi_statuses (status_id, name, description, checked) VALUES ('" . $d['order_status_id'] . "', '" . $d['name'] . "', '" . $description . "', 0)");
        }
    }

    public function get_statuses()
    {
        $result = $this->db->query("SELECT * FROM smsapi_statuses");

        foreach ($result->rows as $row) {
            $localStatusList[$row['status_id']] = $row;
        }
        return isset($localStatusList) ? $localStatusList : [];
    }

    public function get_status($order_status_id)
    {
        return $this->db->query("SELECT * FROM smsapi_statuses WHERE status_id = '" . $order_status_id . "'");
    }

    public function get_statuses_simple()
    {
        return $this->db->query("SELECT * FROM smsapi_statuses")->rows;
    }

    public function update_status_name($data)
    {
        $this->db->query("UPDATE smsapi_statuses SET name = '" . $data['name'] . "' WHERE status_id = '" . $data['order_status_id'] . "'");
    }

    public function update_status($status_id, $description, $checked)
    {
        $this->db->query("UPDATE smsapi_statuses SET description = '" . $description . "', checked = '" . $checked . "' WHERE status_id = '" . $status_id . "'");
    }

    public function remove_statuses($data)
    {
        foreach ($data as $status) {
            if (isset($status['status_id']))
                $this->db->query("DELETE FROM smsapi_statuses WHERE status_id = '" . $status['status_id'] . "'");
        }
    }

    public function get_history()
    {
        return $this->db->query("SELECT * FROM smsapi_history")->rows;
    }
}