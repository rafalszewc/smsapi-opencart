<?php

require 'smsapi-classes/Message.php';
require 'smsapi-classes/Sms.php';

class ControllerModuleSmsapi extends Controller
{
    public function statusUpdate($order_id)
    {
        $this->load->model('checkout/order');
        $this->load->model('module/smsapi');
        $order_info = $this->model_checkout_order->getOrder($order_id);

        if ($order_info['order_status_id'] != 0) {
            $message = $this->model_module_smsapi->get_status($order_info['order_status_id'])[0]['description'];
            $customer_msg = new Message($order_info, $message);
            $customer_message = $customer_msg->get_customer_message();

            $options = array(
                'special_chars' => $this->model_module_smsapi->get_settings()[0]['special_chars'],
                'fast' => $this->model_module_smsapi->get_settings()[0]['fast']
            );

            $db_sender = $this->model_module_smsapi->get_settings()[0]['sender'];
            $username = $this->model_module_smsapi->get_settings()[0]['smsapi_username'];
            $password = $this->model_module_smsapi->get_settings()[0]['smsapi_password'];
            $admin_phone = $this->model_module_smsapi->get_settings()[0]['admin_phone'];

            $sms = new Sms($options, $db_sender, $username, $password);

            if (!$this->model_module_smsapi->get_order($order_info['order_id']) && $this->model_module_smsapi->get_settings()[0]['new_order']) {
                $this->model_module_smsapi->set_order($order_info);
                $message = $this->model_module_smsapi->get_settings()[0]['new_order_message'];
                $admin_msg = new Message($order_info, $message);
                $admin_message = $admin_msg->get_admin_message();

                $result = $sms->send($admin_phone, $admin_message);
                if (is_string($result)) {
                    $this->model_module_smsapi->add_history($result);
                } else {
                    $this->model_module_smsapi->add_history($admin_message);
                }

                if ($this->model_module_smsapi->get_status($order_info['order_status_id'])[0]['checked']) {
                    $result = $sms->send($order_info['telephone'], $customer_message);
                    if (is_string($result)) {
                        $this->model_module_smsapi->add_history($result);
                    } else {
                        $this->model_module_smsapi->add_history($customer_message);
                    }
                }
            }

            if ($this->model_module_smsapi->get_settings()[0]['change_order_status']) {
                if ($this->model_module_smsapi->get_status($order_info['order_status_id'])[0]['checked']) {
                    $this->model_module_smsapi->set_order($order_info);

                    $result = $sms->send($order_info['telephone'], $customer_message);
                    if (is_string($result)) {
                        $this->model_module_smsapi->add_history($result);
                    } else {
                        $this->model_module_smsapi->add_history($customer_message);
                    }
                }
            }
        }
    }
}