<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SariPOS account directories built with Laravel.">

        <title>{{ $title }} | SariPOS</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-h-screen lg:grid lg:grid-cols-[17rem_minmax(0,1fr)]">
            <aside class="bg-navy px-5 py-5 text-white lg:sticky lg:top-0 lg:h-screen lg:px-6 lg:py-8">
                <div class="flex h-full flex-col gap-7">
                    <div class="flex items-center justify-between gap-5">
                        <a class="flex items-center gap-3" href="{{ route('home') }}" aria-label="SariPOS home">
                            <span class="grid size-11 -rotate-3 place-items-center rounded-2xl bg-coral shadow-lg shadow-coral/25" aria-hidden="true">
                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 9h16l-1-5H5L4 9Z" />
                                    <path d="M5 9v11h14V9M9 20v-6h6v6" />
                                </svg>
                            </span>
                            <span class="text-xl font-extrabold tracking-tight">Sari<span class="text-amber-300">POS</span></span>
                        </a>
                        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[0.65rem] font-bold tracking-[0.16em] text-teal-200 uppercase lg:hidden">Laravel</span>
                    </div>

                    <nav class="grid grid-cols-2 gap-2 sm:flex sm:overflow-x-auto sm:pb-1 lg:grid" aria-label="Main navigation">
                        @php
                            $navigation = [
                                ['route' => 'home', 'label' => 'Overview', 'icon' => '⌂'],
                                ['route' => 'customers.index', 'label' => 'Customers', 'icon' => '◎'],
                                ['route' => 'users.index', 'label' => 'Team users', 'icon' => '◇'],
                                ['route' => 'about', 'label' => 'About', 'icon' => 'i'],
                            ];
                        @endphp

                        @foreach ($navigation as $item)
                            <a
                                class="flex min-w-0 items-center gap-2 rounded-xl px-3 py-3 text-xs font-semibold sm:shrink-0 sm:gap-3 sm:px-3.5 sm:text-sm {{ request()->routeIs($item['route']) ? 'bg-white/10 text-white shadow-[inset_3px_0_0_#ec6b56]' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}"
                                href="{{ route($item['route']) }}"
                                @if (request()->routeIs($item['route'])) aria-current="page" @endif
                            >
                                <span class="grid size-7 place-items-center rounded-lg border border-white/10 text-xs font-extrabold text-teal-200" aria-hidden="true">{{ $item['icon'] }}</span>
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </nav>

                    <div class="mt-auto hidden items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-4 lg:flex">
                        <span class="size-2.5 rounded-full bg-emerald-300 shadow-[0_0_0_5px_rgba(110,231,183,0.12)]"></span>
                        <span class="grid">
                            <strong class="text-xs">Store system</strong>
                            <small class="text-[0.7rem] text-slate-400">Online and ready</small>
                        </span>
                    </div>
                </div>
            </aside>

            <div class="flex min-h-screen min-w-0 flex-col">
                <header class="hidden min-h-20 items-center justify-between border-b border-slate-200 bg-white/85 px-8 backdrop-blur lg:flex">
                    <div class="grid">
                        <span class="text-[0.68rem] font-extrabold tracking-[0.16em] text-slate-400 uppercase">SariPOS workspace</span>
                        <strong>{{ $title }}</strong>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="grid size-10 place-items-center rounded-xl bg-teal-50 text-xs font-extrabold text-teal-700">A</span>
                        <span class="grid">
                            <strong class="text-sm">Admin</strong>
                            <small class="text-xs text-slate-400">Administrator</small>
                        </span>
                    </div>
                </header>

                <main class="flex-1">
                    @yield('content')
                </main>

                <footer class="mx-3 mt-6 rounded-t-2xl bg-white px-5 py-6 text-xs text-slate-500 sm:mx-5 sm:px-8 lg:mx-8">
                    <div class="mx-auto flex max-w-6xl flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <span>&copy; {{ now()->year }} SariPOS</span>
                        <span>Built with Laravel {{ app()->version() }}</span>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
