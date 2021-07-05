@component('mail::message')
    <h1>Foi feita alteração na Tarefa: {{ $task->task_desc }}</h1>

    Situação: {{ $task->situation->situation_desc }}
@endcomponent
