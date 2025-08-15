<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;
    protected $oldStatus;
    protected $newStatus;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking, $oldStatus, $newStatus, $message = null)
    {
        $this->booking = $booking;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['database'];
        
        // Only send email to pro users
        if ($notifiable->isProActive()) {
            $channels[] = 'mail';
        }
        
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusText = ucfirst(str_replace('_', ' ', $this->newStatus));
        
        return (new MailMessage)
            ->subject("Booking Update: {$this->booking->booking_number}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("Your booking #{$this->booking->booking_number} has been updated.")
            ->line("Status: {$statusText}")
            ->when($this->message, function ($mail) {
                return $mail->line("Message: {$this->message}");
            })
            ->line("Courier Company: {$this->booking->courierCompany->company_name}")
            ->action('View Booking', route('bookings.show', $this->booking))
            ->line('Thank you for using Daak Khana!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'booking_number' => $this->booking->booking_number,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => $this->message,
            'courier_company' => $this->booking->courierCompany->company_name,
        ];
    }
}