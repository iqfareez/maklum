<?php

/*
|--------------------------------------------------------------------------
| Custom Tenant Configuration
|--------------------------------------------------------------------------
|
| This configuration file is not part of the original Laravel application.
| It was added to track which tenant is using this application. All TENANT_*
| environment variables are custom additions to support multi-tenancy.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Tenant Name
    |--------------------------------------------------------------------------
    |
    | This value specifies the name of the tenant using this application.
    | It will be used in various places throughout the application where
    | tenant identity needs to be displayed.
    |
    */

    'name' => env('TENANT_NAME', 'Maklum'),

    /*
    |--------------------------------------------------------------------------
    | Tenant Homepage
    |--------------------------------------------------------------------------
    |
    | This value provides the URL to the tenant's homepage or website.e
    | It can be used for generating links or for verification purposes.
    |
    */

    'homepage' => env('TENANT_HOMEPAGE', 'https://iqfareez.com'),

    /*
    |--------------------------------------------------------------------------
    | Tenant Email Configuration
    |--------------------------------------------------------------------------
    |
    | This determines whether tenant-specific email functionality is enabled.
    | When enabled, the application will use tenant-specific email as BCC or
    | as the primary recipient (TO) when feedback is received from users.
    |
    */

    'email' => env('TENANT_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Tenant Admin
    |--------------------------------------------------------------------------
    |
    | This value specifies the name of the person who represents the tenant.
    | It can be used when displaying tenant contact information or for
    | administrative communication purposes.
    |
    */

    'admin' => env('TENANT_ADMIN', 'Admin'),
];
