@extends('layouts.app')

@section('content')
    <section class="relative mx-3 mt-4 overflow-hidden rounded-3xl bg-[linear-gradient(125deg,#10233f,#175652)] text-white shadow-2xl shadow-slate-900/15 sm:mx-5 lg:mx-8 lg:mt-8">
        <div class="absolute -top-36 -right-24 size-96 rounded-full border border-white/10 shadow-[0_0_0_55px_rgba(255,255,255,0.035),0_0_0_110px_rgba(255,255,255,0.02)]" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-6xl items-center gap-12 px-6 py-14 sm:px-10 lg:grid-cols-[1.1fr_0.9fr] lg:px-14 lg:py-20">
            <div>
                <p class="text-xs font-extrabold tracking-[0.2em] text-teal-200 uppercase">Simple sales better service</p>
                <h1 class="mt-4 max-w-3xl text-4xl leading-[1.04] font-black tracking-[-0.05em] text-balance sm:text-5xl lg:text-6xl">Your store organized in one place.</h1>
                <p class="mt-6 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg">A clean Laravel foundation for keeping customer and team account information easy to find, review, and manage.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="rounded-xl bg-coral px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-coral/25 hover:-translate-y-0.5 hover:bg-[#d95743]" href="{{ route('customers.index') }}">View customers</a>
                    <a class="rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-extrabold text-white hover:-translate-y-0.5 hover:bg-white/15" href="{{ route('users.index') }}">View team</a>
                </div>
            </div>

            <div class="relative hidden rotate-1 rounded-3xl bg-white p-7 text-ink shadow-2xl shadow-slate-950/30 sm:block">
                <div class="absolute inset-3 rounded-2xl border border-dashed border-teal-200" aria-hidden="true"></div>
                <div class="relative flex items-center justify-between border-b border-dashed border-slate-300 pb-5 text-xs font-bold">
                    <span>Workspace overview</span>
                    <span class="text-emerald-600"><i class="mr-1.5 inline-block size-2 rounded-full bg-emerald-400"></i>System ready</span>
                </div>
                <div class="relative py-9 text-center">
                    <span class="text-xs text-slate-500">Required application pages</span>
                    <strong class="block text-7xl leading-none font-black tracking-tight text-navy">04</strong>
                </div>
                <div class="relative grid grid-cols-2 gap-3">
                    <div class="rounded-xl bg-slate-50 p-4"><span class="block text-xs text-slate-500">Customer records</span><strong class="text-2xl">{{ str_pad((string) $customerCount, 2, '0', STR_PAD_LEFT) }}</strong></div>
                    <div class="rounded-xl bg-slate-50 p-4"><span class="block text-xs text-slate-500">Team users</span><strong class="text-2xl">{{ str_pad((string) $userCount, 2, '0', STR_PAD_LEFT) }}</strong></div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-5 py-14 sm:px-8 lg:py-18">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-extrabold tracking-[0.18em] text-teal-700 uppercase">Quick access</p>
                <h2 class="mt-2 text-3xl font-black tracking-[-0.04em]">Manage your records</h2>
            </div>
            <p class="max-w-md text-sm leading-6 text-slate-500">Browse the customer and team directories for your store.</p>
        </div>

        <div class="mt-8 grid gap-5 md:grid-cols-3">
            <a class="group rounded-3xl border border-slate-200 bg-white p-7 shadow-sm hover:-translate-y-1 hover:border-teal-200 hover:shadow-xl hover:shadow-slate-900/8" href="{{ route('customers.index') }}">
                <span class="grid size-12 place-items-center rounded-2xl bg-teal-50 text-teal-700" aria-hidden="true">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" /></svg>
                </span>
                <h3 class="mt-6 text-lg font-extrabold">Customer Accounts</h3>
                <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">Browse names, contact emails, phone numbers, and registration dates.</p>
                <span class="mt-6 flex items-center justify-between text-sm font-extrabold text-coral">Open directory <span class="group-hover:translate-x-1">&rarr;</span></span>
            </a>

            <a class="group rounded-3xl border border-slate-200 bg-white p-7 shadow-sm hover:-translate-y-1 hover:border-amber-200 hover:shadow-xl hover:shadow-slate-900/8" href="{{ route('users.index') }}">
                <span class="grid size-12 place-items-center rounded-2xl bg-amber-50 text-amber-700" aria-hidden="true">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8" /></svg>
                </span>
                <h3 class="mt-6 text-lg font-extrabold">User Accounts</h3>
                <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">Review usernames, full names, user IDs, and creation dates.</p>
                <span class="mt-6 flex items-center justify-between text-sm font-extrabold text-coral">Open directory <span class="group-hover:translate-x-1">&rarr;</span></span>
            </a>

            <a class="group rounded-3xl border border-slate-200 bg-white p-7 shadow-sm hover:-translate-y-1 hover:border-sky-200 hover:shadow-xl hover:shadow-slate-900/8" href="{{ route('about') }}">
                <span class="grid size-12 place-items-center rounded-2xl bg-sky-50 text-sky-700" aria-hidden="true">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10" /><path d="M12 16v-4M12 8h.01" /></svg>
                </span>
                <h3 class="mt-6 text-lg font-extrabold">About SariPOS</h3>
                <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">Learn about SariPOS and its customer and team directories.</p>
                <span class="mt-6 flex items-center justify-between text-sm font-extrabold text-coral">Learn more <span class="group-hover:translate-x-1">&rarr;</span></span>
            </a>
        </div>
    </section>
@endsection
