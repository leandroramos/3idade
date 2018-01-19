<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MatriculaEfetuada extends Mailable
{
    use Queueable, SerializesModels;

    public $candidato;
    public $turmas;
    public $ficha;
    public $disciplinas;
    public $ano;
    public $semestre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidato, $turmas, $ficha, $disciplinas, $ano, $semestre)
    {
        $this->candidato = $candidato;
        $this->turmas = $turmas;
        $this->ficha = $ficha;
        $this->disciplinas = $disciplinas;
        $this->ano = $ano;
        $this->semestre = $semestre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ccex-eca@usp.br')
                    ->subject('Matrícula efetuada.')
                    ->view('emails.matriculas.efetuada');
    }
}
