<?php
namespace Modules\Admin\Entities;

use Modules\Access\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{

  public $user;
  public $id;
  public $confirmation_code;
  

  use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(User $user, int $id, string $code)
    {
      $this->user = $user;
      $this->id = $id;
      $this->confirmation_code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('vendor.maileclipse.templates.resetPassword')->with(['id' => $this->id, 'confirmation_code' => $this->confirmation_code ]);
    }
}
