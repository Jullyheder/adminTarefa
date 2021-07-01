<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tarefa') }}
        </h2>
    </x-slot>

    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">

            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('updatetask', ['task' => $task]) }}">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="task_desc" class="form-label">Descrição</label>
                    <textarea name="task_desc" class="form-control" id="task_desc" rows="1" required>{{ $task->task_desc }}</textarea>
                </div>

                <div class="mb-3">
                    <x-label for="category_desc" :value="__('Categoria')" />

                    <x-input id="category_id" class="block mt-1 w-full" type="number" value="{{ $task->category_id !== null ? $task->category_id : '' }}" name="category_id" style="display: none"/>
                    <x-input id="category" class="block mt-1 w-full" type="text" value="{{ $task->category_id !== null ? $task->category->category_desc : '' }}" name="category_desc" />
                    <div id="category_desc" class="form-text">(Opcional)</div>
                </div>

                <div class="mb-3">
                    <x-label for="priority_id" :value="__('Prioridade')" />

                    <select id="priority_id" name="priority_id" class="form-select" aria-label="Default select example" required>
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ $task->priority_id === $priority->id ? 'selected' : '' }}>{{ $priority->priority_desc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <x-label for="data_limit" :value="__('Data Limite')" />

                    <x-input id="data_limit" class="block mt-1 w-full" type="date" value="{{ $task->data_limit !== null ? date('Y-m-d', strtotime($task->data_limit)) : '' }}" name="data_limit"/>
                    <div id="data_limit" class="form-text">(Opcional)</div>
                </div>

                <div class="mb-3">
                    <label for="annotate" class="form-label">Anotação</label>
                    <textarea name="annotate" class="form-control" id="annotate" rows="3">{{ $task->annotate !== '' ? $task->annotate : '' }}</textarea>
                    <div id="annotate" class="form-text">(Opcional)</div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Editar') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $( "#category" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"{{route('getautocomplete')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#category').val(ui.item.label);
                $('#category_id').val(ui.item.value);
                document.getElementById("priority_id").value = ui.item.priority;
                return false;
            }
        });
    });
</script>
</body>
</html>
