<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Post;
//use App\Http\Controllers\User;
use App\Models\Post;
use App\Models\User;

class StatsController extends Controller
{
    public function stats()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $usersWithZeroPosts = User::has('posts', '=', 0)->count();

        return response()->json([
            'total_users' => $totalUsers,
            'total_posts' => $totalPosts,
            'users_with_zero_posts' => $usersWithZeroPosts,
        ]);
    }
}
