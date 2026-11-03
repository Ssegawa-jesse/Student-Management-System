@extends('layouts.sms')

@section('title', 'Users & roles')

@section('content')
    <h1 class="text-2xl font-extrabold tracking-tight">Users &amp; roles</h1>
    <p class="text-sm text-slate-500 mb-6">Control who can access what by changing a user's role.</p>

    <form method="GET" class="card p-4 mb-5 flex flex-col sm:flex-row gap-3">
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Search name or email" class="input">
        <select name="role" class="input sm:!w-48">
            <option value="">All roles</option>
            @foreach ($roles as $role)
                <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        <button class="btn-ghost">Filter</button>
    </form>

    <div class="card overflow-x-auto">
        <table class="w-full min-w-[640px]">
            <thead>
                <tr>
                    <th class="th">Name</th>
                    <th class="th">Email</th>
                    <th class="th">Current role</th>
                    <th class="th">Change role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="td font-semibold">{{ $user->name }}</td>
                        <td class="td text-slate-500">{{ $user->email }}</td>
                        <td class="td capitalize">{{ $user->getRoleNames()->implode(', ') ?: '—' }}</td>
                        <td class="td">
                            <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="role" class="input !py-1.5 !w-36">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" @selected($user->hasRole($role))>{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                                <button class="btn-primary !py-1.5 !text-xs">Save</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
@endsection
