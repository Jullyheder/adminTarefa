<!doctype html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categoria') }}
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
                            <a href="{{ route('cadcategory') }}" class="register" title="Registrar Usuário">+</a>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Prioridade</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->category_desc }}</td>
                                        <td>{{ $category->priority->priority_desc }}</td>
                                        <td class="attribute">
                                            <a href="{{ route('editcategory', ['category' => $category->id]) }}" class="attEdit" title="Editar Categoria">Editar</a>
                                            <form action="{{ route('delcategory', ['category' => $category->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="attDelete" onclick="return confirm('Deseja realmente excluir a categoria: ({{ $category->category_desc }})');">
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
