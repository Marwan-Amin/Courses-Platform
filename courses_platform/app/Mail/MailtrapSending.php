<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
USE App\User;
class MailtrapSending extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('mail@example.com', 'Mailtrap')
        //     ->subject('Mailtrap Confirmation')
        //     ->markdown('mails.mail')
        //     ->with([
        //         'name' => 'New Mailtrap User',
        //         'link' => 'https://mailtrap.io/inboxes'
        //     ]);
    return $this->markdown('mails.mail')->with('user',$this->user);
    }
}