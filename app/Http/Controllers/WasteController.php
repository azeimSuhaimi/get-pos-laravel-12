<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\item;
use App\Models\waste;
use App\Models\activity_log;

class WasteController extends Controller
{
    public function index()
    {
        $waste = waste::withTrashed()->orderBy('created_at','desc')->get(); // get all employee 

        return view('waste.index',['waste' => $waste]);
    }//end method

    // create employee page
    public function create()
    {
        return view('waste.create');
    }//end method create

    public function store(Request $request)
    {
        // validated new items data 
        $validated = $request->validate([
            
            'quantity' => 'required|integer',
            'shortcode' => 'required',
            'reason' => 'required',
            'remark' => 'required|string',
            
        ]);

        $item = item::where('shortcode', $validated['shortcode'])->first();

        if (!$item) 
            {
                return back()->with('error',' item not exist in system '.$validated['shortcode'])->onlyInput('quantity','shortcode','remark','reason');
            }

            if($item->category == true)
            {

                    //store data update to database
                    $item = item::where('shortcode',$validated['shortcode'])->first();
                    $item->quantity = $item->quantity - $validated['quantity'];
                    $item->save();
                

            }

        //store data to database 
        $waste = new waste;
        $waste->item = $item->item;
        $waste->shortcode = $item->shortcode;
        $waste->description = $item->description;
        $waste->quantity = $validated['quantity'];
        $waste->cost = $item->cost;
        $waste->price = $item->price;
        $waste->category = $item->category;
        $waste->reason = $validated['reason'];
        $waste->remark = $validated['remark'];

        $waste->save();

        activity_log::addActivity('Add New Item waste',' add new item waste '.$item->name.'into system');

        return back()->with('success','add new item waste '.$item->name);
        
    }//end method

    public function view(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        
        $waste = waste::withTrashed()->find($request->input('id'))->first();// id waste input

        return view('waste.view',['waste'=>$waste]);
    }//end method view
}//end class
