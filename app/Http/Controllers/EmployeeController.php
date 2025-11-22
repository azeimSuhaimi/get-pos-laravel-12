<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Registered;

use App\Models\user;
use App\Models\employee;
use App\Models\activity_log;
class EmployeeController extends Controller
{
    // list all employee 
    public function index()
    {
        $employee = employee::withTrashed()->get(); // get all employee 

        return view('employee.index',['employee' => $employee]);
    }//end method all employee

    // create employee page
    public function create()
    {
        return view('employee.create');
    }//end method create

    public function store(Request $request)
    {
                // validated new employee data 
        $validated = $request->validate([
            
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'phone' => 'numeric|required|unique:users,phone',
            'work_id' => 'required|unique:employees,work_id',
            'birthday' => 'required',
            'gender' => 'required|string',
            'ic' => 'required|numeric|unique:employees,ic',
            'address' => 'required',
            'address2' => 'required',
            'position' => 'required',
            
        ]);
        
        $user = user::addUser($validated['name'],$validated['email'],$validated['phone']);

        $employee = employee::addEmployee($validated,$user->id);

        // Manually fire the Registered event
        event(new Registered($user));

        activity_log::addActivity('Add New Employee',' add new employee '.$validated['name'].' into system');

        return back()->with('success','add new employee '.$validated['name']);

    }//end method store

    public function view(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        $user = user::withTrashed()->find($request->input('id'));
        $employee = employee::withTrashed()->where('user_id',$request->input('id'))->first();// id employee input

        return view('employee.view',['employee'=>$employee,'user'=>$user]);
    }//end method view

    
    public function removeImage(Request $request)
    {
        
        $validated = $request->validate([
            'id' => 'required',
        ]); 

        $user = user::find($validated['id']);// find table  based id


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

                activity_log::addActivity(' remove image profile employee '.$user->name.' to empty');

            return redirect(route('employee.view').'?id='.$validated['id'])->with('success','success remove image');
            

    }//end method remove image

    public function updateProfile(Request $request)
    {
        $user_id = $request->input('id');
        $employee_id = $request->input('employee_id');

        $rules = [
            'id' => 'required',
            'employee_id' => 'required',
            'name' => 'required|string',
            'email' => ['required','email',Rule::unique('users','email')->ignore( $user_id)],
            'phone' => ['required','numeric',Rule::unique('users','phone')->ignore( $user_id)],
            'work_id' => ['required',Rule::unique('employees','work_id')->ignore( $employee_id)],
            'birthday' => 'required',
            'gender' => 'required|string',
            'ic' => ['required','numeric',Rule::unique('employees','ic')->ignore( $employee_id)],
            'address' => 'required',
            'address2' => 'required',
            'position' => 'required',
        ];

        if($request->hasFile('file')) 
        {
            $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        
    
        $validated = $request->validate($rules);

        $user = user::find($user_id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];

        $employee = employee::where('user_id',$user_id)->first();
        $employee->gender = $validated['gender'];
        $employee->birthday = $validated['birthday'];
        $employee->ic = $validated['ic'];
        $employee->work_id = $validated['work_id'];
        $employee->address = $validated['address'];
        $employee->address2 = $validated['address2'];
        $employee->position = $validated['position'];



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
        $employee->save();
        activity_log::addActivity( 'Changed profile details to ' . $validated['name']);

        // --- 7. Redirect with Success Message ---
        return redirect(route('employee.view').'?id='.$validated['id'])->with('success', 'Profile updated successfully!');

    }//end method update profile

    public function status(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'employee_id' => 'required',
        ]);

        $employee = employee::withTrashed()->find($request->input('employee_id'));

        $user = user::withTrashed()->find($request->input('id'));

        if($employee->status == true  )
        {
            $employee->status = false;
            $employee->save();
            $employee->delete();

            $user->status = false;
            $user->save();
            $user->delete();
            
            activity_log::addActivity('change status',' change status employee to resign');
            return redirect(route('employee.view').'?id='.$request->input('id'))->with('success','employee is resign');
        }
        else
        {
            $employee->status = true;
            $employee->save();
            $employee->restore();

            $user->status = true;
            $user->save();
            $user->restore();

            activity_log::addActivity('change status',' change status employee to active back');
            return redirect(route('employee.view').'?id='.$request->input('id'))->with('success','employee is active back');
        }

        return back();
    }//end method

}//end class
