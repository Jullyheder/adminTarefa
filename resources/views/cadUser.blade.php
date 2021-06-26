<!doctype html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Usuário</title>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-guest-layout>
                        <x-auth-card>
                            <x-slot name="logo">

                            </x-slot>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                                <div>
                                    <x-label for="name" :value="__('Usuário')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>

                                <!-- Name Complete -->
                                <div class="mt-4">
                                    <x-label for="nameComplete" :value="__('Nome Completo')" />

                                    <x-input id="nameComplete" class="block mt-1 w-full"
                                             type="text"
                                             name="nameComplete" required />
                                </div>

                                <!-- Mod -->
                                <div class="mt-4">
                                    <div>
                                        <div>
                                            <x-label for="mod" :value="__('Permissão')" />
                                        </div>
                                        <div>
                                            <div>
                                                <input id="1" type="radio" name="mod" value="1" required />
                                                <label for="1">Administrador</label>
                                            </div>
                                            <div>
                                                <input id="2" type="radio" name="mod" value="2" required />
                                                <label for="2">Usuário</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Senha')" />

                                    <x-input id="password" class="block mt-1 w-full"
                                             type="password"
                                             name="password"
                                             required autocomplete="new-password" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                             type="password"
                                             name="password_confirmation" required />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Register') }}
                                    </x-button>
                                </div>
                            </form>
                        </x-auth-card>
                    </x-guest-layout>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</body>
</html>

