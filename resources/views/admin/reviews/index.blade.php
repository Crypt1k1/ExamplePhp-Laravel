@extends('layouts.layoutadmins')

@section('content')
    <h1>Projecten</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>text</th>
            <th>car id</th>
            <th>user id</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->text }}</td>
                <td>{{ $review->car_id }}</td>
                <td>{{ $review->user_id }}</td>
                <td><a href="{{ route('reviews.show', ['review' => $review->id]) }}">Details</a></td>
                <td>
                    <div class="flex items-center space-x-4 text-sm">
                        <a href="{{ route('reviews.edit', ['review' => $review->id]) }}">Edit</a>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">

                    </div>
                   @can('delete review')
                        <div class="flex items-center space-x-4 text-sm">
                            <a href="{{ route('reviews.delete', ['review' => $review->id]) }}">
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus: shadow-outline-gray" aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-276a1 1 0 100-2h-3.3821-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 QV8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg></button></a>
                        </div>
                    @endcan
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
