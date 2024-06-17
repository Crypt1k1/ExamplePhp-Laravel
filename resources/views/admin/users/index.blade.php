@extends('layouts.layoutadmins')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add User</a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Roles</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->email }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @foreach ($user->roles as $role)
                                <span class="inline-block bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
