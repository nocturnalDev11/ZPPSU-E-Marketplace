<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Models\Trade\Trade;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = User::where('role_id', '1')->count();
        $totalFaculties = User::where('role_id', '2')->count();
        $totalStaff = User::where('role_id', '3')->count();
        $totalProducts = Product::count();
        $totalServices = Service::count();
        $totalTrades = Trade::count();
        $totalPosts = Post::count();
        $users = User::all();

        return Inertia::render('Admin/Dashboard', [
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
            'totalFaculties' => $totalFaculties,
            'totalStaff' => $totalStaff,
            'totalProducts' => $totalProducts,
            'totalServices' => $totalServices,
            'totalTrades' => $totalTrades,
            'totalPosts' => $totalPosts,
            'users' => $users
        ]);
    }


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
