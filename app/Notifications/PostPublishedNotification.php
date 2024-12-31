<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostPublishedNotification extends Notification
{
    use Queueable;

    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // You can add more channels like 'mail', 'sms', etc.
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'type' => 'App\Notifications\PostPublished',
            'data' => $this->toArray($notifiable),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Post Published',
            'icon' => '<i class="bi-file-earmark-check"></i>',
            'background' => 'bg-success',
            'description' => "A new post <strong>{$this->post->title}</strong> has been published.",
            'published_at' => $this->post->published_at,
            'url' => route('article.show', $this->post->slug),
        ];        
    }
}
