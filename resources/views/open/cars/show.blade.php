@extends('layouts.layoutadmins')

@section('topmenu') @endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-3xl font-semibold text-gray-800">Car Details</h1>
                <p class="text-lg text-gray-600 mt-2">Explore information about this car.</p>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Car Name:</h2>
                        <p class="text-lg text-gray-800">{{ $car->name }}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Brand:</h2>
                        <p class="text-lg text-gray-800">{{ $car->brand }}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Year:</h2>
                        <p class="text-lg text-gray-800">{{ $car->year }}</p>
                    </div>
                    <div class="w-full md:w-1/2 px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Average Price:</h2>
                        <p class="text-lg text-gray-800">{{ $car->average_price }}</p>
                    </div>
                    <div class="w-full px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Description:</h2>
                        <p class="text-lg text-gray-800">{{ $car->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('create review')
    @endcan
@endsection
