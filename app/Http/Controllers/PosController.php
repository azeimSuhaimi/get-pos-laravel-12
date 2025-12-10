<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\item;
use App\Models\suspend;
use App\Models\suspend_detail;
use App\Models\activity_log;
use App\Models\customer;
use Illuminate\Support\Carbon;

use App\Models\quickorder;
use App\Models\quickorder_detail;

class PosController extends Controller
{
    public function index()
    {

        $deletedCount = suspend::where('created_at', '<', Carbon::today())->delete();
        $deletedCountDetails = suspend_detail::where('created_at', '<', Carbon::today())->delete();
        $updatedCount = item::where('expired_date', '<=', Carbon::today())
                            ->update(['discount' => 0]);


        $customer = customer::all();
        $item = item::all(); // get all items list
        $suspend = suspend::all();// get all suspend list
        return view('pos.index',['suspend'=>$suspend,'items'=>$item,'customer'=>$customer]);
    }//end method

        // add item to cart for list item selected
    public function addItem(Request $request)
    {
        // validation all input item add
        $validated = $request->validate([
            'shortcode' => 'required',
        ]);

        $item = item::where('shortcode',$validated['shortcode'])->first();

        if($item === null)
        {
            
            return redirect()->back()->with('error','item enter not exist in system');
        }
        else
        {
            if($item->quantity < 1 && $item->category == true)
            {
                return redirect()->back()->with('error','item enter quantity is empty in system or not enought');
            }
            else
            {
                $data =  [
                    'remark' => '',
                    'cost' => $item->cost,
                    'description' =>  $item->description,
                    'category' => $item->category,
                    'discount' => $item->discount,
                ];

                //add to cart item select
                $price = $item->price - ($item->price * $item->discount / 100);
                Cart::add($item->shortcode,$item->item, 1, $price,$data);
                return redirect(route('pos'));
            }

        }

        return redirect()->back();

    }//end method add item

    //update quantity items selected in cart
    public function updateQuantity(Request $request)
    {
        if($request->has('id')) // check id required
        {
            if($request->input('quantity') > 0)//enter not less zero
            {
                if($request->has('rowid'))
                {
                    $id = $request->input('id'); // items id select
                    $quantity = $request->input('quantity'); // quantity update 
                    $rowId = $request->input('rowid');// id in row cart select
    
                    Cart::update($rowId, $quantity); // update the quantity items
    
                    return redirect(route('pos'));
                }

            }
            return redirect()->back()->with('error', 'quantity cannot negetif added have a problem!!!');
        }

        return redirect()->back()->with('error', 'Item added have a problem.');

    }//emd method update quantity
    
    //update price items selected in cart
    public function updatePrice(Request $request)
    {
        if($request->has('id')) // check id required
        {
            if($request->input('price') > 0)//enter not less zero
            {
                if($request->has('rowid'))
                {
                    if($request->input('discount') <= 0)
                    {
                        $id = $request->input('id'); // items id select
                        $price = $request->input('price'); // quantity update 
                        $rowId = $request->input('rowid');// id in row cart select
        
                        Cart::update($rowId, ['price' => $price]); // update the quantity items
        
                        activity_log::addActivity(' change it price item '.Cart::get($rowId)->name);
                        return redirect(route('pos'));
                    }
                    return redirect()->back()->with('error', 'price item already have discount');
                }
            }
            return redirect()->back()->with('error', 'price cannot negetif added have a problem!!!');
        }

        return redirect()->back()->with('error', 'Item added have a problem.');
    }//end method update price

        //remove item in cart
    public function itemRemove(Request $request)
    {
        if($request->has('rowid'))// check row id in cart
        {
            $rowId = $request->input('rowid'); // input row id in cart

            Cart::remove($rowId); // remove items selected

            return redirect()->back()->with('success', 'items removed from cart.');
        }

        return redirect()->back()->with('error', 'Item remove have a problem.');
    }//end method

        // remove all item in cart
    public function removeAll(Request $request)
    {
        Cart::destroy();
        $request->session()->forget('cust_id');
        $request->session()->forget('cust_name');
        $request->session()->forget('cust_phone');
        $request->session()->forget('cust_email');
        return redirect(route('pos'))->with('success', ' new sale created.');
    }//end method

        // suspend all items select in cart 
    public function suspend(Request $request)
    {
        // check in cart exist or not
        if($request->input('qty') > 0)//enter not less zero
        {
            
            $bill_id = Carbon::now()->timestamp; // get timestamp for bill id

            // store data in suspend bill
            $suspend = new suspend;
            $suspend->bill_id = $bill_id;
            $suspend->cust_id = session('cust_id');
            $suspend->total = Cart::total();
            $suspend->save();

            // store list items in suspend bill
            foreach(Cart::content() as $row)
            {
                $suspend_detail = new suspend_detail;
                $suspend_detail->bill_id = $bill_id;
                $suspend_detail->shortcode = $row->id;
                $suspend_detail->item = $row->name;
                $suspend_detail->quantity = $row->qty;
                $suspend_detail->price = $row->price;
                $suspend_detail->cost = $row->options->cost;
                $suspend_detail->discount = $row->options->discount;
                $suspend_detail->description = $row->options->description;
                $suspend_detail->category = $row->options->category;
                $suspend_detail->remark = $row->options->remark;
                $suspend_detail->suspend_id = $suspend->id;
                $suspend_detail->save();
            }

            Cart::destroy(); // remove all items in cart

            $request->session()->forget('cust_id');
            $request->session()->forget('cust_name');
            $request->session()->forget('cust_phone');
            $request->session()->forget('cust_email');
    

            return redirect()->back()->with('success', 'item suspend now!!!');
        }
        return redirect()->back()->with('error', 'item cannot empty  to suspend!!!');
    }//end method

        // view list suspend bill 
    public function suspendView(Request $request)
    {
        $suspend = suspend::all(); // get all list suspend bill
        $u = 0;
        foreach($suspend as $row)
        {
            $u += 1;
        }


        if(Cart::total() > 0)
        {
            return redirect(route('pos'))->with('error', ' please clear all item first or create new sale.');
        }
        else
        {
            if($u >= 1)
            {
                return view('pos.unsuspend',['suspend'=>$suspend]);
            }
            else
            {
                return redirect(route('pos'))->with('error', ' suspend is empty.');
            }
        }

        return back();

        
    }//end method suspend view

    //unsuspend bill in suspend bill 
    public function unsuspend(Request $request)
    {
        // check id input exist
        $validated = $request->validate([
            
            'id' => 'required',
        ]);

        $suspend = suspend::find($validated['id']); // find suspend bill based id 
        $suspend_details = suspend_detail::where('suspend_id',$suspend->id)->get();// get list items on suspend bill 

        // remove first cart if have before restore suspend
        Cart::destroy();

        // retore back bill in unsuspend
        foreach($suspend_details as $row)
        {
            $data =  [
                'remark' => $row->remark,
                'cost' => $row->cost,
                'description' =>  $row->description,
                'category' => $row->category,
                'discount' => $row->discount,
            ];

            //add to cart
            Cart::add($row->shortcode, $row->item, $row->quantity, $row->price,$data);

            $row->delete(); // delete item in suspend table
        }

        if($suspend->cust_id)
        {

            $cust = DB::table('customers')->where('id',$suspend->cust_id)->first();
    
            $request->session()->put('cust_id', $cust->id);
            $request->session()->put('cust_name', $cust->name);
            $request->session()->put('cust_phone', $cust->phone);
            $request->session()->put('cust_email', $cust->email);
        }


        $suspend->delete(); // deldete bill in suspend table
        

        return redirect(route('pos'));

    }//end method

    public function updateRemark(Request $request)
    {
        $validated = $request->validate([
    
            'rowid' => 'required',  // Ensure rowid exists in the cart
            'remark' => 'required',           // Validate remark
            'cost' => 'required',                    // Validate cost
            'description' => 'nullable',      // Validate description
            'category' => 'required',        // Validate category
            'discount' => 'required',
        ]);

        // Get the current cart item
        $cartItem = Cart::get($validated['rowid']);
        
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item not found in cart.');
        }

        // Merge the updated fields into the current options
        $updatedOptions =  [
            'remark' => $validated['remark'],
            'cost' => $validated['cost'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'discount' => $validated['discount'],
        ];

        //Cart::update($validated['rowid'], ['remark' => $validated['remark']]);

        // Update the cart item with the merged options
        Cart::update($validated['rowid'], [
            'options' => $updatedOptions
        ]);

        return redirect(route('pos'))->with('success', 'remark add to items');
    }//end method

    public function updateDiscount(Request $request)
    {
        $validated = $request->validate([
    
            'rowid' => 'required',  // Ensure rowid exists in the cart
            'remark' => 'nullable',           // Validate remark
            'cost' => 'required',                    // Validate cost
            'description' => 'nullable',      // Validate description
            'category' => 'required',        // Validate category
            'discount' => 'required',
        ]);
        
        // Get the current cart item
        $cartItem = Cart::get($validated['rowid']);
        
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item not found in cart.');
        }

        if ($cartItem->options->discount > 0) {
            return redirect()->back()->with('error', 'Item already discount in cart.');
        }

        // Merge the updated fields into the current options
        $updatedOptions =  [
            'remark' => $validated['remark'],
            'cost' => $validated['cost'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'discount' => $validated['discount'],
        ];

        // Update the cart item with the merged options
        Cart::update($validated['rowid'], 
        ['price' => calculateDiscount($cartItem->price,$validated['discount'])], [
            'options' => $updatedOptions
        ]);

        Cart::update($validated['rowid'],['options' => $updatedOptions]);

        return redirect(route('pos'))->with('success', ' add discount to items ');
    }//end method


    public function quickOrderPage(Request $request)
    {
        return view('pos.quick-order-page');
    }//end method

    public function quickOrder(Request $request)
    {
        $validated = $request->validate([
    
            'barcode' => 'required',  // Ensure rowid exists in the cart
        ]);

        $quickorder = quickorder::where('barcode',$validated['barcode'])->first(); // find suspend bill based id 
        if(!$quickorder)
        {
            return redirect()->back()->with('error', 'id given cannot be found!!!');
        }
        $quickorder_detail = quickorder_detail::where('barcode',$quickorder->barcode)->get();// get list items on suspend bill 


        // remove first cart if have before restore suspend
        Cart::destroy();

        // retore back bill in unsuspend
        foreach($quickorder_detail as $row)
        {
            $data =  [
                'remark' => $row->remark,
                'cost' => $row->cost,
                'description' =>  $row->description,
                'category' => $row->category,
                'discount' => $row->discount,
            ];

            //add to cart
            Cart::add($row->shortcode, $row->name, $row->quantity, $row->price, $data);

            $row->delete(); // delete item in suspend table
        }

        $quickorder->delete(); // deldete bill in suspend table
        

        return redirect(route('pos'));
        
    }//end method

    public function searchMember(Request $request)
    {
        //get all list custmer data
        $customer = customer::all();

        return view('pos.search-member',['customer'=>$customer,'request'=>$request]);
    }//end method

    public function addMember(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $request->session()->put('cust_id', $validated['id']);
        $request->session()->put('cust_name', $validated['name']);
        $request->session()->put('cust_phone', $validated['phone']);
        $request->session()->put('cust_email', $validated['email']);

        return redirect(route('pos'))->with('success', 'add member');
    }//end method

}//end class
