<?php

return [
    'name' => 'زرین بوت (ZarinBot)',
    'version' => '2026.13.0',
    'developer' => 'احسان نادری پناه',
    'support_phone' => '09024561001',
    'default_copyright_html' => '© تمامی حقوق برای زرین بات محفوظ می باشد. | احسان نادری پناه - 09024561001',

    'anti_censorship' => [
        'doh_provider' => env('DOH_RESOLVER_URL', 'https://1.1.1.1/dns-query'),
        'enable_tls_fragmentation' => env('ENABLE_TLS_FRAGMENTATION', true),
        'antifilter_sync' => env('ANTIFILTER_SYNC_ENABLED', true),
        'clean_nodes' => [
            '185.220.101.42',
            '157.240.221.35',
            '157.240.22.63',
            '57.144.216.192'
        ]
    ],

    'billing' => [
        'zarinpal_merchant_id' => env('ZARINPAL_MERCHANT_ID', '00000000-0000-0000-0000-000000000000'),
        'currency' => 'تومان'
    ],

    'notifications' => [
        'kavenegar_api_key' => env('KAVENEGAR_API_KEY', '')
    ]
];
