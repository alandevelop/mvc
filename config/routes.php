<?php

return [
    '^admin/index$' => 'admin/index',

    '^admin/products$' => 'adminProduct/index',
    '^admin/products/remove/(\d*)$' => 'adminProduct/remove/$1',
    '^admin/products/edit/(\d*)$' => 'adminProduct/edit/$1',
    '^admin/products/edit$' => 'adminProduct/edit',
    '^admin/products/create$' => 'adminProduct/create',

    '^admin/users$' => 'adminUser/index',
    '^admin/users/remove/(\d*)$' => 'adminUser/remove/$1',

    '^admin/orders$' => 'adminOrder/index',
    '^admin/orders/remove/(\d*)$' => 'adminOrder/remove/$1',

    '^user/register$' => 'user/register',
    '^user/login$' => 'user/login',
    '^user/logout$' => 'user/logout',

    '^cart/index$' => 'cart/index',
    '^cart/add$' => 'cart/add',
    '^cart/remove/(\d*)$' => 'cart/remove/$1',

    '^order/add$' => 'order/add',
    '^orders/index$' => 'order/index/',

    '$' => 'site/index',
];