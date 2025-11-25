<?php

namespace App\Http\Controllers;


use App\Models\invoice;
use App\Models\customer;

use App\Models\activity_log;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\customer_item_redeem;
use App\Models\invoice_detail;

class CustomerController extends Controller
{
    public function index()
    {
        //get all list custmer data
        $customer = customer::all();

        return view('customer.index',['customer' => $customer]);
    }//end method

    public function create()
    {
        return view('customer.create');
    }//end method

    public function store(Request $request)
    {

        $validated = $request->validate([
            
            'name' => 'required|string',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'numeric|required|unique:customers,phone',
        ]);

        //store data to database 
        $customer = customer::addCustomer($validated);

        activity_log::addActivity(' Registeer new member to '.$validated['name']);

        return back()->with('success','Add new member '.$validated['name']);
    }// end method

    public function createByGuest()
    {
        return view('customer.create-by-guest');
    }//end method

    public function storeByGuest(Request $request)
    {

        $validated = $request->validate([
            
            'name' => 'required|string',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'numeric|required|unique:customers,phone',
        ]);

        //store data to database 
        $customer = customer::addCustomer($validated);

        return back()->with('success','Add new member '.$validated['name']);
    }// end method

    //view customer page
    public function view(Request $request)
    {
        $validated = $request->validate([
            
            'id' => 'required',
        ]);

        $purchase_detail = invoice_detail::where('cust_id',$validated['id'])->orderBy('created_at', 'desc')->get();
        $customeritemredeen = customer_item_redeem::where('cust_id',$validated['id'])->orderBy('created_at', 'desc')->get();

        $customer = customer::find($request->input('id'));// id customer input

        return view('customer.view',['purchase_detail' => $purchase_detail,'customeritemredeen' => $customeritemredeen,'customer'=>$customer]);
    }//end method

    public function update(Request $request)
    {
        $user_id = $request->input('id');
        // validate data employee update base rule
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'email' => ['required','email',Rule::unique('users','email')->ignore( $user_id)],
            'phone' => ['required','numeric',Rule::unique('users','phone')->ignore( $user_id)],
            'address' => 'nullable',
        ]);

        //store data update to database
        $customer = customer::updateCustomer($validated);

        activity_log::addActivity(' update  details customer '.$validated['name']);

        return redirect(route('customer.view').'?id='.$validated['id'])->with('success','edit details customer '.$validated['name']);

    }//end method

    public function enterMember(Request $request)
    {
        // validate data employee update base rule
        $validated = $request->validate([
            'invoice_id' => 'required',
            'id' => 'required',
            
            
        ]);

        $invoice = invoice::where('invoice_id',$validated['invoice_id'])->first();

        if(!$invoice)
        {
            return redirect(route('customer.view').'?id='.$validated['id'])->with('error','invoice enter not exist '.$validated['invoice_id']);
        }

        if(!$invoice->cust_id == null)
        {
            return redirect(route('customer.view').'?id='.$validated['id'])->with('error','invoice enter already have member '.$validated['invoice_id']);
        }

        $customer = customer::where('id',$validated['id'])->first();
        $customer->point += $invoice->subtotal;
        $customer->save();

        $invoiceDetails = invoice_detail::where('inv_id', $invoice->id)->get();

        foreach($invoiceDetails as $row)
        {
            $row->cust_id = $customer->id;
            $row->save();
        }

        $invoice->cust_id = $customer->id;
        $invoice->save();

        activity_log::addActivity(' enter invoice '.$validated['invoice_id'].' to customer '.$customer->name);

        return redirect(route('customer.view').'?id='.$validated['id'])->with('success','enter member to invoice '.$validated['invoice_id'].' to customer '.$customer->name);

    }//end method

}//end class
