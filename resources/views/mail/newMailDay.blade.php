@component('mail::message')
    <h1>Tarefas expirando hoje sem solução</h1>

    @foreach($tasks as $task)
                Descrição da Tarefa: {{ $task->task_desc }}

                    Situação: {{ $task->situation->situation_desc }}

                    Prioridade: {{ $task->priority->priority_desc }}

                    Usuário: {{ $task->user->nameComplete }}

        @if($task->category_id !== null)
            Categoria: {{ $task->category->category_desc }}
        @endif

        @if($task->data_limit !== null)
            Data Vencimento: {{ date('d/m/Y', strtotime($task->data_limit)) }}
        @endif

        @if($task->annotate !== null)
            Anotação: {{ $task->annotate }}
        @endif

    _______________________________________________________________________________________________________
    @endforeach
@endcomponent
