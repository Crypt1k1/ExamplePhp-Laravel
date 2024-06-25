@extends('layouts\layoutadmins')

@section('topmenu') @endsection

@section('content')
    <div class="card md-6">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Project Admin</h1>
        </div>
    </div>



    <div class="py-4 px-6">
        <h2 class="text-lg front-semibold text-gray-400">Task Details</h2>
        <p class="py-2 text-lg text-gray-700">ID: {{ $review->id }}</p>
        <p class="py-2 text-lg text-gray-700">text: {{ $review->text }}</p>


        <p class="py-2 text-lg text-gray-700">car: {{ $car ? $car->name : 'N/A' }}</p>
        <p class="py-2 text-lg text-gray-700">user: {{ $user ? $user->name : 'N/A' }}</p>


    </div>

    </div>
@endsection
