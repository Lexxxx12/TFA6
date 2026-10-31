@extends('layouts.app')

@section('content')
    <section class="relative mx-3 mt-4 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/5 sm:mx-5 lg:mx-8 lg:mt-8">
        <div class="absolute -right-24 -bottom-56 size-96 rounded-full border-[4rem] border-teal-50" aria-hidden="true"></div>
        <div class="relative mx-auto max-w-5xl px-6 py-12 sm:px-10 lg:px-14 lg:py-16">
            <p class="text-xs font-extrabold tracking-[0.18em] text-teal-700 uppercase">About the project</p>
            <h1 class="mt-3 max-w-4xl text-4xl leading-tight font-black tracking-[-0.05em] text-balance sm:text-5xl">A Laravel foundation for a clearer checkout workspace.</h1>
            <p class="mt-5 max-w-3xl text-base leading-7 text-slate-500">SariPOS demonstrates how Laravel routes requests to controllers, how controllers prepare data, and how Blade templates turn that data into responsive pages.</p>
        </div>
    </section>

    <section class="mx-auto grid max-w-5xl gap-5 px-5 py-10 sm:px-8 lg:grid-cols-[1.35fr_0.65fr] lg:py-14">
        <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm sm:p-9">
            <h2 class="text-2xl font-black tracking-[-0.035em]">TFA6 Laravel edition</h2>
            <div class="mt-5 space-y-4 text-sm leading-7 text-slate-600">
                <p>This release recreates the core SariPOS experience with Laravel 13 while preserving the latest navy, coral, and teal application-shell design from the previous project.</p>
                <p>Customer and user records are stored in a database and retrieved through Eloquent models. Migrations define the tables, and a seeder supplies six sample records per directory.</p>
            </div>
        </article>

        <aside class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
            <p class="text-xs font-extrabold tracking-[0.18em] text-teal-700 uppercase">Technology</p>
            <dl class="mt-5 divide-y divide-slate-100 text-sm">
                <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Framework</dt><dd class="font-extrabold">Laravel 13</dd></div>
                <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Language</dt><dd class="font-extrabold">PHP 8.3+</dd></div>
                <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Templates</dt><dd class="font-extrabold">Blade</dd></div>
                <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Data source</dt><dd class="font-extrabold">Eloquent ORM</dd></div>
            </dl>
        </aside>
    </section>
@endsection
