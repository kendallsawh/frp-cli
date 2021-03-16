<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class NotifiyApplicant extends Notification
{
    use Queueable;
    protected $name;
    protected $appdate;
    protected $county;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$appdate,$county,$regtype)
    {
        $this->name = $name;
        $this->appdate = $appdate;
        $this->county = $county;
        $this->regtype = $regtype;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Farmer Registration Appointment Notification')
                    ->greeting('Hello, '.$this->name)
                    ->line('Thank you for using our appointment application!')
                    ->line(new HtmlString('Your <strong>'.$this->regtype.'</strong> registration will take place at the following County office on the specified date'))
                    ->line('County: '.$this->county->county)
                    ->line('Address: '.$this->county->address)
                    ->line('Contact: '.$this->county->contact)
                    ->line('Date of appointment: '.$this->appdate)
                    ->line('To ensure an efficient registration process please note the following:')
                    ->line('On the '.$this->appdate.' proceed to the above office where you must provide')
                    ->line('1) Two passsport sized photos.')
                    ->line('2) One form of identification; Valid National ID or Passport')
                    ->line('3) Suporting documents(original and copy) on the parcel(s) of land you are registering with.')
                    ->line('You may also print this email and present it to the registration clerk on the day of the appointment.')
                    ->line('Note: The County operational hours are from 8am - 3pm daily.');
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
