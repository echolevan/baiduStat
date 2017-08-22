<?php
return [
    'PUK' => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDHn/hfvTLRXViBXTmBhNYEIJeG
GGDkmrYBxCRelriLEYEcrwWrzp0au9nEISpjMlXeEW4+T82bCM22+JUXZpIga5qd
BrPkjU08Ktf5n7Nsd7n9ZeI0YoAKCub3ulVExcxGeS3RVxFai9ozERlavpoTOdUz
EH6YWHP4reFfpMpLzwIDAQAB
-----END PUBLIC KEY-----
',
    'LOGIN_URL' => 'https://api.baidu.com/sem/common/HolmesLoginService',
    'API_URL' => 'https://api.baidu.com/json/tongji/v1/ReportService',
    'USERNAME' => env('BDTJ_USERNAME', ''),
    'PASSWORD' => env('BDTJ_PASSWORD', ''),
    'TOKEN' => env('BDTJ_TOKEN', ''),
    'UUID' => env('BDTJ_UUID', ''),
    'ACCOUNT_TYPE' => '1',
];