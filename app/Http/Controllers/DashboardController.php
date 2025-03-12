<?php
namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function user()
    {
        return view('dashboard.user', [
            'title'  => 'User Dashboard',
            'active' => 'dashboard',
        ]);
    }

    public function admin()
    {
        return view('dashboard.admin', [
            'title'  => 'Admin Dashboard',
            'active' => 'dashboard',
        ]);
    }
}
