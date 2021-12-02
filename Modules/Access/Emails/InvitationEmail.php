<?php

namespace Modules\Access\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Access\Entities\Invitation;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (view()->exists('vendor.maileclipse.templates.invitation')) {
            return $this->from(config('mail.from.address'))
                ->view('vendor.maileclipse.templates.invitation')
                ->with(['invitation' => $this->invitation]);
        } else {
            return $this->from(config('mail.from.address'))
                ->markdown('access::emails.invitation')
                ->with(['invitation' => $this->invitation]);
        }
                    
    }
}
