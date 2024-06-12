@extends('layouts\layoutadmins')

@section('topmenu')
    <nav class="card">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="sm:block sm:ml-6">
                    <div class="flex space-x-4">

                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
        <div class="p-4">
            <form id="form" class="shadow-md rounded-lg px-8 pt-6 pb-8 mb-4"
                  action="{{ route('cars.store') }}" method="POST">
                @csrf

                <label class="block text-sm">
                    <span class="text-gray-700">name</span>
                    <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                    focus:outline-none focus:shadow-outline-purple form-input
                    @error('name') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                           name="name" value="{{ old('name') }}" type="text" >
                    @error('name')<span class="text-xs text-red-600">The task name does not meet the requirement</span>@enderror
                </label>



                <label class="block text-sm">
                    <span class="text-gray-700">description</span>
                    <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                    focus:outline-none focus:shadow-outline-purple form-input
                    @error('description') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                           name="description" value="{{ old('description') }}" type="text" required>
                    @error('description') <span class="text-xs text-red-600">description</span>@enderror
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700">brand</span>
                    <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                    focus:outline-none focus:shadow-outline-purple form-input
                    @error('brand') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                           name="brand" value="{{ old('brand') }}" type="text">
                    @error('brand') <span class="text-xs text-red-600">The end date does not meet the requirement</span>@enderror
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700">year</span>
                    <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                    focus:outline-none focus:shadow-outline-purple form-input
                    @error('year') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                           name="year" value="{{ old('year') }}" type="text">
                    @error('year') <span class="text-xs text-red-600">The end date does not meet the requirement</span>@enderror
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700">Image</span>
                    <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                    focus:outline-none focus:shadow-outline-purple form-input"
                           name="image" type="file">
                    @error('image') <span class="text-xs text-red-600">The image upload failed</span>@enderror
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700">Avg. price</span>
                    <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                    focus:outline-none focus:shadow-outline-purple form-input
                    @error('avarageprice') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                           name="avarageprice" value="{{ old('avarageprice') }}" type="text">
                    @error('avarageprice') <span class="text-xs text-red-600">The end date does not meet the requirement</span>@enderror
                </label>

                <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150
                bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700
                focus:outline-none focus:shadow-outline-purple">Add Task</button>
            </form>
        </div>
    </div>
@endsection
