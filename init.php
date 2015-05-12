<?php

// SynapsePay Singleton
require(dirname(__FILE__) . '/lib/SynapsePay.php');

// Errors
require(dirname(__FILE__) . '/lib/errors/SynapsePayError.php');
require(dirname(__FILE__) . '/lib/errors/ApiError.php');
require(dirname(__FILE__) . '/lib/errors/ApiConnectionError.php');
require(dirname(__FILE__) . '/lib/errors/AuthenticationError.php');

// Plumbing
require(dirname(__FILE__) . '/lib/apibits/ApiClient.php');
require(dirname(__FILE__) . '/lib/apibits/ApiEndpoint.php');
require(dirname(__FILE__) . '/lib/apibits/ApiResource.php');
require(dirname(__FILE__) . '/lib/apibits/ApiList.php');
require(dirname(__FILE__) . '/lib/apibits/ApiMethod.php');
require(dirname(__FILE__) . '/lib/apibits/Request.php');
require(dirname(__FILE__) . '/lib/apibits/PathBuilder.php');
require(dirname(__FILE__) . '/lib/apibits/ParamsBuilder.php');
require(dirname(__FILE__) . '/lib/apibits/HeadersBuilder.php');

// SynapsePay API Resources
require(dirname(__FILE__) . '/lib/synapse_pay/resources/Bank.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/BankMfaDevice.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/BankMfaQuestions.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/BankStatus.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/Card.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/Deposit.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/MassPay.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/Order.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/User.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/Wire.php');
require(dirname(__FILE__) . '/lib/synapse_pay/resources/Withdrawal.php');


// SynapsePay API EndPoints
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/BankEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/BankMfaDeviceEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/BankMfaQuestionsEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/BankStatusEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/CardEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/DepositEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/MassPayEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/OrderEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/UserEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/WireEndpoint.php');
require(dirname(__FILE__) . '/lib/synapse_pay/endpoints/WithdrawalEndpoint.php');



require(dirname(__FILE__) . '/lib/Client.php');
