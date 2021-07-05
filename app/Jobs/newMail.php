<?php

namespace App\Jobs;

use App\Models\Task;;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class newMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    private $task;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        $emails = array();
        foreach($users as $user){
            if($user->mod_id === 1){
                array_push($emails, $user->email);
            }
        };
        $email = new \App\Mail\newMail($this->task);
        Mail::subject('Informações de Tarefas')
            ->to($emails)
            ->send($email);
    }
}
