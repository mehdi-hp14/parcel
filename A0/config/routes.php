<?php
return [
    'REGISTER_ADMIN_PAGE' => env('APP_URL') . env('REGISTER_ADMIN_PAGE', 'admins/register'),
    'ADMIN_LIST' => env('APP_URL') . env('ADMIN_LIST', 'admins/list'),
    'MAIL_CONFIG' => env('APP_URL') . env('MAIL_CONFIG', 'admins/mail-config'),
];
