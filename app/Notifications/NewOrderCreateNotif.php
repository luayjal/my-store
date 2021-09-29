<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderCreateNotif extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
   

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Order',
            'body' => 'The new order have created.',
            'action'=> url('/'),
            'order_id' => $this->order->id

        ];
                   
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('you have new order')
                    ->greeting('Hello!' . $notifiable->name)
                    ->line('The new order have created.')
                    ->action('view order', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toBroadcast(){
        $message = new BroadcastMessage([
            'title' => 'you have new Order',
            'body' => 'The new order have created.',
            'action'=> url('/'),
            'order_id' => $this->order->id
        ]);

        return $message;
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
