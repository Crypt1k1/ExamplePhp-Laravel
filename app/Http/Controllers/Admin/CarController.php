<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;



class CarController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
     return
     [
         new Middleware(PermissionMiddleware::using('index car'), only:['index']),
         new Middleware(PermissionMiddleware::using('show car'), only:['show']),
         new Middleware(PermissionMiddleware::using('create car'), only:['create', 'store']),
         new Middleware(PermissionMiddleware::using('edit car'), only:['edit', 'update']),
         new Middleware(PermissionMiddleware::using('delete car'), only:['delete', 'destroy'])

     ];
    }
    public function index( )
    {
       $cars = Car::all();

        return view('admin.cars.index', ['cars' => $cars]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarStoreRequest $request): RedirectResponse
    {
        $car = new Car();
        $car->name = $request->name;
        $car->description = $request->description;
        $car->brand = $request->brand;
        $car->year = $request->year;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/'), $imageName);
            $car->image = $imageName;
        }
        $car->avarageprice = $request->avarageprice;
        $car->save();

        return to_route("cars.index")->with("status", "Car $car->car created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $car->name = $request->name;
        $car->description = $request->description;
        $car->brand = $request->brand;
        $car->year = $request->year;
        $car->image = $request->image;
        $car->avarageprice = $request->avarageprice;
        $car->save();
        return to_route('cars.index')->with('status', "Task $car->car Created Suck");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Car $car): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.cars.delete',  ['car' => $car]);
    }
    public function destroy(Car $car): RedirectResponse
    {
        $car->delete();
        return to_route('cars.index')->with('status', 'Car Deleted');
    }
}
