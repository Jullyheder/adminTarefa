<!doctype html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuário</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Usuário') }}
            </h2>
        </x-slot>

        <div class="py-12">
            @if($errors->all())
                @foreach($errors as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="userRegister">
                            <a href="{{ route('caduser') }}" class="register" title="Registrar Usuário">+</a>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nome Completo</th>
                                    <th scope="col">Modo</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nameComplete }}</td>
                                        <td>{{ $user->mod->mod_desc }}</td>
                                        <td class="attribute">
                                            <a href="{{ route('edituser', ['user' => $user->id]) }}" class="attEdit" title="Editar Usuário">Editar</a>
                                            <form action="{{ route('delUsers', ['user' => $user->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="attDelete" onclick="return confirm('Deseja realmente excluir o usuário: ({{ $user->nameComplete }})');">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
</body>
</html>
