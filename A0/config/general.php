<?php
return [
    'NORMAL_ADMIN_PAGE' => env('APP_URL').env( 'NORMAL_ADMIN_PAGE', 'admin' ),
    'ADMIN_LOGIN_PAGE' => env('APP_URL').env( 'ADMIN_LOGIN_PAGE', 'admins/login' ),
    'ADMIN_LOGOUT' => env('APP_URL').env( 'ADMIN_LOGOUT', 'admins/logout' ),
    'ADMIN_DASHBOARD_PAGE' => env('APP_URL').env( 'ADMIN_DASHBOARD_PAGE', 'admin/dashboardAll.php' ),
    'ADMIN_PROFILE_PAGE' => env('APP_URL').env( 'ADMIN_PROFILE_PAGE', 'admins/me' ),
    'CP_URL' => env('APP_URL').env( 'CP_URL', 'cp/agents.php' ),
    'AGENT_PROFILE_PAGE' => env('APP_URL').env( 'AGENT_PROFILE_PAGE', 'agents/me' ),
    'CP_AGENT_LOGIN_PAGE' => env('APP_URL').env( 'CP_AGENT_LOGIN_PAGE', 'agents/login' ),
    'CP_AGENT_LOGOUT_PAGE' => env('APP_URL').env( 'CP_AGENT_LOGOUT_PAGE', 'agents/logout' ),
];
