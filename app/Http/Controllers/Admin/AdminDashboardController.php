<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Trade;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Users
        $totalUsers = User::count();
        $newUsersThisWeek = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $newUsersLastWeek = User::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->count();
        $percentageChange = $this->calculatePercentage($newUsersThisWeek, $newUsersLastWeek);

        // Campus Users
        $totalCampusUser = $this->getRoleCount('campus_user');
        $newCampusUsersThisWeek = $this->getNewUsersByRole('campus_user', 7);
        $newCampusUsersLastWeek = $this->getNewUsersByRole('campus_user', 14, 7);
        $percentageChangeInCampusUsers = $this->calculatePercentage($newCampusUsersThisWeek, $newCampusUsersLastWeek);

        // Products
        $totalProducts = Product::count();
        $newProductsThisWeek = Product::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $newProductsLastWeek = Product::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7),
        ])->count();
        $productPercentage = $this->calculatePercentage($newProductsThisWeek, $newProductsLastWeek);

        // Services
        $totalServices = Service::count();
        $newServicesThisWeek = Service::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $newServicesLastWeek = Service::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7),
        ])->count();
        $servicePercentage = $this->calculatePercentage($newServicesThisWeek, $newServicesLastWeek);

        // Posts
        $totalPosts = Post::count();
        $newPostsThisWeek = Post::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $newPostsLastWeek = Post::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7),
        ])->count();
        $postPercentage = $this->calculatePercentage($newPostsThisWeek, $newPostsLastWeek);

        $totalTrades = Trade::count();
        $newTradesThisWeek = Trade::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $newTradesLastWeek = Trade::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7),
        ])->count();
        $tradePercentage = $this->calculatePercentage($newTradesThisWeek, $newTradesLastWeek);

        return Inertia::render('Admin/Dashboard', [
            'totalUsers' => $totalUsers,
            'totalCampusUser' => $totalCampusUser,
            'totalProducts' => $totalProducts,
            'totalServices' => $totalServices,
            'totalPosts' => $totalPosts,
            'totalTrades' => $totalTrades,
            'newUsersThisWeek' => $newUsersThisWeek,
            'newPostsThisWeek' => $newPostsThisWeek,
            'newServicesThisWeek' => $newServicesThisWeek,
            'newProductsThisWeek' => $newProductsThisWeek,
            'newTradesThisWeek' => $newTradesThisWeek,
            'newCampusUsersThisWeek' => $newCampusUsersThisWeek,
            'percentageChange' => $percentageChange,
            'postPercentage' => $postPercentage,
            'productPercentage' => $productPercentage,
            'servicePercentage' => $servicePercentage,
            'tradePercentage' => $tradePercentage,
            'percentageChangeInCampusUsers' => $percentageChangeInCampusUsers,
        ]);
    }

    private function calculatePercentage($current, $previous)
    {
        if ($previous === 0) {
            return $current === 0 ? 0 : 100;
        }

        return round((($current - $previous) / $previous) * 100, 2);
    }

    private function getRoleCount($role)
    {
        return User::whereHas('role', fn($query) => $query->where('name', $role))->count();
    }

    private function getNewUsersByRole($role, $days, $offset = 0)
    {
        $start = Carbon::now()->subDays($days + $offset);
        $end = Carbon::now()->subDays($offset);
        return User::whereBetween('created_at', [$start, $end])
            ->whereHas('role', fn($query) => $query->where('name', $role))
            ->count();
    }
}
