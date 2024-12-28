<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Models\User;
use Inertia\Inertia;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
=======
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $totalUsers = User::count();
        $totalStudents = User::where('role_id', '1')->count();
        $totalFaculties = User::where('role_id', '2')->count();
        $totalStaff = User::where('role_id', '3')->count(); // Corrected here
        $totalProducts = Product::count();
        $totalPosts = Post::count();
        $users = User::all();

        return Inertia::render('Admin/Dashboard', [
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
            'totalFaculties' => $totalFaculties,
            'totalStaff' => $totalStaff,
            'totalProducts' => $totalProducts,
            'totalPosts' => $totalPosts,
            'users' => $users
        ]);
    }


=======
        return Inertia::render('Admin/Dashboard');
    }

>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
