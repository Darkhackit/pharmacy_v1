<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWastageRequest;
use App\Medicine;
use App\Wastage;
use App\WastageType;
use Illuminate\Foundation\Console\Presets\Vue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WastageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wastages = DB::table('wastages')
                 ->join('wastage_types','wastage_types.id','=','wastages.wastage_type')
                 ->join('manufacturers','manufacturers.id','=','wastages.manufacture')
                 ->join('medicines','medicines.id','=','wastages.medicine')
                 ->select('medicines.name as medName','manufacturers.manufacturer_name','wastages.quantity','wastage_types.name as wasteName','wastages.date','wastages.id','wastages.purchase_price')
                 ->get();

        return view('wastage.index',compact('wastages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicine = Medicine::pluck('name','id');
        $wastage = WastageType::pluck('name','id');
        return view('wastage.create',compact('medicine','wastage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddWastageRequest $request)
    {

        $medicine_id = $request->medicine;
        $manu_id = $request->manu_id;
        $quantity = $request->quantity;
        $wastages = $request->wastage;
        $purchase = $request->purchase;


        $main_waste = [];

        for($i = 0; $i < count($medicine_id); $i++){


            $medicine = Medicine::find($medicine_id[$i]);
            $medicine->stock = $medicine->stock - $quantity[$i];
            $medicine->update();



            $main_waste[] = [
                'medicine' => $medicine_id[$i],
                'manufacture' => $manu_id[$i],
                'quantity' => $quantity[$i],
                'wastage_type' => $wastages[$i],
                'purchase_price' => $purchase[$i],
                'date' => date('Y-m-d'),

            ];

        }

        Wastage::insert($main_waste);

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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wastages = Wastage::find($id);

        $medicine = Medicine::find($wastages->medicine);
        $medicine->stock = $medicine->stock + $wastages->quantity;
        $medicine->update();

        $wastages->delete();

        return response()->json(['success' => true]);
    }
}
