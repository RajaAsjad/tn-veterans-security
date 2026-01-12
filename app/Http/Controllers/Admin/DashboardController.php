<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $servicesCount = Service::count();
        $activeServicesCount = Service::where('is_active', true)->count();
        
        return view('admin.dashboard', compact('servicesCount', 'activeServicesCount'));
    }
}
