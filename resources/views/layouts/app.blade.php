<!-- Main Layout Template -->
<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10 Task List App</title>

    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- AlpineJs CDN --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- This allow to reuse styles for classes, it also disable extension of blade auto formatter --}}
    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
        }

        .btn-cyan {
            @apply bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 px-4 rounded
        }

        .btn-gray {
            @apply bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded
        }

        .btn-task-completed {
            @apply bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-2 rounded
        }

        .btn-task-not-completed {
            @apply bg-orange-500 hover:bg-orange-700 text-white font-semibold py-2 px-2 rounded
        }

        .btn-task-delete {
            @apply bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-2 rounded
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }

        label {
            @apply block mb-2 text-gray-700 text-sm font-semibold
        }

        input, textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-enable --}}

    <!-- yield allow to push data related to the section defined -->
    @yield('styles')
</head>

<body class="container shadow-md mx-auto mt-10 mb-10 max-w-4xl bg-gradient-to-r from-cyan-500 to-blue-700">
    <div class="mt-8 bg-white p-4 shadow rounded-lg">

        <!-- Display Title section -->
        <h1 class="mb-4 text-2xl">@yield('title')</h1>
        <div class="my-1"></div> <!-- Espaço de separação -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> <!-- Línha com gradiente -->

        <!-- Display Content section -->
        <div x-data="{ flash: true }"> {{-- x-data allow to define a new alpinejs component --}}
            {{-- Display flash message of success linked to route --}}
            @if (session()->has('success'))

                <div x-show="flash"
                    class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <div>{{ session('success') }}</div>

                    {{-- close icon on top right corner --}}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            @click="flash = false" {{-- the click event will set the flash variable to false --}}
                            stroke="currentColor" class="h-6 w-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>

</html>
