<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hash;
use Image;
use Mail;
use Storage;
use App\User;
use App\GetUsername;
use App\Miscellaneous;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    use GetUsername;
    use Miscellaneous;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = env('AVATAR_NAME').'-'.$request->id.'.jpg';

        $imagePath = public_path('assets/images/'.env('IMAGE_PATH').'/'.$imageName);
        $img = Image::make($_FILES['file']['tmp_name'])
                        ->crop(160,160)
                        ->save($imagePath);

        if ($img) {
            $user = User::find($request->id);

            $user->photo = $imageName;

            if (!$user->save()) {

                return response()->json(['data' => 'failed', 'status' => 0]);
            
            } else {

                return response()->json(['data' => 'success', 'status' => 1]);
            }
        } else {

            return response()->json(['data' => 'failed', 'status' => 2]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $image = $this->getImageProfile($id);

        $profile = User::where('id', '=', $id)
                        ->get()
                        ->toArray();

        $profile[0]['photo'] = $image;

        return response()->json($profile);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $profiles = User::find($id);

        $profiles->first_name = $request->first_name;
        $profiles->last_name = $request->last_name;

        $profiles->dob = $request->dob;
        $profiles->country_id = $request->country_id;

        $profiles->state = $request->state;
        $profiles->city = $request->city;

        if (!$profiles->save()) {
            abort(500);
            return response()->json(['data' => 'Failed', 'status' => 0]);
        } else {
           return response()->json(['data' => 'Profile Updated', 'status' => 1]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepwd(Request $request, $id)
    {
        //
        $checkPassword = Hash::check($request->current, auth()->user()->password);

        if ($checkPassword) {

            $newPassword = bcrypt($request->new1);

            $updatePassword = User::find($id);

            $updatePassword->password = $newPassword;

            if (!$updatePassword->save()) {
                return response()->json(['data' => 'Failed', 'status' => 0]);
            } else {

                // send email to user, re password changed

                $ipAddr = $this->getIpAddress();

                Mail::send('emails.password-change', ['users' => $updatePassword, 'ip' => $ipAddr], function ($msg) use ($updatePassword) {

                    $sender = env('EMAIL_SENDER');

                    $msg->from($sender, 'Bali Home Paradise');
                    $msg->to($updatePassword->email, $updatePassword->first_name)->subject('Password reset');
                
                });
                
                return response()->json(['data' => 'Password Updated', 'status' => 1]);
            }
        } else {
            return response()->json(['data' => 'Wrong current password', 'status' => 2]);
        }        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
