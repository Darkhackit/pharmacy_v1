<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $supplies = Supplier::all();
        $trash = false;
        return view('supplier.index',compact('supplies','trash'));
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
    public function store(CreateSupplierRequest $request)
    {
        $supply = new Supplier();
        $supply->company_name = $request->company_name;
        $supply->phone = $request->phone;
        $supply->address = $request->company_name;
        $supply->city = $request->city;
        $supply->country = $request->country;
        $supply->account_number = $request->acct;
        $supply->email = $request->email;
        $supply->description = $request->description;

        $supply->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supply)
    {
        return response()->json(['supply' => $supply]);

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
    public function update(CreateSupplierRequest $request, Supplier $supply)
    {
        $supply->company_name = $request->company_name;
        $supply->phone = $request->phone;
        $supply->email = $request->email;
        $supply->country = $request->country;
        $supply->city = $request->city;
        $supply->address = $request->address;
        $supply->account_number = $request->acct;
        $supply->description = $request->description;

        $supply->update();

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
        $supply = Supplier::withTrashed()->where('id', $id)->firstOrFail();

        if($supply->medicines->count() > 0) {

            return response()->json(['success' => false ]);
        }else {

            if($supply->trashed()) {

                $supply->forceDelete();
            }else {

                $supply->delete();
            }

            return response()->json(['success' => true ]);
        }



    }
    public function trashe() {

        $supplies = Supplier::onlyTrashed()->get();
        $trash = true;
        return view('supplier.index',compact('supplies','trash'));

    }

    public function restore($id) {

        $supply = Supplier::withTrashed()->where('id', $id)->firstOrFail();
        $supply->restore();

        return response()->json(['success' => true]);
    }
}
