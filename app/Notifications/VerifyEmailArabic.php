<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class VerifyEmailArabic extends VerifyEmail
{
    public function __construct(public string $route) {}

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('تحقق من بريدك الإلكتروني')
            ->greeting('مرحباً!')
            ->line('اضغط على الزر أدناه لتأكيد بريدك الإلكتروني.')
            ->action('تأكيد البريد الإلكتروني', $verificationUrl)
            ->line('إذا لم تقم بإنشاء حساب، لا تحتاج لأي إجراء إضافي.')
            ->salutation('مع التحية، فريق مدارِك');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            $this->route,
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
