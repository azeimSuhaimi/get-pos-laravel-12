<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use App\Models\activity_log;
use App\Models\item;

class ItemController extends Controller
{
    //get all list item product
    public function index()
    {
        $items = item::withTrashed()->orderBy('created_at','desc')->get();

        return view('item.index',['items' => $items]);
    }//end method

    // create item page
    public function create()
    {
        return view('item.create');
    }//end method create

    // store new Item data
    public function store(Request $request)
    {

        // validated new items data 
        $validated = $request->validate([
            
            'item' => 'required|unique:items,item',
            'barcode' => 'numeric|required|unique:items,barcode',
            'shortcode' => 'required|unique:items,shortcode',
            'cost' => 'required|numeric',
            'price' => 'required|numeric|gte:cost',
            'description' => 'required|string',
            'category' => 'required',
            
        ]);

        
        //store data to database 
        $item = new item;
        $item->item = $validated['item'];
        $item->barcode = $validated['barcode'];
        $item->shortcode = $validated['shortcode'];
        $item->cost = $validated['cost'];
        $item->price = $validated['price'];
        $item->description = $validated['description'];
        $item->category = $validated['category'];
        $item->save();

        activity_log::addActivity(' add new item '.$validated['item'].'into system');

        return back()->with('success','add new item, success make new items '.$validated['item']);
        
    }//end method store

    //view items page
    public function view(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $items = item::withTrashed()->find($request->input('id'));// id items input

        return view('item.view',['item'=>$items]);
    }//end method view 

    public function removeImage(Request $request)
    {
        
        $validated = $request->validate([
            'id' => 'required',
        ]); 

        $item = item::find($validated['id']);// find table  based id


            if($item->picture != 'empty.png')
            {
                
                $filePath = public_path('image/item/'.$item->picture); // store file to location

                // delete fine from past
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
            
            // store image name to database
                $item->picture = 'empty.png';
                $item->save();

                activity_log::addActivity(' remove image profile tem '.$item->item.' to empty');

            return redirect(route('item.view').'?id='.$validated['id'])->with('success','success remove image');
            

    }//end method remove image

    public function update(Request $request)
    {
        $item_id = $request->input('id');

        $rules = [
            'id' => 'required',
            'item' => ['required',Rule::unique('items','item')->ignore( $item_id)],
            'barcode' => ['required','numeric',Rule::unique('items','barcode')->ignore( $item_id)],
            'shortcode' => ['required',Rule::unique('items','shortcode')->ignore( $item_id)],
            'cost' => 'required|numeric',
            'price' => 'required|numeric|gte:cost',
            'description' => 'required|string',
            'category' => 'required',
        ];

        if($request->hasFile('file')) 
        {
            $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        
    
        $validated = $request->validate($rules);

        $item = item::find($validated['id']);
        $item->item = $validated['item'];
        $item->barcode = $validated['barcode'];
        $item->shortcode = $validated['shortcode'];
        $item->cost = $validated['cost'];
        $item->price = $validated['price'];
        $item->description = $validated['description'];
        $item->category = $validated['category'];





        if($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename
            $destinationPath = public_path('image/item/');

            $file->move($destinationPath, $fileName);

            // Delete the old file if it's not the default 'empty.png'
            if ($item->picture && $item->picture != 'empty.png') 
                {
                $filePath = $destinationPath . $item->picture;

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }//check image by default or not

            // Update the user's picture field with the new file name
            $item->picture = $fileName;

        }//check file 

        $item->save();
        activity_log::addActivity( 'Changed item details to ' . $validated['item']);

        // --- 7. Redirect with Success Message ---
        return redirect(route('item.view').'?id='.$validated['id'])->with('success', 'Profile updated successfully!');

    }//end method update 

    public function status(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $item = item::withTrashed()->find($validated['id']);

        if(!$item->deleted_at)
        {

            $item->delete();
            
            activity_log::addActivity(' change status item to non active '.$item->item);
            return redirect(route('item.view').'?id='.$validated['id'])->with('success','item is non active');
        }
        else
        {
            $item->restore();

            activity_log::addActivity(' change status item to active back');
            return redirect(route('item.view').'?id='.$validated['id'])->with('success','item is active back');
        }

        return back();
    }//end method status

    public function statusQuick(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $item = item::withTrashed()->find($validated['id']);

        if($item->quickorder_status == true)
        {

            $item->quickorder_status = false;
            $item->save();
            
            activity_log::addActivity(' change status quick order item to non active '.$item->item);
            return redirect(route('item.view').'?id='.$validated['id'])->with('success','item is non active to quick order');
        }
        else
        {

            $item->quickorder_status = true;
            $item->save();

            activity_log::addActivity(' change status item to active back quick order');
            return redirect(route('item.view').'?id='.$validated['id'])->with('success','item is active back quick order');
        }

        return back();
    }//end method status
}//end class
