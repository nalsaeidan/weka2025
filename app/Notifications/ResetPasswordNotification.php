<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * إعداد رسالة البريد الإلكتروني لإعادة تعيين كلمة المرور.
     */
    public function toMail($notifiable)
    {
        // رابط إعادة تعيين كلمة المرور
        $resetUrl = url(config('app.url') . route('password.reset', $this->token, false));

        // تمرير المتغيرات إلى القالب باستخدام view()
        return (new MailMessage)
            ->subject('رابط إعادة تعيين كلمة المرور')
            ->greeting('مرحبًا ' . $notifiable->name . '!')
            ->line('لقد طلبت رابطًا لإعادة تعيين كلمة المرور.')
            ->action('إعادة تعيين كلمة المرور', $resetUrl)
            ->line('إذا لم تطلب ذلك، فلا داعي لأي إجراء.')
            // هنا نمرر المتغيرات للقالب باستخدام view()
            ->view(
                'vendor.notifications.email', // تأكد من أن هذا القالب هو القالب الصحيح الذي تستخدمه
                ['resetUrl' => $resetUrl, 'notifiable' => $notifiable] // تم تمرير المتغيرات هنا
            );
    }
}
