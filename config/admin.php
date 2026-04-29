<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Registration Code
    |--------------------------------------------------------------------------
    | A secret code required to register a new admin account.
    | Set ADMIN_REGISTER_CODE in your .env file.
    |
    */
    'register_code' => env('ADMIN_REGISTER_CODE', null),
];
