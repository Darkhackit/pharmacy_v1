<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateManRequest;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
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
        $manufactures = Manufacturer::all();
        $trash = false;
        return view('manufacture.index',compact('manufactures','trash'));
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
    public function store(CreateManRequest $request)
    {
        $man = new Manufacturer();
        $man->manufacturer_name = $request->manufacturer_name;
        $man->phone = $request->phone;
        $man->email = $request->email;
        $man->address = $request->address;

        $man->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacture)
    {

        return response()->json(['man' => $manufacture]);
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
    public function update(CreateManRequest $request,Manufacturer $manufacture)
    {
        $manufacture->manufacturer_name = $request->manufacturer_name;
        $manufacture->phone = $request->phone;
        $manufacture->email = $request->email;
        $manufacture->address = $request->address;

        $manufacture->update();

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
        $manufacture = Manufacturer::withTrashed()->where('id', $id)->firstOrFail();

        if($manufacture->medicines->count() > 0) {

            return response()->json(['success' => false ]);

        }else{

            if($manufacture->trashed()) {

                $manufacture->forceDelete();
            }else {

                $manufacture->delete();
            }

            return response()->json(['success' => true ]);
        }


    }
    public function trashe() {

        $manufactures = Manufacturer::onlyTrashed()->get();
        $trash = true;
        return view('manufacture.index',compact('manufactures','trash'));
    }
    public function restore($id) {

        $manufacture = Manufacturer::withTrashed()->where('id', $id)->firstOrFail();
        $manufacture->restore();

        return response()->json(['success' => true]);
    }
}
