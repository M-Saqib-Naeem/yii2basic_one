<?php 

return [
    'mode'    => $_ENV['PAYPAL_MODE'], // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => $_ENV['PAYPAL_SANDBOX_CLIENT_ID'],
        'client_secret'     => $_ENV['PAYPAL_SANDBOX_CLIENT_SECRET'],
        'app_id'            => $_ENV['PAYPAL_SANDBOX_APP_ID'],
    ],
    'live' => [
        'client_id'         => $_ENV['PAYPAL_LIVE_CLIENT_ID'],
        'client_secret'     => $_ENV['PAYPAL_LIVE_CLIENT_SECRET'],
        'app_id'            => $_ENV['PAYPAL_LIVE_APP_ID'],
    ],

    'payment_action' => $_ENV['PAYPAL_PAYMENT_ACTION'], // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => $_ENV['PAYPAL_CURRENCY'],
    'notify_url'     => $_ENV['PAYPAL_NOTIFY_URL'], // 
    'locale'         => $_ENV['PAYPAL_LOCALE'], // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => $_ENV['PAYPAL_VALIDATE_SSL'], // Validate SSL when creating api client.
];