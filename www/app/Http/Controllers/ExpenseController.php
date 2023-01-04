<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\Http\Requests\AddExpenseRequest;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('MachineInfo');
        $this->middleware('FullyPaid');
    }
    public function index()
    {
        $expenses = DB::table('expenses')
                   ->join('payments','payments.id','=','expenses.payment_id')
                   ->join('expense_categories','expense_categories.id','=','expenses.expense_category_id')
                   ->select("expenses.id","expense_categories.expense_name","payments.payment_name","expenses.date","expenses.amount","expenses.tax","expenses.description","expenses.note")
                   ->get();

                
        $categories = ExpenseCategory::all();
        $payments = Payment::all();

        return view('expense.index',compact('expenses','categories','payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddExpenseRequest $request)
    {
        $expense = new Expense();
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->payment_id = $request->payment;
        $expense->expense_category_id = $request->category;
        $expense->description = $request->description;
        $expense->tax = $request->tax;
        $expense->note = $request->note;
        $expense->code = $request->code;
        $expense->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenses = DB::table('expenses')
        ->join('payments','payments.id','=','expenses.payment_id')
        ->join('expense_categories','expense_categories.id','=','expenses.expense_category_id')
        ->where('expenses.id',$id)
        ->get();

        return response()->json($expenses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddExpenseRequest $request, $id)
    {
        $expense = Expense::find($id);
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->tax = $request->tax;
        $expense->payment_id = $request->payment;
        $expense->expense_category_id = $request->category;
        $expense->description = $request->description;
        $expense->note = $request->note;

        $expense->update();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return response()->json(['success' => true]);
    }

    public function report() {

        $profits = DB::table('sales_details')
        ->select(DB::raw("strftime('%m-%Y', date(sales_details.created_at)) as dates"),DB::raw('sum(sales_details.profit) as profit'))
        ->groupBy('dates')
        ->orderBy('dates','asc')
        ->get();

        $expenses = DB::table('expenses')
        ->select(DB::raw("strftime('%m-%Y', date(expenses.date)) as dates"),DB::raw('sum(expenses.amount) as expense'))
        ->groupBy('dates')
        ->orderBy('dates','asc')
        ->get();

        // dd($expenses,$profits);

        $dates = [];
        $profit = [];


        foreach($profits as $mon) {

            array_push($dates , $mon->dates);
            array_push($profit , $mon->profit);

            // dd($monthlysales);

        }
         $expense = [];
        foreach($expenses as $mon) {

            array_push($expense , $mon->expense);
            // array_push($dates , $mon->dates);
            // dd($monthlysales);

        }


        return view('expense.report',compact('dates','profit','expense'));
    }
}
