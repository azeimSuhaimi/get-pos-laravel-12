<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use App\Models\activity_log;
use App\Models\item;
use App\Models\stock_in_header;
use App\Models\stock_in_detail;

class ItemController extends Controller
{
    //get all list item product
    public function index()
    {
        $items = item::withTrashed()->orderBy('created_at','desc')->get();
        $do = stock_in_header::withTrashed()->orderBy('created_at','desc')->get();

        return view('item.index',['items' => $items,'do' => $do]);
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

    public function createDo()
    {
        return view('item.create-do');
    }//end method create

    public function storeDo(Request $request)
    {

        // validated new items data 
        $validated = $request->validate([
            
            'do_number' => 'required|unique:stock_in_headers,do_number',
            'grn_no' => 'required|unique:stock_in_headers,grn_no',
            'date_receive' => 'required',
            'supplier' => 'required',
            'receive_by' => 'required',
            'remark' => 'required|string',
            
        ]);

        
        //store data to database 
        $stock = new stock_in_header;
        $stock->do_number = $validated['do_number'];
        $stock->grn_no = $validated['grn_no'];
        $stock->date_receive = $validated['date_receive'];
        $stock->supplier = $validated['supplier'];
        $stock->receive_by = $validated['receive_by'];
        $stock->remark = $validated['remark'];
        $stock->save();

        activity_log::addActivity(' add new item do number '.$validated['do_number'].'into system');

        return back()->with('success','add new item, success make new do number '.$validated['do_number']);
        
    }//end method store

    public function viewDo(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $do = stock_in_header::withTrashed()->find($request->input('id'));// id items input
        $do_detail = stock_in_detail::withTrashed()->where('item_id',$request->input('id'))->get();// id items input

        return view('item.view-do',['do'=>$do, 'do_detail'=>$do_detail]);
    }//end method view 

    public function storeDoItem(Request $request)
    {

        // validated new items data 
        $validated = $request->validate([
            'id' => 'required',
            'code' => 'required',
            'quantity' => 'required|integer',
            'cost' => 'required|numeric',
            'remark' => 'required|string',
            
        ]);

        $item = item::withTrashed()->where('barcode',$validated['code'])->orWhere('shortcode',$validated['code'])->orWhere('item',$validated['code'])->first();

        if(!$item)
        {
            return back()->with('error',$validated['code'].' not exist');
        }

        //store data to database 
        $stock = new stock_in_detail;
        $stock->item = $item->item;
        $stock->barcode =  $item->barcode;
        $stock->shortcode =  $item->shortcode;
        $stock->quantity = $validated['quantity'];
        $stock->cost = $validated['cost'];
        $stock->total = $validated['cost'] * $validated['quantity'];
        $stock->remark = $validated['remark'];
        $stock->stock_in_id = $validated['id'];
        $stock->item_id = $item->id;
        $stock->save();

        if($item->price < $validated['cost'])
        {
            $item->cost = $validated['cost'];
            $item->price = $validated['cost'] * 1.30;
        }

        if($item->price > $validated['cost'])
        {
            $item->cost = $validated['cost'];
        }

        $item->quantity += $validated['quantity'];
        $item->save();

        activity_log::addActivity(' add new stock in item  '.$validated['code'].'into system');

        return back()->with('success','add new item stockin '.$validated['code']);
        
    }//end method store

}//end class
