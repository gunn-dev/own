<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Nexmo\Client;

class AdminHomeController extends Controller
{
    public function index()
    {
        $subscribers = Subscription::count();
        $revenue = Payment::where('status', 1)->sum('price');

        $sales = DB::table('payments')
            ->join('categories', 'payments.parent_id', '=', 'categories.id')
            ->select('categories.title', 'payments.parent_id', DB::raw('SUM(payments.price) as total_sales'))
            ->groupBy('payments.parent_id')
            ->where('payments.status', '=', 1)
            ->orderByDesc('total_sales')
            ->get();
        $names = [];
        $prices = [];

        foreach ($sales as $sale){
            array_push($names, $sale->title);
            array_push($prices, $sale->total_sales);
        }

//        dd($names);
        return view('admin.home.index')->with([
            'subsrcibers' => $subscribers,
            'revenue' => $revenue,
            'names' => $names,
            'price' => $prices
        ]);
    }

    public function search(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $subscribers = Subscription::whereBetween('created_at', [$start_date, $end_date])->count();
        $revenue = Payment::where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->sum('price');


        $sales = DB::table('payments')
            ->join('categories', 'payments.parent_id', '=', 'categories.id')
            ->select('categories.title', 'payments.parent_id',DB::raw('SUM(payments.price) as total_sales'))
            ->groupBy('payments.parent_id')
            ->where('payments.status', '=', 1)
            ->whereBetween('payments.created_at', [$start_date, $end_date])
            ->orderByDesc('total_sales')
            ->get();
        $names = [];
        $prices = [];

        foreach ($sales as $sale){
            array_push($names, $sale->title);
            array_push($prices, $sale->total_sales);
        }
        
        return view('admin.home.index')->with([
            'subsrcibers' => $subscribers,
            'revenue' => $revenue,
            'names' => $names,
            'price' => $prices
        ]);
    }

    public function getUser(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://graph.facebook.com/v2.6/' . $request->id . '?fields=first_name,middle_name,last_name,profile_pic&access_token=' . config('botman.facebook.token'));

        $response = json_decode($response->getBody());//

        $first_name = isset($response->first_name) ? $response->first_name : '';
        $middle_name = isset($response->middle_name) ? $response->middle_name : '';
        $last_name = isset($response->last_name) ? $response->last_name : '';

        $full_name = $first_name . ' ' . $middle_name . ' ' . $last_name;

        return response()->json([
           'name' => $full_name,
           'profile' => $response->profile_pic
        ]);
    }
}
