<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class NovaSenhaMail extends Mailable
{

use Queueable, SerializesModels;

public $senha;

public $usuario;

public function __construct($senha,$usuario)
{

$this->senha=$senha;

$this->usuario=$usuario;

}

public function build()
{

return $this

->subject('Nova senha do sistema')

->view('emails.nova-senha')

->with([

'senha'=>$this->senha,

'usuario'=>$this->usuario

]);

}

}