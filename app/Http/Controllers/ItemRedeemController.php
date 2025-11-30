<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\activity_log;
use App\Models\item_redeem;
use App\Models\customer;
use App\Models\customer_item_redeem;
use Illuminate\Validation\Rule;

class ItemRedeemController extends Controller
{
    public function index()
    {
        $itemredeen = item_redeem::all();

        return view('item-redeem.index',['itemredeen' => $itemredeen]);
    }//end method

    public function create()
    {
        return view('item-redeem.create');
    }//end method

        public function store(Request $request)
    {
        // validated new items data 
        $validated = $request->validate([
            
            'item' => 'required|unique:item_redeems,item',
            'point' => 'required|integer',
            'description' => 'required|string',
            
        ]);

        
        //store data to database 
        $item = new item_redeem;
        $item->item = $validated['item'];
        $item->point = $validated['point'];
        $item->description = $validated['description'];
        $item->save();

        activity_log::addActivity(' add new item Redeem '.$validated['item'].' into system');

        return redirect(route('item.redeem.create'))->with('success','add new item redeem, success make new items '.$validated['item']);
        
    }//end method

    public function view(Request $request)
    {
        $validated = $request->validate([
            
            'id' => 'required',
            
        ]);

        $items = item_redeem::find($request->input('id'));// id items input

        return view('item-redeem.view',['item'=>$items]);
    }//end method

    public function update(Request $request)
    {
        $item_id = $request->input('id');

        // validate data item update base rule
        $validated = $request->validate([
            'id' => 'required',
            'item' => ['required',Rule::unique('item_redeems','item')->ignore( $item_id)],
            'point' => 'required|integer',
            'description' => 'required',
        ]);

        //store data update to database
        $item = item_redeem::find($validated['id']);
        $item->item = $validated['item'];
        $item->point = $validated['point'];
        $item->description = $validated['description'];
        $item->save();

        activity_log::addActivity(' change it details item redeen '.$validated['item']);

        return redirect(route('item.redeem.view').'?id='.$validated['id'])->with('success','edit details item '.$validated['item']);

    }//end method

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $item = item_redeem::find($request->input('id'));

        $item->delete();

        activity_log::addActivity(' remove '.$item->item.' item redeem from list');

        return redirect(route('item.redeem'))->with('success','item is delete');
    }//end method

    public function status(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $item = item_redeem::find($request->input('id'));

        if($item->status == true)
        {
            $item->status = false;
            $item->save();
            
            activity_log::addActivity(' change status item redeen to deactive');
            return redirect(route('item.redeem.view').'?id='.$request->input('id'))->with('success','item is deactive');
        }
        else
        {
            $item->status = true;
            $item->save();

            activity_log::addActivity(' change status item redeen to active back');
            return redirect(route('item.redeem.view').'?id='.$request->input('id'))->with('success','item is active back');
        }

        return back();
    }//end method

    
    public function customer_redeem(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $customer = '';

        $items = item_redeem::find($request->input('id'));
        //get all list custmer data
        $customerList = customer::all();

        if($request->has('id_cust'))
        {
            $customer = customer::find($request->input('id_cust'));
        }

        return view('item-redeem.customer_redeem',['request'=>$request,'items'=>$items, 'customer'=>$customer,'customerList'=>$customerList]);
    }//end method

    public function search_customer(Request $request)
    {
        //get all list custmer data
        $customer = customer::all();

        return view('item-redeem.search_customer',['request'=>$request,'customer'=>$customer]);
    }//end method

    public function redeen(Request $request)
    {
        $validated = $request->validate([
            'item_status' => 'accepted',
            'id' => 'required',
            'id_cust' => 'required',
            'point_customer' => 'required|gte:item_point',
        ]);

        $customer = customer::find($validated['id_cust']);
        $items = item_redeem::find($validated['id']);

        if($customer->point <= $items->point)
        {
            return redirect(route('item.redeem.customer_redeem').'?id='.$validated['id'].'&id_cust='.$validated['id'])->with('error',$customer->name.' point is not enough to redeem');
        }

        $customeritemredeen = new customer_item_redeem;

        $customeritemredeen->item = $items->item;
        $customeritemredeen->description = $items->description;
        $customeritemredeen->point = $items->point;
        $customeritemredeen->cust_id = $validated['id_cust'];
        $customeritemredeen->save();

        $customer->point = $customer->point - $items->point;
        $customer->save();

        activity_log::addActivity(' redeem item '.$items->name.' customer '.$customer->name.'');

        return redirect(route('item.redeem.customer_redeem').'?id='.$validated['id'])->with('success',$customer->name.'  redeem pont items '.$items->name);

    }//end method

}//end class
