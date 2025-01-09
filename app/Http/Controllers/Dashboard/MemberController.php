<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\DetailUser;
use App\Models\StatusOrder;
use App\Models\ExperienceUser;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Output\ConsoleOutput;

use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('freelancer_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $progress = Order::where('freelancer_id', Auth::user()->id)
                        ->where('status_order_id', 3)
                        ->count();
        $completed = Order::where('freelancer_id', Auth::user()->id)
                        ->where('status_order_id', 1)
                        ->count();
        $freelancer = Order::where('client_id', Auth::user()->id)
                        ->where('status_order_id', 3)
                        ->distinct('freelancer_id')
                        ->count();

        return view('pages.dashboard.index', compact('orders', 'progress', 'completed', 'freelancer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }
}
