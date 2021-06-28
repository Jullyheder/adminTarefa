<!doctype html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Categoria') }}
        </h2>
    </x-slot>

    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">

            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('inscategory') }}">
            @csrf

            <!-- Description -->
                <div>
                    <x-label for="category_desc" :value="__('Descrição')" />

                    <x-input id="category_desc" class="block mt-1 w-full" type="text" name="category_desc" required autofocus />
                </div>

                <!-- Priority -->
                <div class="mt-4">
                    <x-label for="priority_id" :value="__('Prioridade')" />

                    <select id="priority_id" name="priority_id" class="form-select" aria-label="Default select example">
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->priority_desc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Cadastrar') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>

<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>

