<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;

use App\Models\activity_log;
use App\Models\user;
use App\Models\company;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }// end method

    public function activityLog()
    {
        $activity = activity_log::myActivity();
        return view('user.activity-log',['activity' => $activity]);
    }// end method

    public function changePassword()
    {
        return view('user.change-password');
    }//end method change password

    public function changePasswordUpdate(Request $request)
    {
        $validated = $request->validate([
            'password' => 'nullable',
            'password1' => 'required|min:4',
            'password2' => 'required|min:4|same:password1',
        ]);

        if (! Hash::check($validated['password'], $request->user()->password)) {

            return back()->with('error','current password not match')->onlyInput('password1','password2','password');
        }

        $pass = Hash::make($validated['password1']);

        $users = user::find(auth()->user()->id);
        $users->password = $pass;
        $users->save();

        $request->session()->passwordConfirmed();

        activity_log::addActivity(' change it password to new');

        return back()->with('success','current password is update now');
        
    }//end method change password update

    public function removeImage(Request $request)
    {
        /* validated input
        $validated = $request->validate([
            'id' => 'required',
        ]); */

        $user = user::find(auth()->user()->id);// find table  based id


            if($user->picture != 'empty.png')
            {
                
                $filePath = public_path('image/profile/'.$user->picture); // store file to location

                // delete fine from past
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
            
            // store image name to database
                $user->picture = 'empty.png';
                $user->save();

                activity_log::addActivity(' remove image profile to empty');

            return redirect(route('user.profile'))->with('success','success remove image');
            

    }//end method remove image

    public function updateProfile(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ];

        if($request->hasFile('file')) 
        {
            $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        
    
        $validated = $request->validate($rules);

        $user = user::find(auth()->user()->id);
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];


        if($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename
            $destinationPath = public_path('image/profile/');

            $file->move($destinationPath, $fileName);

            // Delete the old file if it's not the default 'empty.png'
            if ($user->picture && $user->picture != 'empty.png') 
                {
                $filePath = $destinationPath . $user->picture;

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }//check image by default or not

            // Update the user's picture field with the new file name
            $user->picture = $fileName;

        }//check file 

        $user->save();
        activity_log::addActivity( 'Changed profile details to ' . $validated['email']);

        // --- 7. Redirect with Success Message ---
        return redirect(route('user.profile'))->with('success', 'Profile updated successfully!');

    }//end method update profile

    public function companyDetail()
    {
        $company = company::find(1);
        return view('user.company-detail',['company' => $company]);
    }//end method change password
    
    public function removeImageCompany(Request $request)
    {
        // validated input
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $company = company::find($validated['id']);// find table  based id

            if($company->logo != 'logo.jpg')
            {
                
                $filePath = public_path('image/company/'.$company->logo); // store file to location

                // delete fine from past
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
            
            // store image name to database
                $company->logo = 'logo.jpg';
                $company->save();

                activity_log::addActivity(' remove image profile company to empty');

            return redirect(route('user.comapany.detail'))->with('success','success remove image');
            

    }//end method remove image company

    public function updateProfileCompany(Request $request)
    {
        $rules = [
                'id' => 'required',
                'company_name' => 'required|string',
                'shop_name' => 'required|string',
                'company_id' => 'required|string',
                'address' => 'required|string',
                'poscode' => 'required|numeric',
                'city' => 'required|string',
                'state' => 'required|string',
                'country' => 'required|string',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'description' => 'required|string',
        ];

        if ($request->hasFile('file')) {
            $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validated = $request->validate($rules);

        $company = company::find($validated['id']);

            $company->company_name = $validated['company_name'];
            $company->shop_name = $validated['shop_name'];
            $company->company_id = $validated['company_id'];
            $company->address = $validated['address'];
            $company->poscode = $validated['poscode'];
            $company->city = $validated['city'];
            $company->state = $validated['state'];
            $company->country = $validated['country'];
            $company->description = $validated['description'];
            $company->phone = $validated['phone'];
            $company->email = $validated['email'];
            


        if ($request->hasFile('file')) 
            {
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename
                $destinationPath = public_path('image/company/');

                $file->move($destinationPath, $fileName);

                // Delete the old file if it's not the default 'empty.png'
                if ($company->logo && $company->logo != 'logo.jpg') 
                    {
                    $filePath = $destinationPath . $company->logo;

                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }
                    }//check image by default or not

                // Update the user's picture field with the new file name
                $company->logo = $fileName;

            }//check file 

        $company->save();
        activity_log::addActivity( 'Changed profile comapny details to ' . $validated['shop_name']);

        // --- 7. Redirect with Success Message ---
        return redirect(route('user.comapany.detail'))->with('success', 'change it details company '.$validated['company_name']);

    }//end method update profile comapny

}//end class
