<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Medicine;
use App\Purchase;
use App\Manufacturer;
use App\Purchase_Owing;
use App\Purchase_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddPurchaseRequest;
use App\Supplier;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::all();
        $purchases = DB::table('purchases')
                  ->join('suppliers','suppliers.id','=','purchases.manufacture')
                  ->join('payments','payments.id','=','purchases.payment')
                  ->select('purchases.id as id','purchases.purchase_id','purchases.invoice_number','purchases.purchase_date','purchases.total','suppliers.company_name','payments.payment_name','purchases.status')
                  ->get();


        return view('purchase.index',compact('purchases','medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufactures = Supplier::all();
        $payments = Payment::all();
        $medicine = Medicine::pluck('name','id');
        $medicines = Medicine::all();
        return view('purchase.create',compact('manufactures','payments','medicine','medicines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPurchaseRequest $request)
    {
        $invoice_exist = Purchase::where('invoice_number',$request->invoice)->first();
        if($invoice_exist){

            return response()->json(['error' => 'invoice already exist']);
        }

        $manufacture = $request->manufacture_id;
        $date = $request->date;
        $invoice = $request->invoice;

        $payment = $request->payment;
        $medicineID = $request->medicine;
        $expired = $request->expirydate;
        $quantity = $request->quantity;
        $newPrice = $request->newPrice;
        $purchase_price = $request->purchase_price;
        $netTotal = $request->netTotal;

        $purchase = new Purchase();
        $purchase->manufacture = $manufacture;
        $purchase->purchase_date = $date;
        $purchase->total = $request->total;
        $purchase->date = date('Y-m-d');
        $purchase->purchase_id = mt_rand().''.date('Ymd');
        $purchase->invoice_number = $invoice;
        $purchase->payment = $payment;

        if($request->payment_date)
        {
            if($request->paid_amount > $request->total)
            {
                return response()->json(['error' => 'Paid amount cannot be bigger than the total']);
            }
            $purchase->status = false;
        }

        $purchase->save();

        if($purchase->id) {

            $purchase_detail = [];
            $purchase_owing = [];


            if($request->payment_date)
                {

                    $purchase_owing[] = [

                        'purchase_id' => $purchase->id,
                        'paid_amount' => $request->paid_amount,
                        'payment_date' => $request->payment_date,
                        'date' => date('Y-m-d')
                    ];
                }


            for($i = 0; $i < count($quantity); $i++){



                $purchase_detail[] = [
                "purchase_id" => $purchase->id,
                "medicine_id" => $medicineID[$i],
                "quantity" => $quantity[$i],
                "ext_date" => $expired[$i],
                "purchase_price" => $purchase_price[$i],
                "total" => $netTotal[$i],
                "date" => date('Y-m-d'),

                ];



                $medicine = Medicine::find($medicineID[$i]);


                $medicine->stock = $medicine->stock + $quantity[$i];
                $medicine->exDate = $expired[$i];
                $medicine->purchase_price = $purchase_price[$i];
                $medicine->selling_price = $newPrice[$i];
                $medicine->update();


            }

            // dd($newMed,$purchase_detail);
            Purchase_Details::insert($purchase_detail);
            Purchase_Owing::insert($purchase_owing);

            return response()->json(['success' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = DB::table('medicines')
        ->where("manufacturer_id",$id)
        ->get();

        return response()->json($medicine);
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
        Purchase::find($id)->delete();

        return response()->json(['success' => true]);
    }

    public function purchaseDetails($id) {


        $purchase_detail = DB::table('purchases')
                          ->join('purchase__details','purchase__details.purchase_id','=','purchases.id')
                          ->join('medicines','medicines.id','=','purchase__details.medicine_id')
                          ->join('suppliers','suppliers.id','=','purchases.manufacture')
                          ->where('purchases.id',$id)
                          ->select('medicines.name','purchase__details.quantity','medicines.exDate','medicines.purchase_price','purchase__details.total as netTotal','purchases.total as mainTotal','suppliers.company_name','purchases.invoice_number','purchases.purchase_date')
                          ->get();

        return response()->json($purchase_detail);
    }

    public function getAllPurchase()
    {
        return view('purchase.filter');
    }

    public function fetchData(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != "" && $request->to_date != "")
            {
                $data = DB::table('purchases')
                ->join('manufacturers','manufacturers.id','=','purchases.manufacture')
                ->join('payments','payments.id','=','purchases.payment')
                ->select('purchases.id as id','purchases.purchase_id','purchases.invoice_number','purchases.purchase_date','purchases.total','manufacturers.manufacturer_name','payments.payment_name')
                ->whereBetween('date',[$request->from_date,$request->to_date])
                ->get();
            }
            else
            {
                $data =  DB::table('purchases')
                ->join('manufacturers','manufacturers.id','=','purchases.manufacture')
                ->join('payments','payments.id','=','purchases.payment')
                ->select('purchases.id as id','purchases.purchase_id','purchases.invoice_number','purchases.purchase_date','purchases.total','manufacturers.manufacturer_name','payments.payment_name')
                ->orderBy('date','desc')
                ->get();

            }

            return response()->json($data);
        }
    }

    public function purchaseReturn()
    {
        $medicine = Purchase::pluck('purchase_id','id');


        return view('purchases.return',compact('medicine'));
    }

    public function purchasedRetur($id)
    {

        $returns = DB::table('purchases')
        ->join('purchase__details','purchase__details.purchase_id','=','purchases.id')
        ->join('medicines','medicines.id','=','purchase__details.medicine_id')
        ->join('manufacturers','manufacturers.id','=','purchases.manufacture')
        ->select('medicines.name','manufacturers.manufacturer_name','medicines.id')
        ->where('purchases.id',$id)

        ->get();


        return response()->json($returns);
    }
}
