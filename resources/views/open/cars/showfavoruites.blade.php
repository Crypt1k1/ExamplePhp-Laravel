@extends('layouts.layoutadmins')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-3xl font-semibold text-gray-800">Your Favorite Cars</h1>
                <p class="text-lg text-gray-600 mt-2">Here are your favorite cars:</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                @if ($favoriteCars->isEmpty())
                    <p class="text-gray-600">You haven't added any cars to your favorites yet.</p>
                @else
                    <ul>
                        @foreach ($favoriteCars as $car)
                            <li>{{ $car->name }} ({{ $car->brand }}, {{ $car->year }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
