<?php

require DIR_CATALOG . 'controller/module/smsapi-classes/Message.php';
require DIR_CATALOG . 'controller/module/smsapi-classes/Sms.php';
require 'smsapi-classes/AbstractSmsapi.php';
require 'smsapi-classes/Balance.php';
require 'smsapi-classes/Login.php';
require 'smsapi-classes/Sender.php';

class ControllerModuleSmsapi extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('module/smsapi');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        $this->load->model('catalog/smsapi');
        $this->load->model('localisation/order_status');
        $this->load->model('sale/customer');

        $data['logged_in'] = false;
        $data['smsapi_username'] = $this->model_catalog_smsapi->get_settings()[0]['smsapi_username'];
        $data['smsapi_password'] = $this->model_catalog_smsapi->get_settings()[0]['smsapi_password'];
        $data['sender'] = $this->model_catalog_smsapi->get_settings()[0]['sender'];
        $data['new_order'] = $this->model_catalog_smsapi->get_settings()[0]['new_order'];
        $data['new_order_message'] = $this->model_catalog_smsapi->get_settings()[0]['new_order_message'];
        $data['special_chars'] = $this->model_catalog_smsapi->get_settings()[0]['special_chars'];
        $data['fast'] = $this->model_catalog_smsapi->get_settings()[0]['fast'];
        $data['change_order_status'] = $this->model_catalog_smsapi->get_settings()[0]['change_order_status'];
        $data['admin_phone'] = $this->model_catalog_smsapi->get_settings()[0]['admin_phone'];
        $data['customers'] = $this->model_sale_customer->getCustomers();
        $data['history'] = $this->model_catalog_smsapi->get_history();


        if (!empty($data['smsapi_username'])) {
            $login = new Login($data['smsapi_username'], $data['smsapi_password']);
            $sender = new Sender($data['smsapi_username'], $data['smsapi_password'], NULL, $this->model_catalog_smsapi->get_settings()[0], $this->language->get('--DEFAULT--'));
            $balance = new Balance($data['smsapi_username'], $data['smsapi_password']);

            $data['logged_in'] = $login->logged_in();
            $this->error['warning'] = $this->language->get($balance->get_error());

            if ($data['logged_in']) {
                $data['senders'] = $sender->select_sender();
                $data['balance'] = $balance->get_balance();
                $data['ecoCount'] = $balance->getEcoCount();
                $data['proCount'] = $balance->getProCount();
                $data['mmsCount'] = $balance->getMmsCount();
                $data['vmsGsmCount'] = $balance->getVmsGsmCount();
                $data['vmsLandCount'] = $balance->getVmsLandCount();
            }
        }

        $statuses = $this->model_localisation_order_status->getOrderStatuses();
        $localStatusList = $this->model_catalog_smsapi->get_statuses();

        $sharedStatuses = [];

        foreach ($statuses as $status) {
            if (isset($localStatusList[$status['order_status_id']])) {
                $sharedStatuses[$status['order_status_id']] = $localStatusList[$status['order_status_id']];

                if ($localStatusList[$status['order_status_id']]['description'] != $status['name']) {
                    $localStatusList[$status['order_status_id']]['description'] = $status['name'];
                    $this->model_catalog_smsapi->update_status_name($status);
                }
            }
        }

        $statusToRemoveList = array_diff_key($localStatusList, $sharedStatuses);

        $this->model_catalog_smsapi->remove_statuses($statusToRemoveList);
        $this->model_catalog_smsapi->save_statuses($statuses, $this->language->get('order_status'));

        $data['statuses'] = $this->model_catalog_smsapi->get_statuses_simple();

        if (isset($this->request->post['save'])) {

            $this->model_setting_setting->editSetting('smsapi', $this->request->post);


            $this->session->data['success'] = $this->language->get('text_success');

            $settings['sender'] = $this->request->post['sender'];
            $settings['new_order'] = $this->request->post['newOrder'];
            $settings['new_order_message'] = $this->request->post['newOrderMessage'];
            $settings['special_chars'] = $this->request->post['specialChars'];
            $settings['fast'] = $this->request->post['fast'];
            $settings['payment'] = $this->request->post['payment'];
            $settings['posting_payment'] = $this->request->post['postingPayment'];
            $settings['change_order_status'] = $this->request->post['changeOrderStatus'];
            $settings['check_list'] = $this->request->post['check_list'];
            $settings['status_descriptions'] = $this->request->post['status_descriptions'];
            $settings['admin_phone'] = $this->request->post['admin_phone'];

            foreach ($settings['status_descriptions'] as $status_id => $description) {
                $checked = isset($settings['check_list'][$status_id]) ? true : false;
                $this->model_catalog_smsapi->update_status($status_id, $description, $checked);
            }
            $this->model_catalog_smsapi->update_settings($settings);


//            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            $this->response->redirect(HTTP_SERVER . 'index.php?route=module/smsapi&token=' . $this->session->data['token']);
        }

        if (isset($this->request->post['change'])) {
            $settings['smsapi_username'] = $this->request->post['username'];
            $settings['smsapi_password'] = $this->request->post['password'];

            $login = new Login($settings['smsapi_username'], $settings['smsapi_password']);

            if ($login->logged_in()) {
                $this->model_catalog_smsapi->update_api($settings);
                $this->response->redirect(HTTP_SERVER . 'index.php?route=module/smsapi&token=' . $this->session->data['token']);
            } else {
                $this->error['warning'] = $this->language->get($login->get_error());
            }
        }

        if (isset($this->request->post['send'])) {
            $data['sender'] = $this->request->post['sender'];
            $data['definedRecipient'] = $this->request->post['definedRecipient'];
            $data['message'] = $this->request->post['message'];
            $data['recipient'] = $this->request->post['recipient'];
            $options = array(
                'special_chars' => $data['special_chars'],
                'fast' => $data['fast']
            );
            $sms = new Sms($options, $data['sender'], $data['smsapi_username'], $data['smsapi_password']);

            if (!empty($data['recipient'])) {
                $result = $sms->send($data['recipient'], $data['message'], $data['sender']);
            } else {
                $result = $sms->send($data['definedRecipient'], $data['message'], $data['sender']);
            }
            if (is_string($result)) {
                $this->error['warning'] = $result;
            } else {
                $this->session->data['success'] = $this->language->get('sent');
            }
        }

        // Assign the language data for parsing it to view
        $data['heading_title'] = $this->language->get('heading_title');

        $data['general_settings'] = $this->language->get('general_settings');
        $data['account_settings'] = $this->language->get('account_settings');
        $data['account_in_smsapi'] = $this->language->get('account_in_smsapi');
        $data['username'] = $this->language->get('username');
        $data['password'] = $this->language->get('password');
        $data['change'] = $this->language->get('change');
        $data['broadcaster'] = $this->language->get('broadcaster');
        $data['sms_options'] = $this->language->get('sms_options');
        $data['replace_special_chars'] = $this->language->get('replace_special_chars');
        $data['send_fast'] = $this->language->get('send_fast');
        $data['owner_number'] = $this->language->get('owner_number');
        $data['insert_owner_number'] = $this->language->get('insert_owner_number');
        $data['inform_owner'] = $this->language->get('inform_owner');
        $data['sms_message'] = $this->language->get('sms_message');
        $data['inform_client'] = $this->language->get('inform_client');
        $data['yes'] = $this->language->get('yes');
        $data['no'] = $this->language->get('no');
        $data['service'] = $this->language->get('service');
        $data['smsapi_balance'] = $this->language->get('smsapi_balance');
        $data['smsapi_history'] = $this->language->get('smsapi_history');
        $data['smsapi_send'] = $this->language->get('smsapi_send');
        $data['smsapi_settings'] = $this->language->get('smsapi_settings');
        $data['messages'] = $this->language->get('messages');
        $data['api_history'] = $this->language->get('api_history');
        $data['no_history'] = $this->language->get('no_history');
        $data['send_sms_message'] = $this->language->get('send_sms_message');
        $data['defined_recipient'] = $this->language->get('defined_recipient');
        $data['number'] = $this->language->get('number');
        $data['client'] = $this->language->get('client');
        $data['sms_recipient'] = $this->language->get('recipient');
        $data['commas_information'] = $this->language->get('commas_information');
        $data['not_logged_in'] = $this->language->get('not_logged_in');
        $data['connect'] = $this->language->get('connect');
        $data['not_connected'] = $this->language->get('not_connected');
        $data['change_save'] = $this->language->get('change_save');

        $data['var_customer'] = $this->language->get('var_customer');
        $data['var_number'] = $this->language->get('var_number');
        $data['var_total_price'] = $this->language->get('var_total_price');
        $data['var_status'] = $this->language->get('var_status');
        $data['var_phone'] = $this->language->get('var_phone');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_content_top'] = $this->language->get('text_content_top');
        $data['text_content_bottom'] = $this->language->get('text_content_bottom');
        $data['text_column_left'] = $this->language->get('text_column_left');
        $data['text_column_right'] = $this->language->get('text_column_right');

        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_layout'] = $this->language->get('entry_layout');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['save_changes'] = $this->language->get('save_changes');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');

        // This Block returns the warning if any
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        // This Block returns the error code if any
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }

        // Making of Breadcrumbs to be displayed on site
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/smsapi', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['action'] = $this->url->link('module/smsapi', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed


        if (isset($this->request->post['smsapi_text_field'])) {
            $data['smsapi_text_field'] = $this->request->post['smsapi_text_field'];
        } else {
            $data['smsapi_text_field'] = $this->config->get('smsapi_text_field');
        }

        if (isset($this->request->post['smsapi_status'])) {
            $data['smsapi_status'] = $this->request->post['smsapi_status'];
        } else {
            $data['smsapi_status'] = $this->config->get('smsapi_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/smsapi.tpl', $data));

    }

    protected function validate()
    {

        if (!$this->user->hasPermission('modify', 'module/smsapi')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function install()
    {
        $this->load->model('extension/event');
        $this->load->model('catalog/smsapi');
        $this->model_catalog_smsapi->install();

        $this->model_extension_event->addEvent('smsapi', 'post.order.history.add', 'module/smsapi/statusUpdate');
    }

    public function uninstall()
    {
        $this->load->model('catalog/smsapi');
        $this->load->model('extension/event');
        $this->model_catalog_smsapi->unistall();
        $this->model_extension_event->deleteEvent('smsapi');
    }
}