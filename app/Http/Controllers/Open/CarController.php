<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
 public function index()
 {
     $cars = Car::paginate(8);

     return view('open.cars.index', compact('cars'));
 }

    public function show(Car $car)
    {
        return view('open.cars.show', compact('car'));
    }
}
