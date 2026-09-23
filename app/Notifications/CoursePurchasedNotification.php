<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CoursePurchasedNotification extends Notification
{
    use Queueable;

    public Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'student_name' => $this->order->user->name,
            'student_email' => $this->order->user->email,
            'course_title' => $this->order->course->title,
            'amount' => $this->order->amount,
            'transaction_id' => $this->order->transaction_id,
            'purchased_at' => $this->order->created_at->toDateTimeString(),
        ];
    }
}
