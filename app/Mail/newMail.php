<?php

namespace App\Mail;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newMail extends Mailable
{
    use Queueable, SerializesModels;
    private $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //Verificar se
        /*$task = Task::whereBetween('data_limit', [date('Y/m/d'), date('Y/m/d')])
            ->whereNotIn('situation_id', [3, 4])
            ->get();*/

        $task = $this->task;
        $users = User::where('mod_id', 1)->select('email')->get();
        $this->subject('Informações de Tarefas');
        $this->to($users);
        return $this->markdown('mail.newMail', compact('task'));
    }
}
