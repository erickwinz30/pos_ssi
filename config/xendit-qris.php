<?php

return [
  'url' => env('XENDIT_URL', 'https://api.xendit.co'), //ini berupa kondisi, jika xendit url di env tidak ad, maka dia pakai api.xendit.co
  'api_version' => env('XENDIT_API_VERSION', '2022-07-31'),
  'api_key' => env('XENDIT_API_KEY'),
  // 'error_code' => env('XENDIT_API_KEY'), 
];