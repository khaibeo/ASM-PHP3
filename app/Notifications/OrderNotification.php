<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $order;

    public function __construct($order)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Đặt hàng thành công '. '#' . $this->order->id)
            ->line('Đơn hàng số #' . $this->order->id . ' của bạn đã được đặt thành công vào lúc ' . Carbon::now()->format('d/m/Y H:i:s'))
            ->line('Người nhận: ' . $this->order->name)
            ->line('Số điện thoại: ' . $this->order->phone)
            ->line('Địa chỉ: ' . $this->order->address)
            ->line('Tổng số tiền: ' . number_format($this->order->total_amount,0,',','.') . ' đ' )
            ->action('Xem thông tin chi tiết', url('/'))
            ->line('Cảm ơn bạn đã đặt hàng!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
