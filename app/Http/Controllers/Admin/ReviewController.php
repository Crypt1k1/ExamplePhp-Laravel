<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewStoreRequest;
use App\Models\Car;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ReviewController extends Controller
{

    public static function middleware(): array
    {
        return
            [
                new Middleware(PermissionMiddleware::using('index review'), only:['index']),
                new Middleware(PermissionMiddleware::using('show review'), only:['show']),
                new Middleware(PermissionMiddleware::using('create review'), only:['create', 'store']),
                new Middleware(PermissionMiddleware::using('edit review'), only:['edit', 'update']),
                new Middleware(PermissionMiddleware::using('delete review'), only:['delete', 'destroy'])

            ];
    }


    public function store(ReviewStoreRequest $request):RedirectResponse
    {
        $review = new Review();
        $review->text = $request->text;
        $review->user_id = auth()->id(); // Assuming the user is authenticated
        $review->car_id = $request->car_id;

        // Save the review
        $review->save();

        // Redirect back with success message or do whatever you prefer
        return redirect()->back()->with('success', 'Review posted successfully!');
    }

    public function show(Review $reviews)
    {
        $user = User::find($reviews->user_id);
        $car = Car::find($reviews->car_id);
        return view('admin.review.show', compact('user', 'car', 'reviews'));
    }

    public function destroy(Review $review)
    {
        // Check if the authenticated user has the 'admin' or 'moderator' role
        if (auth()->user()->hasRole(['admin', 'moderator'])) {
            // Delete the review
            $review->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Review deleted successfully.');
        }

        // If the user doesn't have the necessary role, redirect back with an error message
        return redirect()->back()->with('error', 'You are not authorized to delete this review.');
    }
}
