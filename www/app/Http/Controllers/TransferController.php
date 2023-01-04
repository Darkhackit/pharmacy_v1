<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Medicine;
use App\Transfer;
use App\TransferDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{

    public function index()
    {
        $transfers = Transfer::latest()->get();

        // $transfers = DB::table('transfers')->join('shops','shops.id','=','transfers.to')
        //                                 //    ->join('shops','shops.id','=','transfer.from')
        //                                    ->get();
        return view('transfer.index',compact('transfers'));
    }

    public function create()
    {
        $shops = Shop::latest()->get();
        $medicines = Medicine::latest()->get();
        return view('transfer.create',compact('shops','medicines'));
    }

    public function store(Request $request)
    {
      $to = $request->to;
      $from = $request->from;
      $date = $request->date;
      $mode = $request->mode;
      $quantity = $request->quantity;
      $medicineID = $request->medicine;
      $netTotal = $request->netTotal;

      if($to == $from)
      {
          return response()->json(['error' => 'You cannot send or receive medicines from the same pharmacy']);
      }


      $transfer = new Transfer();
      $transfer->from = $from;
      $transfer->to = $to;
      $transfer->transfer_id = rand();
      $transfer->total = $request->total;
      $transfer->transfer_date = $request->date;
      $transfer->mode = $mode;

      $transfer->save();

      if($transfer->id)
      {
        $transfer_detail = [];

        for($i = 0; $i < count($quantity); $i++){

            $transfer_detail[] = [
                'transfer_id' => $transfer->id,
                'medicine_id' => $medicineID[$i],
                'quantity' => $quantity[$i],
                'total' => $netTotal[$i],
                'date' => now()
            ];

            $medicine = Medicine::find($medicineID[$i]);

            if($mode == 'sent')
            {
                $medicine->stock = $medicine->stock - $quantity[$i];
            }
            else {

                $medicine->stock = $medicine->stock + $quantity[$i];
            }

            $medicine->update();

        }

        TransferDetail::insert($transfer_detail);

        return response()->json(['success' => true]);
      }

    //   if($mode == 'sent')
    //   {

    //   }
    }

    public function show($id)
    {
        $transfers = DB::table('transfer_details')->join('transfers','transfers.id','=','transfer_details.transfer_id')
                    ->join('medicines','medicines.id','=','transfer_details.medicine_id')
                     ->where('transfers.id',$id)
                     ->get();

                     return response()->json($transfers);

    }
}
