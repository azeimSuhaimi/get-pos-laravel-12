<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\expense;
use App\Models\activity_log;

class ExpenseController extends Controller
{
        public function index()
        {
            //get all list custmer data
            $expense = expense::all();
    
            return view('expense.index',['expense' => $expense]);
        }//end method

        public function create()
        {
            return view('expense.create');
        }//end method

        
        public function store(Request $request)
        {
            // validation all input expense add
            $validated = $request->validate([
                
                'date' => 'required|date|nullable',
                'description' => 'required',
                'amount' => 'required|numeric',
                'receipt' => 'string|nullable',
                'notes' => 'string|nullable'
            ]);
    
            //store data to database 
            $expense = new expense;
            $expense->date = $validated['date'];
            $expense->description = $validated['description'];
            $expense->amount = $validated['amount'];
            $expense->receipt = $validated['receipt'];
            $expense->notes = $validated['notes'];
            $expense->save();

            activity_log::addActivity(' add new expense '.$validated['description']);
    
            return redirect(route('expense'))->with('success','Add new expense ');
        }// end method

    public function view(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        
        $expense = expense::withTrashed()->find($request->input('id'))->first();// id expense input

        return view('expense.view',['expense'=>$expense]);
    }//end method view
    
}//end class 
