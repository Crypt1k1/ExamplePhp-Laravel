@extends('layouts\layoutadmins')

@section('topmenu') @endsection

@section('content')
    <div class="card md-6">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Car Admin</h1>
        </div>
    </div>

    <div class="py-4 px-6">
        <h2 class="text-lg front-semibold text-gray-400" >Car Details</h2>
        <p class="py-2 text-lg text-gray-700">id:{{ $car->id }}</p>
        <p class="py-2 text-lg text-gray-700">Name:{{ $car->name }}</p>
        <p class="py-2 text-lg text-gray-700">description:{{ $car->description }}</p>
        <p class="py-2 text-lg text-gray-700">brand:{{ $car->brand }}</p>
        <p class="py-2 text-lg text-gray-700">year:{{ $car->year}}</p>
        <p class="py-2 text-lg text-gray-700">image:{{ $car->image}}</p>
        <p class="py-2 text-lg text-gray-700">Avg. Price:{{ $car->avarageprice}}</p>

    </div>
@endsection
