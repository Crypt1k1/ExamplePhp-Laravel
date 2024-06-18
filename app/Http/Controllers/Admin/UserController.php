<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Car;
use App\Models\User;
use Couchbase\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return
            [
                new Middleware(PermissionMiddleware::using('index user'), only: ['index']),
                new Middleware(PermissionMiddleware::using('show user'), only: ['show']),
                new Middleware(PermissionMiddleware::using('create user'), only: ['create', 'store']),
                new Middleware(PermissionMiddleware::using('edit user'), only: ['edit', 'update']),
                new Middleware(PermissionMiddleware::using('delete user'), only: ['delete', 'destroy'])

            ];
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::with('roles', 'cars')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->has('car_id')) {
            $user->cars()->attach($request->car_id);
        }

        return redirect()->route('users.index')->with('status', 'User created successfully',);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {

        $favoriteCars = $user->cars()->get();
        $allCars = Car::all();
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles', 'favoriteCars', 'allCars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Sync user roles
        $user->roles()->sync($request->roles);

        $user->save();

        return redirect()->route('users.index')->with('status', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('admin.users.delete', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User deleted successfully');
    }

    public function favourite(Car $car): RedirectResponse
    {
        $user = Auth::user();
        if (!$user->cars()->where('car_id', $car->id)->exists()) {
            $user->cars()->attach($car->id);
        }
        return redirect()->back()->with('status', 'Car added to favorites successfully.');

    }

    public function deleteFavourite(Car $car): RedirectResponse
    {
        $user = Auth::user();
        $user->cars()->detach($car->id);
        return redirect()->back()->with('status', 'Favorite car removed successfully.');
    }

    public function showFavourites(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Load the user's favorite cars
        $favoriteCars = $user->cars;

        // Return the view with the user's favorite cars
        return view('open.cars.showfavoruites', compact('favoriteCars'));


    }
}
