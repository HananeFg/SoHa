<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Factures;
use App\Models\Servers;


class HomeController extends Controller
{
    public function home() {
        return view('home');
    }
    public function login() {
        return view('login');
    }

    public function about() {
        return view('about');
    }

    public function admin()
    {
        $dailyRevenueData = [];
        $monthlyRevenueData = [];
    
        // Fetch the data for each day of the month
        $startDate = Carbon::now()->startOfMonth();
        while ($startDate->month == Carbon::now()->month) {
            $totalAmount = Factures::whereDate('created_at', $startDate)->sum('total_price');
    
            $dailyRevenueData[] = [
                'label' => $startDate->format('j M'), // Format the label as day and month
                'data' => $totalAmount,
            ];
    
            $startDate->addDay(); // Increment by 1 day for the next iteration
        }

        $totalOrders = Factures::whereDate('created_at', Carbon::today())->count();
        // Fetch the data for each month
        $startMonth = Carbon::now()->startOfYear();
        while ($startMonth->year == Carbon::now()->year) {
            $totalAmount = Factures::whereYear('created_at', $startMonth->year)
                                   ->whereMonth('created_at', $startMonth->month)
                                   ->sum('total_price');
    
            $monthlyRevenueData[] = [
                'label' => $startMonth->format('M Y'), // Format the label as month and year
                'data' => $totalAmount,
            ];
    
            $startMonth->addMonth(); // Increment by 1 month for the next iteration
        }
    
        $dailyRevenueDataJson = json_encode($dailyRevenueData);
        $monthlyRevenueDataJson = json_encode($monthlyRevenueData);
        $totalOrdersDataJson = json_encode($totalOrders);
        // dd(($totalOrders));
        return view('admin')
            
        ->with('dailyRevenueDataJson', $dailyRevenueDataJson)
        ->with('monthlyRevenueDataJson', $monthlyRevenueDataJson)
        ->with( 'totalOrders', $totalOrdersDataJson);
    }
    
    
    
    
    
    
    


    public function blog($myid, $author = 'author by default') {
        $posts = [
            1 => ['title' => 'learn laravel 6'],
            2 => ['title' => 'learn Angular 8'],
        ];
    
        return view('posts.show', [
            'data' => $posts[$myid],
            'author' => $author
        ]);
    }
}
