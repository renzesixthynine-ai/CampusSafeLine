<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Campus SafeLine Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration settings for the Campus SafeLine system.
    |
    */

    // Site Information
    'site_name' => env('SAFELINE_SITE_NAME', 'Campus SafeLine'),
    'contact_email' => env('SAFELINE_CONTACT_EMAIL', 'support@campussafeline.edu'),
    'emergency_phone' => env('SAFELINE_EMERGENCY_PHONE', '1-800-SAFE-LINE'),

    // File Upload Settings
    'max_file_size' => env('SAFELINE_MAX_FILE_SIZE', 10240), // 10MB in KB
    'allowed_file_types' => env('SAFELINE_ALLOWED_FILE_TYPES', 'jpg,jpeg,png,pdf,doc,docx'),

    // Security Settings
    'pin_length' => env('SAFELINE_PIN_LENGTH', 6),
    'pin_expiry_days' => env('SAFELINE_PIN_EXPIRY_DAYS', 30),
    'session_lifetime' => env('SAFELINE_SESSION_LIFETIME', 120), // minutes

    // Notification Settings
    'notify_officers_on_new_case' => env('SAFELINE_NOTIFY_OFFICERS', true),
    'notify_reporters_on_update' => env('SAFELINE_NOTIFY_REPORTERS', true),
];
