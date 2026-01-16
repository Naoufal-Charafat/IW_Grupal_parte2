<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Test email command
Artisan::command('test:email {email}', function (string $email) {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a test email from your Laravel app!', function ($message) use ($email) {
            $message->to($email)
                    ->subject('Test Email - Fisio Clínica');
        });
        
        $this->info('✓ Email sent successfully to: ' . $email);
    } catch (\Exception $e) {
        $this->error('✗ Error sending email: ' . $e->getMessage());
    }
})->purpose('Test email configuration');
