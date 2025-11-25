<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\customer_order;
use Illuminate\Support\Carbon;
use App\Models\activity_log;

class customerOrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->input('date') != null)
        {
            $validated = $request->validate([
                'date' => 'required|date_format:Y-m', // Ensure the format is 'YYYY-MM'
            ]);

            $customer_order = customer_order::customerOrderListByDate( $validated['date']);
            
            $data = [
                'request' => $request,
                'customer_order' => $customer_order,
                'date' => $validated['date']
            ];
        }
        else
        {
            $customer_order = customer_order::customerOrderAllList();
            
            $data = [
                'request' => $request,
                'customer_order' => $customer_order,
                'date' => null
            ];
        }//end condition

        return view('customer-order.index',$data);

    }//end method

    public function create()
    {
        return view('customer-order.create');
    }//end method

    public function store(Request $request)
    {
        
        // validated new  data 
        $validated = $request->validate([
            
            'name' => 'required|string',
            'email' => 'required',
            'phone' => 'required',
            'item' => 'required',
            'remark' => 'nullable',
            
        ]);

        //store data to database 
        customer_order::addCustomerOrder($validated);

        activity_log::addActivity(' add new Customer Order '.$validated['name'].' ');

        return redirect(route('customer.order'))->with('success','add new customer order '.$validated['name']);
        
    }//end method store

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        customer_order::updateContact($validated['id']);
        
        activity_log::addActivity(' update status contact ');
            
        return back()->with('success','update customer order contact ');
    }//end method

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        customer_order::updatePickup($validated['id']);

        activity_log::addActivity(' update status pick up ');
            
        return back()->with('success','update customer order status ');
    }//end method

        public function remove (Request $request)
    {
        // validation all input expense 
        $validated = $request->validate([
            'id' => 'required',
        ]);

        customer_order::deleteOrder($validated['id']);

        activity_log::addActivity(' remove customer order ');

        return back()->with('success','remove customer order  ');

    }//end method

}//end class
