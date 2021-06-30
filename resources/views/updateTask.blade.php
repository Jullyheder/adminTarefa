<!doctype html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Tarefa</title>
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

            <form method="POST" action="{{ route('updateuser', ['user' => $user->id]) }}">
            @csrf
            @method('PUT')
            <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Usuário')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                </div>

                <!-- Name Complete -->
                <div class="mt-4">
                    <x-label for="nameComplete" :value="__('Nome Completo')" />

                    <x-input id="nameComplete" class="block mt-1 w-full"
                             type="text"
                             name="nameComplete" value="{{ $user->nameComplete }}" required />
                </div>

                <!-- Mod -->
                <div class="mt-4">
                    <div>
                        <div>
                            <x-label for="mod" :value="__('Permissão')" />
                        </div>
                        <div>
                            <div>
                                <input id="1" type="radio" name="mod_id" value="1" {{ $user->mod_id === 1 ? 'checked' : '' }} required />
                                <label for="1">Administrador</label>
                            </div>
                            <div>
                                <input id="2" type="radio" name="mod_id" value="2" {{ $user->mod_id === 2 ? 'checked' : '' }} required />
                                <label for="2">Usuário</label>
                            </div>
                        </div>
                    </div>
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
</body>
</html>

