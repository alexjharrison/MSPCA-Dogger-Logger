<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    //'supportsCredentials' => true,
    //'allowedOrigins' => ['https://doggerlogger.netlify.com','http://localhost:3000','https://doggerlogger.aharrison.xyz'],
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
