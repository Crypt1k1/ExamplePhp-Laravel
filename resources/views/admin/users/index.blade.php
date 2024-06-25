@extends('layouts.layoutadmins')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-3xl font-semibold text-gray-800">Users List</h1>
                <p class="text-lg text-gray-600 mt-2">List of users and their favorite cars.</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="mb-4">
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="flex items-center">
                            <input type="text" name="search" id="search" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search by user name..." value="{{ request()->get('search') }}">
                            <button type="submit" class="ml-2 bg-blue-500 text-white rounded-md px-4 py-2">Search</button>
                            @if (request()->has('search') && !empty(request()->get('search')))
                                <a href="{{ route('users.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">Clear</a>
                            @endif
                        </div>
                    </form>
                </div>
                @if ($users->isEmpty())
                    <p class="text-gray-600">No users found.</p>
                @else
                    <div class="-mx-4">
                        @foreach ($users as $user)
                            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                                <div class="flex-1">
                                    <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                    @foreach ($user->roles as $role)
                                        <span class="inline-block bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                                <div class="flex-1">
                                    @if ($user->cars->isEmpty())
                                        <p class="text-sm text-gray-600">No favorite cars</p>
                                    @else
                                        <ul>
                                            @foreach ($user->cars as $car)
                                                <li>{{ $car->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
