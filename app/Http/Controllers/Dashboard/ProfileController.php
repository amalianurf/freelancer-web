<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\DetailUser;
use App\Models\ExperienceUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use App\Http\Requests\Dashboard\Profile\UpdateDetailUserRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Output\ConsoleOutput;

use File;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $experience_user = ExperienceUser::where('detail_user_id', $user->detail_user->id)
                                        ->orderBy('id', 'asc')
                                        ->get();

        return view('pages.dashboard.profile', compact('user', 'experience_user'));
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
    public function update(UpdateProfileRequest $request_profile, UpdateDetailUserRequest $request_detail_user)
    {
        try {
            $data_profile = $request_profile->all();
            $data_detail_user = $request_detail_user->all();
    
            // get photo
            $get_photo = DetailUser::where('user_id', Auth::user()->id)->first();
            
            if (isset($data_detail_user['photo'])) {
                // delete old file
                $data = 'storage/'.$get_photo->photo;
                if (File::exists($data)) {
                    File::delete($data);
                } else {
                    File::delete('storage/app/public/'.$get_photo->photo);
                }
                
                // store new file
                $data_detail_user['photo'] = $request_detail_user->file('photo')->store('assets/photo', 'public');
            }
    
            // // save updated data
            $user = User::find(Auth::user()->id);
            $user->update($data_profile);
    
            $detail_user = DetailUser::find($user->detail_user->id);
            $detail_user->update($data_detail_user);
    
            // save experience data
            if (isset($data_profile['experience'])) {
                $experience_user_id = ExperienceUser::where('detail_user_id', $detail_user->id)->first();
                if (isset($experience_user_id)) {
                    foreach ($data_profile['experience'] as $key => $value) {
                        $experience_user = ExperienceUser::find($key);
                        $experience_user->detail_user_id = $detail_user->id;
                        $experience_user->experience = $value;
                        $experience_user->save();
                    }
                } else {
                    foreach ($data_profile['experience'] as $key => $value) {
                        $experience_user = new ExperienceUser;
                        $experience_user->detail_user_id = $detail_user->id;
                        $experience_user->experience = $value;
                        $experience_user->save();
                    }
                }
            }
    
            toast()->success('Update has been success');
            return back();
        } catch (Throwable $th) {
            toast()->error('Update failed');
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
        return abort(404);
    }

    public function delete()
    {
        try {
            $get_user_photo = DetailUser::where('user_id', Auth::user()->id)->first();
            $path_photo = $get_user_photo->photo;
    
            // update value to null
            $data = DetailUser::find($get_user_photo->id);
            $data->photo = NULL;
            $data->save();
    
            // delete file
            $data = 'storage/'.$path_photo;
            if (File::exists($data)) {
                File::delete($data);
            } else {
                File::delete('storage/app/public/'.$path_photo);
            }
    
            toast()->success('Delete has been success');
            return back();
        } catch (Throwable $th) {
            toast()->error('Delete failed');
            $console = new ConsoleOutput;
            $console->writeln($th);
            return false;
        }
    }
}
