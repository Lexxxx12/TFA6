@extends('layouts.app')

@section('content')
    <section class="relative mx-3 mt-4 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/5 sm:mx-5 lg:mx-8 lg:mt-8">
        <div class="absolute -right-24 -bottom-56 size-96 rounded-full border-[4rem] border-amber-50" aria-hidden="true"></div>
        <div class="relative mx-auto max-w-6xl px-6 py-9 sm:px-10 lg:px-12">
            <p class="text-xs font-extrabold tracking-[0.18em] text-teal-700 uppercase">Staff directory</p>
            <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-4xl font-black tracking-[-0.05em]">User Accounts</h1>
                    <p class="mt-2 text-sm text-slate-500">Team members with access to the point-of-sale workspace.</p>
                </div>
                <span class="w-fit rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-extrabold text-slate-600">{{ count($users) }} records</span>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-5 py-8 sm:px-8 lg:py-10">
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/5">
            <div class="overflow-x-auto">
                <table class="w-full min-w-3xl text-left">
                    <thead class="bg-slate-100 text-[0.7rem] tracking-[0.12em] text-slate-500 uppercase">
                        <tr>
                            <th class="px-6 py-4 font-extrabold">Username</th>
                            <th class="px-6 py-4 font-extrabold">Full name</th>
                            <th class="px-6 py-4 font-extrabold">User ID</th>
                            <th class="px-6 py-4 font-extrabold">Date created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($users as $user)
                            <tr class="hover:bg-slate-50/80">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-amber-50 text-xs font-black text-amber-700">{{ str($user->full_name)->substr(0, 1)->upper() }}</span>
                                        <code class="rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-bold text-slate-700">{{ $user->username }}</code>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-bold">{{ $user->full_name }}</td>
                                <td class="px-6 py-5"><span class="rounded-full bg-teal-50 px-2.5 py-1 text-xs font-extrabold text-teal-700">{{ $user->id }}</span></td>
                                <td class="px-6 py-5 whitespace-nowrap text-slate-600">{{ $user->created_at->format('M j, Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-10 text-center text-slate-500">No users records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
