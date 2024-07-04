<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>

        <!-- Centered Container for Button -->
        <div class="flex justify-center mt-8">
            <button class="btn btn-shadow btn-shadow--black" onclick="window.location='{{ url('/currency-exchanges') }}'">
                <span>
                    Exchange Currency
                </span>
            </button>
            <button class="btn btn-shadow btn-shadow--black" onclick="window.location='{{ url('/fees') }}'">
                <span>
                    Fee Info
                </span>
            </button>
        </div>
    </div>

    <!-- CSS Styles for Button bold letters -->
    <style>
        .btn {
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
        }

        .btn:hover .btn-slide-show-text1 {
            margin-left: 65px;
        }

        .btn-shadow {
            display: inline-block;
            margin: 5px;
            font-weight: 800;
            line-height: 24px;
            color: rgb(255, 255, 255);
            position: relative;
            text-align: center;
            background: none;
            outline: none;
            border: none;
        }

        .btn-shadow::before {
            content: "";
            height: 40px;
            position: absolute;
            bottom: -1px;
            left: 10px;
            right: 10px;
            z-index: 0;
            border-radius: 2em;
            filter: blur(14px) brightness(0.9);
        }

        .btn-shadow span {
            display: inline-block;
            transform-style: preserve-3d;
            transition: all 0.3s ease-out 0s;
            padding: 16px 60px;
            border-radius: 50em;
            position: relative;
            z-index: 2;
            will-change: transform, filter;
        }

        .btn-shadow:hover {
            color: rgb(255, 255, 255);
        }

        .btn-shadow:hover span {
            filter: brightness(0.9) contrast(1.2);
            transform: scale(0.96);
        }

        .btn-shadow:hover::before {
            bottom: 8px;
            filter: blur(6px) brightness(0.8);
            left: 15px;
            right: 15px;
        }

        .btn-shadow--black span {
            background: rgb(51, 51, 51);
        }
    </style>
</x-app-layout>
