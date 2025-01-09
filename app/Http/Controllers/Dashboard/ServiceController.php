<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\Thumbnail;
use App\Models\AdvantageUser;
use App\Models\AdvantageService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Output\ConsoleOutput;

use File;
use Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;

            // create service
            $service = Service::create($data);

            // create advantage service
            foreach ($data['advantage-service'] as $key => $value) {
                $advantage_service = new AdvantageService;
                $advantage_service->service_id = $service->id;
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }

            // create advantage user
            foreach ($data['advantage-user'] as $key => $value) {
                $advantage_user = new AdvantageUser;
                $advantage_user->service_id = $service->id;
                $advantage_user->advantage = $value;
                $advantage_user->save();
            }

            // create thumbnail
            if ($request->hasFile('thumbnail')) {
                foreach ($request->file('thumbnail') as $file) {
                    $path = $file->store(
                        'assets/service/thumbnail', 'public'
                    );

                    $thumbnail = new Thumbnail;
                    $thumbnail->service_id = $service->id;
                    $thumbnail->thumbnail = $path;
                    $thumbnail->save();
                }
            }

            // create tagline
            foreach ($data['tagline'] as $key => $value) {
                $tagline = new Tagline;
                $tagline->service_id = $service->id;
                $tagline->tagline = $value;
                $tagline->save();
            }

            toast()->success('Add service has been success');
            return redirect()->route('member.service.index');
        } catch (Throwable $th) {
            toast()->error('Add service failed');
            $console = new ConsoleOutput;
            $console->writeln($th);
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::where('id', $id)->first();
        $advantage_service = AdvantageService::where('service_id', $id)->get();
        $advantage_user = AdvantageUser::where('service_id', $id)->get();
        $thumbnail = Thumbnail::where('service_id', $id)->get();
        $tagline = Tagline::where('service_id', $id)->get();

        return view('pages.dashboard.service.detail', compact('service', 'advantage_service', 'advantage_user', 'thumbnail', 'tagline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::where('id', $id)->first();
        $advantage_service = AdvantageService::where('service_id', $id)->get();
        $advantage_user = AdvantageUser::where('service_id', $id)->get();
        $thumbnail = Thumbnail::where('service_id', $id)->get();
        $tagline = Tagline::where('service_id', $id)->get();

        return view('pages.dashboard.service.edit', compact('service', 'advantage_service', 'advantage_user', 'thumbnail', 'tagline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        try {
            $data = $request->all();
    
            // update service
            $service = Service::where('id', $id)->first();
            $service->update($data);
    
            // update advantage service
            foreach ($data['advantage-services'] as $key => $value) {
                $advantage_service = AdvantageService::find($key);
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }
    
            // add new advantage service
            if (isset($data['advantage-service'])) {
                foreach ($data['advantage-service'] as $key => $value) {
                    $advantage_service = new AdvantageService;
                    $advantage_service->service_id = $id;
                    $advantage_service->advantage = $value;
                    $advantage_service->save();
                }
            }
    
            // update advantage user
            foreach ($data['advantage-users'] as $key => $value) {
                $advantage_user = AdvantageUser::find($key);
                $advantage_user->advantage = $value;
                $advantage_user->save();
            }
    
            // add new advantage user
            if (isset($data['advantage-user'])) {
                foreach ($data['advantage-user'] as $key => $value) {
                    $advantage_user = new AdvantageUser;
                    $advantage_user->service_id = $id;
                    $advantage_user->advantage = $value;
                    $advantage_user->save();
                }
            }
    
            // update tagline
            foreach ($data['taglines'] as $key => $value) {
                $tagline = Tagline::find($key);
                $tagline->tagline = $value;
                $tagline->save();
            }
    
            // add new tagline
            if (isset($data['tagline'])) {
                foreach ($data['tagline'] as $key => $value) {
                    $tagline = new Tagline;
                    $tagline->service_id = $id;
                    $tagline->tagline = $value;
                    $tagline->save();
                }
            }
    
            // update thumbnail
            if ($request->hasFile('thumbnails')) {
                foreach ($request->file('thumbnails') as $key => $file) {
                    $get_thumbnail = Thumbnail::where('id', $key)->first();
    
                    $path = $file->store(
                        'assets/service/thumbnail', 'public'
                    );
    
                    // update thumbnail
                    $thumbnail = Thumbnail::find($key);
                    $thumbnail->thumbnail = $path;
                    $thumbnail->save();
    
                    // delete old thumbnail
                    $data = 'storage/'.$get_thumbnail->thumbnail;
                    if (File::exists($data)) {
                        File::delete($data);
                    } else {
                        File::delete('storage/app/public'.$get_thumbnail->thumbnail);
                    }
                }
            }
    
            // add new thumbnail
            if ($request->hasFile('thumbnail')) {
                foreach ($request->file('thumbnail') as $key => $file) {
                    $path = $file->store(
                        'assets/service/thumbnail', 'public'
                    );
    
                    $thumbnail = new Thumbnail;
                    $thumbnail->service_id = $id;
                    $thumbnail->thumbnail = $path;
                    $thumbnail->save();
                }
            }
    
            toast()->success('Update service has been success');
            return redirect()->route('member.service.index');
        } catch (Throwable $th) {
            toast()->error('Update service failed');
            $console = new ConsoleOutput;
            $console->writeln($th);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Service::where('id', $id)->delete();
            toast()->success('Delete service has been success');
            return redirect()->route('member.service.index');
        } catch (Throwable $th) {
            toast()->error('Delete service failed');
            $console = new ConsoleOutput;
            $console->writeln($th);
            return false;
        }
    }
}
