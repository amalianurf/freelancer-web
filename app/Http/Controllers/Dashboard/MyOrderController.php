<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\Thumbnail;
use App\Models\StatusOrder;
use App\Models\AdvantageUser;
use App\Models\AdvantageService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Order\UpdateOrderRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Output\ConsoleOutput;

use File;
use Auth;

class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('freelancer_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.dashboard.order.index', compact('orders'));
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
        $order = Order::where('id', $id)->first();

        return view('pages.dashboard.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        try {
            $data = $request->all();

            $get_file = Order::where('id', $id)->first();

            if (isset($data['file'])) {
                // delete old file
                $file = 'storage/'.$get_file->file;
                if (File::exists($file)) {
                    File::delete($file);
                } else {
                    File::delete('storage/app/public/'.$get_file->file);
                }
                
                // store new file
                $data['file'] = $request->file('file')->store(
                    'assets/order/attachment', 'public'
                );
            }

            $order = Order::where('id', $id)->first();
            $order->file = $data['file'];
            $order->note = $data['note'];
            $order->save();

            toast()->success('Update order has been success');
            return back();
        } catch (Throwable $th) {
            toast()->error('Update order failed');
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }

    public function accepted($id)
    {
        try {
            $order = Order::where('id', $id)->first();
            $order->status_order_id = 3;
            $order->save();

            toast()->success('Accept order has been success');
            return redirect()->route('member.order.index');
        } catch (Throwable $th) {
            toast()->error('Accept order failed');
            return false;
        }
    }

    public function rejected($id)
    {
        try {
            $order = Order::where('id', $id)->first();
            $order->status_order_id = 4;
            $order->save();

            toast()->success('Reject order has been success');
            return redirect()->route('member.order.index');
        } catch (Throwable $th) {
            toast()->error('Reject order failed');
            return false;
        }
    }
}
