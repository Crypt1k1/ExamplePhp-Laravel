<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\Request;

class CarController extends Controller
{
 public function index(Request $request)
 {
     $query = Car::query();

     // Handle sorting
     if ($request->input('sort') == 'newest') {
         $query->orderBy('year', 'desc');
     } elseif ($request->input('sort') == 'oldest') {
         $query->orderBy('year', 'asc');
     }

     $cars = $query->paginate(8);

     return view('open.cars.index', compact('cars'));
 }

    public function show(Car $car)
    {
        $carWithReviews = Car::with('review')->find($car->id);

        // Check if there are reviews associated with the car
        $reviews = $carWithReviews->review ?? [];
        return view('open.cars.show', compact('car' , 'carWithReviews', 'reviews'));
    }
}
