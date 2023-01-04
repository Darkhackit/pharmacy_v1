<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Http\Requests\AddPaymentRequest;
use Illuminate\Http\Request;

class PaymentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('MachineInfo');
        $this->middleware('FullyPaid');
    }
    public function index()
    {
        $categories = ExpenseCategory::all();

        return view('expensecategory.index',compact('categories'));
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
    public function store(AddPaymentRequest $request)
    {
        $category = new ExpenseCategory();
        $category->expense_name = $request->name;
        $category->description = $request->description;

        $category->save();

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

        $expense_category = ExpenseCategory::find($id);

        return response()->json($expense_category);
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
    public function update(AddPaymentRequest $request, $id)
    {
        $category = ExpenseCategory::find($id);
        $category->expense_name = $request->name;
        $category->description = $request->description;

        $category->update();

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
        $category = ExpenseCategory::find($id);
        $category->delete();

        return response()->json(['success' => true] );
    }
}
