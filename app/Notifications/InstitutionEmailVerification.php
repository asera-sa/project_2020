<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InstitutionEmailVerification extends Notification
{
    use Queueable;

    protected $token;
    protected $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $userName)
    {
        $this->token = $token;
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = route('email.verification.verify', $this->token);

        return (new MailMessage)
            ->subject('تأكيد حساب المؤسسة')
            ->greeting('مرحباً ' . $this->userName)
            ->line('شكراً لك على التسجيل في نظام إدارة الرخص.')
            ->line('يرجى النقر على الزر أدناه لتأكيد حسابك:')
            ->action('تأكيد الحساب', $verificationUrl)
            ->line('هذا الرابط صالح لمدة 24 ساعة فقط.')
            ->line('إذا لم تقم بإنشاء هذا الحساب، فلا داعي لاتخاذ أي إجراء.')
            ->salutation('مع تحيات فريق النظام');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'token' => $this->token,
            'user_name' => $this->userName,
        ];
    }
}
