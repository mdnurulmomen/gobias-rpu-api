<?php

namespace App\Traits;

use App\Jobs\UniMailRunner;
use App\Jobs\UniSMSRunner;
use Illuminate\Support\Facades\Http;

trait SendNotification
{
    public function sendOTP($code, $phone)
    {
        $template = "আপনি পাসওয়ার্ড রিসেট এর অনরোধ গৃহিত হয়েছে। আপনার ভেরিফিকেশন কোড %s";
        $body = sprintf($template, $code);
        $phone = (string)$phone;

        $send = Http::post(config('sms_otp.sms_api_url'), [
            'auth' => [
                'username' => config('sms_otp.sms_api_user'),
                'password' => config('sms_otp.sms_api_pass'),
                'acode' => config('sms_otp.sms_api_a_code'),
            ],
            'smsInfo' => [
                'message' => $body,
                'masking' => config('sms_otp.sms_api_masking'),
                'msisdn' => [
                    $phone
                ]
            ]
        ]);
    }

    public function sendSMSNotification($template, $phone, $text = '')
    {
        $details = [
            'template' => $template,
            'phone' => $phone,
            'text' => $text,
        ];
        UniSMSRunner::dispatch($details);
    }

    public function sendMailNotification($template, $email, $subject, $body = [])
    {
        $details = [
            'email' => $email,
            'subject' => $subject,
            'template' => $template,
            'body' => $body,
        ];
        UniMailRunner::dispatch($details);
    }

    public function smsNotify($template, $phone, $text = '')
    {
        $n_doptor = ' -দপ্তর।';
        if ($template == config('notifiable_constants.protikolpo_assign')) {
            $body = "আপনি প্রতিকল্পে অ্যাসাইন হয়েছেন।";
        } else if ($template == config('notifiable_constants.protikolpo_revert')) {
            $body = sprintf('%s স্বপদে বহাল হয়েছেন।', $text);
        } else if ($template == config('notifiable_constants.pass_change')) {
            $body = ' আপনার পাসওয়ার্ড পরিবর্তিত হয়েছে।';
        } else if ($template == config('notifiable_constants.sign_change')) {
            $body = ' আপনার স্বাক্ষর পরিবর্তিত হয়েছে।';
        } else if ($template == config('notifiable_constants.profile_pic_change')) {
            $body = ' আপনার প্রোফাইল ছবি পরিবর্তিত হয়েছে।';
        } else {
            $body = '';
        }

        $phone = (string)$phone;

        $send = Http::post(config('sms_otp.sms_api_url'), [
            'auth' => [
                'username' => config('sms_otp.sms_api_user'),
                'password' => config('sms_otp.sms_api_pass'),
                'acode' => config('sms_otp.sms_api_a_code'),
            ],
            'smsInfo' => [
                'message' => $body . $n_doptor,
                'masking' => config('sms_otp.sms_api_masking'),
                'msisdn' => [
                    $phone
                ]
            ]
        ]);
    }
}
