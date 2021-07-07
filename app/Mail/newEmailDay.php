<?php

namespace App\Mail;

use App\Models\checkMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newEmailDay extends Mailable
{
    use Queueable, SerializesModels;
    private $tasks;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tasks = $this->tasks;
        $users = User::where('mod_id', 1)->select('email')->get();
        $this->subject('Informações de Tarefas Expirando');
        $this->to($users);
        checkMail::create([
            'dateMail' => date('Y/m/d'),
            'checkSend' => 1
        ]);
        return $this->markdown('mail.newMailDay', compact('tasks'));
    }
}
