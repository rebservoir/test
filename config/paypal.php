<?php

    $client_id = 'AbY2sudkGMJvjkjLpJ041FSnefC-qNAT2YC6gcFczZuIqjIzJPSNrKU_1qgQkriX53PURH0OTrsndXxK';
    $secret = 'EJCUhai8sQaFsiO6utCJBImMJYZUcNTXdP7J99kIsGV4AI_6pXQp6DlV0zAUhehVQBD_fm_3Ej0G_hwZ';

return array(


    // set your paypal credential
    'client_id' => 'AbY2sudkGMJvjkjLpJ041FSnefC-qNAT2YC6gcFczZuIqjIzJPSNrKU_1qgQkriX53PURH0OTrsndXxK',
    'secret' => 'EJCUhai8sQaFsiO6utCJBImMJYZUcNTXdP7J99kIsGV4AI_6pXQp6DlV0zAUhehVQBD_fm_3Ej0G_hwZ',
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);