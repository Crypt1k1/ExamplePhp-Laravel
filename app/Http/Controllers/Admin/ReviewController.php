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
                new Middleware(PermissionMiddleware::using('delete review'), only:['delete', 'destroy']),
                new Middleware(PermissionMiddleware::using('storeAdmin review'), only:['storeAdmin'])

            ];
    }
    public function index()
    {
       $reviews = Review::all();
        return view('admin.reviews.index' , compact('reviews'));
    }

    public function edit(Review $review)
    {

        $users = User::all();
        $cars = Car::all();
        return view('admin.reviews.edit',  ['cars' => $cars, 'users' =>$users,'review'=> $review]);
    }
    public function update(ReviewStoreRequest $request, Review $review)
    {

        $review->text = $request->text;
        $review->car_id = $request->car_id;
        $review->user_id = $request->user_id;

        $review->save();
        return to_route('reviews.index')->with('status', "Task $review->$review Created Suck");
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
        return redirect()->route('open.cars.show', $review->car_id)->with('status', 'Review posted successfully');
    }

    public function show(Review $review)
    {
        $user = User::find($review->user_id);
        $car = Car::find($review->car_id);
        return view('admin.reviews.show', compact('user', 'car', 'review'));
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
    public function delete(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('status', 'User deleted successfully');
    }

    public function storeAdmin(ReviewStoreRequest $request):RedirectResponse
    {
        $review = new Review();
        $review->text = $request->text;
        $review->user_id = $request->user_id; // Assuming the user is authenticated
        $review->car_id = $request->car_id;

        // Save the review
        $review->save();

        // Redirect back with success message or do whatever you prefer
        return redirect()->route('admin.reviews.index',)->with('status', 'Review posted successfully');
    }

}
