<!doctype html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarefas</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tarefas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="userRegister" style="justify-content: space-between;">
                        @if(Auth::user()->mod_id === 1)
                            <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Procurar Usuário..."/>
                        @endif
                        <select id="searchPriority" name="searchPriority" class="form-select" aria-label="Default select example">
                            <option value="" selected>Procurar Prioridade...</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->priority_desc }}</option>
                            @endforeach
                        </select>
                        <select id="searchSituation" name="searchSituation" class="form-select" aria-label="Default select example">
                            <option value="" selected>Procurar Situação...</option>
                            @foreach($situations as $situation)
                                <option value="{{ $situation->id }}">{{ $situation->situation_desc }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('cadtask') }}" class="register" title="Cadastrar Tarefa">+</a>
                    </div>
                    <div>
                        <div id="tableRemove">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Prioridade</th>
                                    <th scope="col">Situação</th>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Data Limite</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr onClick="toTake({{ $task->id }})" id="toView">
                                        <td>{{ $task->task_desc }}</td>
                                        <td>{{ $task->category_id !== null ? $task->category->category_desc : '' }}</td>
                                        <td>{{ $task->priority->priority_desc }}</td>
                                        <td>{{ $task->situation->situation_desc }}</td>
                                        <td>{{ $task->user->nameComplete }}</td>
                                        <td>{{ $task->data_limit !== null ? $task->data_limit->format('d/m/Y') : '' }}</td>
                                        <td class="attribute">
                                            <a href="{{ route('edittask', ['task' => $task->id]) }}" class="attEdit" title="Editar Usuário">Editar</a>
                                            <form action="{{ route('deltask', ['task' => $task->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="attDelete" onclick="return confirm('Deseja realmente excluir a tarefa: ({{ $task->task_desc }})');">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="tableAdd">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var Name = '';
    var Priority = '';
    var Situation = '';

    function toTake(id){
        // visualizar informações
        let url = "{{ route('toviewtask', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }
    function fill(value){
        // montar busca
        console.log(value);
        $("#tableAdd table").remove().slideUp();
        let rowTable = '';
        value.map(function(val){
            rowTable +=
            '<tr onClick="toTake('+ val.id +')" id="toView">' +
                '<td>'+ val.task_desc +'</td>' +
                '<td>'+ val.category_desc +'</td>' +
                '<td>'+ val.priority_desc +'</td>' +
                '<td>'+ val.situation_desc +'</td>' +
                '<td>'+ val.nameComplete +'</td>' +
                '<td>'+ val.data_limit +'</td>' +
            '</tr>'
        });
        $("#tableAdd").append('<table class="table table-bordered">' +
                '<thead>' +
                    '<tr>' +
                        '<th scope="col">Descrição</th>' +
                        '<th scope="col">Categoria</th>' +
                        '<th scope="col">Prioridade</th>' +
                        '<th scope="col">Situação</th>' +
                        '<th scope="col">Usuário</th>' +
                        '<th scope="col">Data Limite</th>' +
                        '<th scope="col"></th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>' +
                    rowTable +
                '</tbody>' +
            '</table>').slideDown();
    }
    function searchQuery(){
        // retorno de informações
        //console.log(Name + ' - ' + Priority + ' - ' + Situation);
        if(Name !== '' || Priority !== '' || Situation !== ''){
            $("#tableRemove").slideUp();
            $.ajax({
                url: "{{ route('getsearch') }}",
                type: "post",
                data: {
                    _token: CSRF_TOKEN,
                    searchName: $("#searchName").val(),
                    searchPriority: $("#searchPriority").val(),
                    searchSituation: $("#searchSituation").val(),
                },
                dataType: 'json',
                success: function(response){
                    fill(response);
                }
            })
        }
        else{
            $("#tableAdd table").remove().slideUp();
            $("#tableRemove").slideDown();
        }
    }
    $("#searchPriority").change(function () {
        let valuePriority = $('#searchPriority').val();
        Priority = valuePriority;
        searchQuery();
    });
    $("#searchSituation").change(function () {
        let valueSituation = $('#searchSituation').val();
        Situation = valueSituation;
        searchQuery();
    });
    $("#searchName").keyup(function () {
        let textName = $('#searchName').val();
        console.log(textName);
        if(textName.length > 2){
            Name = textName;
            searchQuery();
        }
        else{
            $("#tableAdd table").remove().slideUp();
            $("#tableRemove").slideDown();
            Name = '';
        }
    })
</script>
</body>
</html>
