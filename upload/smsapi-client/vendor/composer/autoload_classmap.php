<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'SMSApi\\Api\\ActionFactory' => $baseDir . '/smsapi/Api/ActionFactory.php',
    'SMSApi\\Api\\Action\\AbstractAction' => $baseDir . '/smsapi/Api/Action/AbstractAction.php',
    'SMSApi\\Api\\Action\\Mms\\Delete' => $baseDir . '/smsapi/Api/Action/Mms/Delete.php',
    'SMSApi\\Api\\Action\\Mms\\Get' => $baseDir . '/smsapi/Api/Action/Mms/Get.php',
    'SMSApi\\Api\\Action\\Mms\\Send' => $baseDir . '/smsapi/Api/Action/Mms/Send.php',
    'SMSApi\\Api\\Action\\Phonebook\\ContactAdd' => $baseDir . '/smsapi/Api/Action/Phonebook/ContactAdd.php',
    'SMSApi\\Api\\Action\\Phonebook\\ContactDelete' => $baseDir . '/smsapi/Api/Action/Phonebook/ContactDelete.php',
    'SMSApi\\Api\\Action\\Phonebook\\ContactEdit' => $baseDir . '/smsapi/Api/Action/Phonebook/ContactEdit.php',
    'SMSApi\\Api\\Action\\Phonebook\\ContactGet' => $baseDir . '/smsapi/Api/Action/Phonebook/ContactGet.php',
    'SMSApi\\Api\\Action\\Phonebook\\ContactList' => $baseDir . '/smsapi/Api/Action/Phonebook/ContactList.php',
    'SMSApi\\Api\\Action\\Phonebook\\GroupAdd' => $baseDir . '/smsapi/Api/Action/Phonebook/GroupAdd.php',
    'SMSApi\\Api\\Action\\Phonebook\\GroupDelete' => $baseDir . '/smsapi/Api/Action/Phonebook/GroupDelete.php',
    'SMSApi\\Api\\Action\\Phonebook\\GroupEdit' => $baseDir . '/smsapi/Api/Action/Phonebook/GroupEdit.php',
    'SMSApi\\Api\\Action\\Phonebook\\GroupGet' => $baseDir . '/smsapi/Api/Action/Phonebook/GroupGet.php',
    'SMSApi\\Api\\Action\\Phonebook\\GroupList' => $baseDir . '/smsapi/Api/Action/Phonebook/GroupList.php',
    'SMSApi\\Api\\Action\\Sender\\Add' => $baseDir . '/smsapi/Api/Action/Sender/Add.php',
    'SMSApi\\Api\\Action\\Sender\\Delete' => $baseDir . '/smsapi/Api/Action/Sender/Delete.php',
    'SMSApi\\Api\\Action\\Sender\\SenderDefault' => $baseDir . '/smsapi/Api/Action/Sender/SenderDefault.php',
    'SMSApi\\Api\\Action\\Sender\\SenderList' => $baseDir . '/smsapi/Api/Action/Sender/SenderList.php',
    'SMSApi\\Api\\Action\\Sms\\Delete' => $baseDir . '/smsapi/Api/Action/Sms/Delete.php',
    'SMSApi\\Api\\Action\\Sms\\Get' => $baseDir . '/smsapi/Api/Action/Sms/Get.php',
    'SMSApi\\Api\\Action\\Sms\\Send' => $baseDir . '/smsapi/Api/Action/Sms/Send.php',
    'SMSApi\\Api\\Action\\User\\Add' => $baseDir . '/smsapi/Api/Action/User/Add.php',
    'SMSApi\\Api\\Action\\User\\Edit' => $baseDir . '/smsapi/Api/Action/User/Edit.php',
    'SMSApi\\Api\\Action\\User\\Get' => $baseDir . '/smsapi/Api/Action/User/Get.php',
    'SMSApi\\Api\\Action\\User\\GetPoints' => $baseDir . '/smsapi/Api/Action/User/GetPoints.php',
    'SMSApi\\Api\\Action\\User\\UserList' => $baseDir . '/smsapi/Api/Action/User/UserList.php',
    'SMSApi\\Api\\Action\\Vms\\Delete' => $baseDir . '/smsapi/Api/Action/Vms/Delete.php',
    'SMSApi\\Api\\Action\\Vms\\Get' => $baseDir . '/smsapi/Api/Action/Vms/Get.php',
    'SMSApi\\Api\\Action\\Vms\\Send' => $baseDir . '/smsapi/Api/Action/Vms/Send.php',
    'SMSApi\\Api\\MmsFactory' => $baseDir . '/smsapi/Api/MmsFactory.php',
    'SMSApi\\Api\\PhonebookFactory' => $baseDir . '/smsapi/Api/PhonebookFactory.php',
    'SMSApi\\Api\\Response\\AbstractResponse' => $baseDir . '/smsapi/Api/Response/AbstractResponse.php',
    'SMSApi\\Api\\Response\\ContactResponse' => $baseDir . '/smsapi/Api/Response/ContactResponse.php',
    'SMSApi\\Api\\Response\\ContactsResponse' => $baseDir . '/smsapi/Api/Response/ContactsResponse.php',
    'SMSApi\\Api\\Response\\CountableResponse' => $baseDir . '/smsapi/Api/Response/CountableResponse.php',
    'SMSApi\\Api\\Response\\ErrorResponse' => $baseDir . '/smsapi/Api/Response/ErrorResponse.php',
    'SMSApi\\Api\\Response\\GroupResponse' => $baseDir . '/smsapi/Api/Response/GroupResponse.php',
    'SMSApi\\Api\\Response\\GroupsResponse' => $baseDir . '/smsapi/Api/Response/GroupsResponse.php',
    'SMSApi\\Api\\Response\\MessageResponse' => $baseDir . '/smsapi/Api/Response/MessageResponse.php',
    'SMSApi\\Api\\Response\\PointsResponse' => $baseDir . '/smsapi/Api/Response/PointsResponse.php',
    'SMSApi\\Api\\Response\\RawResponse' => $baseDir . '/smsapi/Api/Response/RawResponse.php',
    'SMSApi\\Api\\Response\\Response' => $baseDir . '/smsapi/Api/Response/Response.php',
    'SMSApi\\Api\\Response\\SenderResponse' => $baseDir . '/smsapi/Api/Response/SenderResponse.php',
    'SMSApi\\Api\\Response\\SendersResponse' => $baseDir . '/smsapi/Api/Response/SendersResponse.php',
    'SMSApi\\Api\\Response\\StatusResponse' => $baseDir . '/smsapi/Api/Response/StatusResponse.php',
    'SMSApi\\Api\\Response\\UserResponse' => $baseDir . '/smsapi/Api/Response/UserResponse.php',
    'SMSApi\\Api\\Response\\UsersResponse' => $baseDir . '/smsapi/Api/Response/UsersResponse.php',
    'SMSApi\\Api\\SenderFactory' => $baseDir . '/smsapi/Api/SenderFactory.php',
    'SMSApi\\Api\\SmsFactory' => $baseDir . '/smsapi/Api/SmsFactory.php',
    'SMSApi\\Api\\UserFactory' => $baseDir . '/smsapi/Api/UserFactory.php',
    'SMSApi\\Api\\VmsFactory' => $baseDir . '/smsapi/Api/VmsFactory.php',
    'SMSApi\\Client' => $baseDir . '/smsapi/Client.php',
    'SMSApi\\Exception\\ActionException' => $baseDir . '/smsapi/Exception/ActionException.php',
    'SMSApi\\Exception\\ClientException' => $baseDir . '/smsapi/Exception/ClientException.php',
    'SMSApi\\Exception\\HostException' => $baseDir . '/smsapi/Exception/HostException.php',
    'SMSApi\\Exception\\InvalidParameterException' => $baseDir . '/smsapi/Exception/InvalidParameterException.php',
    'SMSApi\\Exception\\ProxyException' => $baseDir . '/smsapi/Exception/ProxyException.php',
    'SMSApi\\Exception\\SmsapiException' => $baseDir . '/smsapi/Exception/SmsapiException.php',
    'SMSApi\\Proxy\\Http\\AbstractHttp' => $baseDir . '/smsapi/Proxy/Http/AbstractHttp.php',
    'SMSApi\\Proxy\\Http\\Curl' => $baseDir . '/smsapi/Proxy/Http/Curl.php',
    'SMSApi\\Proxy\\Http\\Native' => $baseDir . '/smsapi/Proxy/Http/Native.php',
    'SMSApi\\Proxy\\Proxy' => $baseDir . '/smsapi/Proxy/Proxy.php',
    'SMSApi\\Proxy\\Uri' => $baseDir . '/smsapi/Proxy/Uri.php',
);
