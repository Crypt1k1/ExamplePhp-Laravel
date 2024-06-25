@extends('layouts\layoutadmins')

@section('content')
    <h1 class="text-center text-xl md:text-4xl px-6 py-12 bg-white">Kies een Project</h1>
    @if(Route::has('register'))

    @endif
    <div class="w-full px-6 py-12 bg-gray-100 border-t">
        <div class="container max-w-4xl mx-auto pb-10 flex flex-wrap">

                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3 mb-4">
                    <a href="#">
                    </a>
                    <img src="https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=800" class="w-full h-auto rounded-lg">

                    <h2 class="text-xl py-4">
                        <a href="#" class="text-black no-underline"></a>
                    </h2>
                    <p class="text-xs leading-normal">
                </div>
        </div>
        </p

        <div class="container max-w-4xl mx-auto pb-10 flex justify-between items-center px-3">
            <div class="text-xs">

            </div>
        </div>
    </div>
@endsection
