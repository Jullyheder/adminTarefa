<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar Tarefa</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Tarefa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card text-dark bg-light mb-3" style="width: 100%;">
                        <div class="card-header">Descrição</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->task_desc }}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">Situação</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->situation->situation_desc }}</h5>
                            </div>
                        </div>
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">Prioridade</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->priority->priority_desc }}</h5>
                            </div>
                        </div>
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">Usuário</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->user->nameComplete }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        @if($task->category_id !== null)
                            <div class="card text-dark bg-light mb-3">
                                <div class="card-header">Categoria</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $task->category->category_desc }}</h5>
                                </div>
                            </div>
                        @endif
                        @if($task->data_limit !== null)
                            <div class="card text-dark bg-light mb-3">
                                <div class="card-header">Data Limite</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ date('d/m/Y', strtotime($task->data_limit)) }}</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($task->annotate !== null)
                        <div class="card text-dark bg-light mb-3" style="width: 100%;">
                            <div class="card-header">Anotação</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->annotate }}</h5>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
</body>
</html>
