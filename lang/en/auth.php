<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'messages' => [
        'account_approval' => 'Please wait for approval to access your account.',
        'registeration' => [
            'success' => 'You have registered successfully.',
            'phone_unique' => 'The phone number has already been taken.',
        ],
        'login' => [
            'success' => 'Login Successful.',
            'failed' => 'Invalid Credentials! Please try again.',
        ],
        'logout' => [
            'success' => 'Successfully logged out.',
        ],
        'forgot_password' => [
            'success' => 'We have sent email with reset password link. Please check your inbox!.',
            'success_update' => 'Your password has been reset successfully. You can now log in with your new password.',
            'otp_sent' => 'We have sent email with OTP. Please check your inbox!.',
            'validation' => [
                'invalid_request' => 'This password reset request is invalid or expired.',
                'invalid_token_email' => 'Invalid Token or Email!',
            ],
        ],
        'profile' => [
            'update' => 'Profile updated successfully.',
        ],
        'password' => [
            'update' => 'Password updated successfully.',
            'error_wrong_old_pass' => 'The current password is incorrect.',
        ],
    ],
    'unauthorize' => 'You are not authorized to perform this action.',
];
