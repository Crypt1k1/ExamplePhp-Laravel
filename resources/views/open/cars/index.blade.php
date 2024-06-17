@extends('layouts.layoutadmins')
@section('topmenu') @endsection
@section('content')
    <h1 class="text-center text-xl md:text-4xl px-6 py-12 bg-white">Kies een Project</h1>

    <!-- Sorting Form -->
    <form action="{{ route('open.cars.index') }}" method="GET" class="mb-4">
        <label for="sort" class="mr-2">Sort by:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="newest" {{ request()->input('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="oldest" {{ request()->input('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
        </select>
    </form>

    <!-- Cars Grid -->
    <div class="w-full px-6 py-12 bg-gray-100 border-t">
        <div class="container max-w-4xl mx-auto pb-10 flex flex-wrap">
            @foreach ($cars as $car)
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3 mb-4">
                    <a href="{{ route('open.cars.show', ['car' => $car->id]) }}">
                        <img src="https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=800" class="w-full h-auto rounded-lg">
                    </a>

                    <h2 class="text-xl py-4">
                        <a href="#" class="text-black no-underline">{{ $car->name }}</a>
                    </h2>
                    <p class="text-xs leading-normal">{{ $car->description }}</p>
                    <p class="text-xs leading-normal">{{ $car->year }}</p>
                    <td><h1><a href="{{ route('open.cars.show', ['car' => $car->id]) }}">Details</a></h1></td>
                </div>
            @endforeach
        </div>

        <div class="container max-w-4xl mx-auto pb-10 flex justify-between items-center px-3">
            <div class="text-xs">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
@endsection
