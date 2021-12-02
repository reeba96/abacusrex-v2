<?php
namespace Modules\Admin\Entities;

use Modules\Access\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{

  public $user;
  public $confirmation_code;

  use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(User $user, string $code)
    {
      $this->user = $user;
      $this->confirmation_code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('vendor.maileclipse.templates.verification')->with(['confirmation_code' => $this->confirmation_code,]);
      // return $this->view('admin::admin.email.verify')->with(['confirmation_code' => $this->confirmation_code,]);
    }
}
