<?php

namespace App\Http\Controllers\Landing;

use App\Models\Order;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\Thumbnail;
use App\Models\AdvantageUser;
use App\Models\AdvantageService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\Console\Output\ConsoleOutput;

use Auth;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get() ?? NULL;

        return view('pages.landing.index', compact('services'));
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

    public function explore()
    {
        $services = Service::orderBy('created_at', 'desc')->get() ?? NULL;

        return view('pages.landing.explore', compact('services'));
    }

    public function detail($id)
    {
        $service = Service::where('id', $id)->first();

        $advantage_service = AdvantageService::where('service_id', $id)->get();
        $advantage_user = AdvantageUser::where('service_id', $id)->get();
        $thumbnail = Thumbnail::where('service_id', $id)->get();
        $tagline = Tagline::where('service_id', $id)->get();

        return view('pages.landing.detail', compact('service', 'advantage_service', 'advantage_user', 'thumbnail', 'tagline'));
    }

    public function booking($id)
    {
        if (Auth::guest()) {
            toast()->warning('Sorry, you need to login first!');
            return back();
        }

        try {
            $service = Service::where('id', $id)->first();
            $client_id = Auth::user()->id;
    
            if ($service->user_id == $client_id) {
                toast()->warning('Sorry, members cannot book their own service!');
                return back();
            }
    
            $order = new Order;
            $order->client_id = $client_id;
            $order->freelancer_id = $service->user_id;
            $order->service_id = $id;
            $order->file = NULL;
            $order->note = NULL;
            $order->expired = Date('Y-m-d', strtotime('+3 days'));
            $order->status_order_id = 2;
            $order->save();
    
            toast()->success('Booking has been success');
            return redirect()->route('landing.detail.booking', $order->id);
        } catch (Throwable $th) {
            toast()->error('Booking failed');
            $console = new ConsoleOutput;
            $console->writeln($th);
            return back();
        }
    }

    public function detail_booking($id)
    {
        $order = Order::where('id', $id)->first();

        return view('pages.landing.booking', compact('order'));
    }
}
