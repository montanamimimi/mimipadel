<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>

        @livewireStyles

        @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <header>
            <div class="container">

                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/mimi_logo--small.png') }}" alt="Logo">
                    </a>
                </div>
                <div class="menu">
            
                    <nav>
                        <a
                            href="{{ url('/') }}"
                            class="btn btn--small btn--white"
                        >
                            Home
                        </a>       
                        <a
                            href="{{ route('players.index') }}"
                            class="btn btn--small btn--white"
                        >
                            Players
                        </a>                                       
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="btn btn--small btn--white"
                            >
                                Admin
                            </a>                      
                            <a
                                href="{{ route('admin.tournaments.index') }}"
                                class="btn btn--small btn--white"
                            >
                                Edit Tournaments
                            </a>
                        
                        @else
                            {{-- <a
                                href="{{ route('login') }}"
                                class="btn btn--small btn--white"
                            >
                                Log in
                            </a> --}}

                            {{-- @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="btn btn--small btn--white">
                                    Register
                                </a>
                            @endif --}}
                        
                        @endauth
                    </nav>
                </div>
     
            </div>
        </header>    
        <main>
            <div class="container">
                {{ $slot }} 
            </div>
        </main>        
        

        @livewireScripts
    </body>
</html>
