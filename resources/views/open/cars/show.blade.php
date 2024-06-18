@extends('layouts.layoutadmins')

@section('topmenu') @endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-3xl font-semibold text-gray-800">Car Details</h1>
                <p class="text-lg text-gray-600 mt-2">Explore information about this car.</p>
            </div>
            <div class="container mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-semibold">{{ $car->name }}</h1>
                    @if(auth()->check())
                        @if(auth()->user()->cars->contains($car->id))
                            <form id="deleteFavourite" action="{{ route('user.deleteFavourite', ['car' => $car->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white rounded-md px-4 py-2">Remove from Favorites</button>
                            </form>
                        @else
                            <form id="favoriteForm" action="{{ route('user.favourite', ['car' => $car->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2">Add to Favorites</button>
                            </form>
                        @endif
                    @endif
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
                    <div class="w-full px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Car Image:</h2>
                        <img src="images/images.jpg" alt="Image of {{ $car->name }}" class="w-full h-auto rounded-lg">
                    </div>
                    <div class="w-full md:w-1/2 px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Average Price:</h2>
                        <p class="text-lg text-gray-800">{{ $car->avarageprice }}</p>
                    </div>
                    <div class="w-full px-4 mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Description:</h2>
                        <p class="text-lg text-gray-800">{{ $car->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800">Reviews</h2>
            <!-- Display Reviews -->
            <div class="mt-4">
                <!-- Loop through reviews and display each one -->
                @if ($reviews->count() > 0)
                    @foreach ($reviews as $review)
                        <div class="bg-white shadow-md rounded-md p-4 mt-4">
                            <p class="text-lg text-gray-800">{{ $review->text }}</p>
                            <p class="text-sm text-gray-600 mt-2">Posted by {{ $review->user->name }}</p>

                            <!-- Check if the user is authorized to delete the review -->
                            @if (auth()->check() && (auth()->user()->hasRole(['admin', 'moderator']) || $review->user_id === auth()->id()))
                                <form action="{{ route('reviews.destroy', ['review' => $review->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600">Delete Review</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>No reviews available for this car.</p>
                @endif
            </div>

            @can('create review')
                @if (auth()->check())
                    <div class="mt-4">
                        <form action="{{ route('reviews.store', ['car' => $car->id]) }}" method="POST">
                            @csrf
                            <textarea name="text" class="w-full border rounded-md p-2" placeholder="Write your review here..." required></textarea>
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2 mt-2">Post Review</button>
                        </form>
                    </div>
                @else
                    <p class="mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to post a review.</p>
    @endif
    @endcan
        @endsection
