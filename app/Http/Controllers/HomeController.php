<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Factures;
use App\Models\Servers;
use App\Models\Category;
use App\Models\Details;
use App\Models\Menu;






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
    $startDate = Carbon::now()->subDays(30)->startOfDay(); // Start from 30 days ago
    $endDate = Carbon::now()->endOfDay(); // End at today
    while ($startDate <= $endDate) {
        $totalAmount = Factures::whereDate('created_at', $startDate)->sum('total_price');

        $dailyRevenueData[] = [
            'label' => $startDate->format('j M'), // Format the label as day and month
            'data' => $totalAmount,
        ];

        $startDate->addDay(); // Increment by 1 day for the next iteration
    }

    $totalOrders = Factures::whereDate('created_at', Carbon::today())->count();
    $totalPrice = Factures::whereDate('created_at', Carbon::today())->sum('total_price');

    // Calculate the average total price
    $averagePrice = Factures::whereDate('created_at', Carbon::today())->avg('total_price');

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

     // Fetch the revenue per category
     $categories = Category::all();
     $categoryRevenueData = [];
     
     // Calculate the start and end dates for the last 30 days
     $startDate = Carbon::now()->subDays(30)->startOfDay();
     $endDate = Carbon::now()->endOfDay();
     
     foreach ($categories as $category) {
         $categoryTotalAmount = Factures::join('details', 'factures.id', '=', 'details.facture_id')
             ->join('menus', 'details.produit_id', '=', 'menus.id')
             ->where('menus.category_id', $category->id)
             ->whereBetween('factures.created_at', [$startDate, $endDate])
             ->sum('details.montant');
     
         $categoryRevenueData[] = [
             'label' => $category->title,
             'data' => $categoryTotalAmount,
         ];
     }
     

    
     
     // Fetch the top 5 menus based on total revenue returned
     $topRevenueMenus = Menu::join('details', 'menus.id', '=', 'details.produit_id')
         ->select('menus.title', DB::raw('SUM(details.montant) as total_revenue'))
         ->groupBy('menus.id', 'menus.title')
         ->orderBy('total_revenue', 'desc')
         ->take(5)
         ->get();
     
    

    $dailyRevenueDataJson = json_encode($dailyRevenueData);
    $monthlyRevenueDataJson = json_encode($monthlyRevenueData);
    $categoryRevenueDataJson = json_encode($categoryRevenueData);
    $totalOrdersDataJson = json_encode($totalOrders);
    $totalPriceDataJson = json_encode($totalPrice);
    $topRevenueMenusDataJson = json_encode($topRevenueMenus);
    $averagePriceFormatted = number_format($averagePrice, 2); // Format the average price with 2 decimal places

    return view('admin')
        ->with('dailyRevenueDataJson', $dailyRevenueDataJson)
        ->with('monthlyRevenueDataJson', $monthlyRevenueDataJson)
        ->with('categoryRevenueDataJson', $categoryRevenueDataJson)
        ->with('totalOrders', $totalOrdersDataJson)
        ->with('totalPrice', $totalPriceDataJson)
        ->with('topRevenueMenus', $topRevenueMenusDataJson)
        ->with('averagePrice', $averagePriceFormatted);

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
