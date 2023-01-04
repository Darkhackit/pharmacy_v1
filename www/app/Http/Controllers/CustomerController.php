<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CustomerController extends Controller
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
        $customers = Customer::all();
        $trash = false;
        return view('customer.index',compact('customers','trash'));
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
    public function store(CreateCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->number_of_purchase = 0;

        $customer->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        return response()->json(['customer' => $customer]);
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
    public function update(CreateCustomerRequest $request, Customer $customer)
    {
        $customer->customer_name = $request->customer_name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;

        $customer->update();

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
        $customer = Customer::withTrashed()->where('id', $id)->firstOrFail();

        if($customer->trashed()) {

            $customer->forceDelete();
        }else {

            $customer->delete();
        }

        return response()->json(['success' => true ]);
    }
    public function trashe() {

        $customers = Customer::onlyTrashed()->get();
        $trash = true;
        return view('customer.index',compact('customers','trash'));
    }

    public function restore($id) {

        $customer = Customer::withTrashed()->where('id', $id)->firstOrFail();
        $customer->restore();

        return response()->json(['success' => true]);
    }

    public function fetchPurchases($id)
    {
        $customer = DB::table('sales_details')
                  ->join('customers','customers.id','=','sales_details.customer_id')
                  ->join('medicines','medicines.id','=','sales_details.medicine_id')
                  ->select('medicines.name','sales_details.quantity','sales_details.date','sales_details.created_at')
                  ->where('sales_details.customer_id',$id)
                  ->get();

                  return response()->json($customer);

    }

    public function purchaseCustomer()
    {

      //  dd('Hello');
      $customers = Customer::all();
        return view('customer.purchase',compact('customers'));
    }

    public function purchaseCustomersubmit(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != "" && $request->to_date != "" && $request->customer != '')
            {
                $data = DB::table('sales_details')
                ->join('sales','sales.id','=','sales_details.sales_id')
                ->join('medicines','medicines.id','=','sales_details.medicine_id')
                ->join('customers','customers.id','=','sales_details.customer_id')
                ->select('sales.code','medicines.name','sales_details.quantity','sales_details.price','sales_details.profit','sales_details.date','customers.customer_name')
                ->where('customers.id',$request->customer)
                ->whereBetween('sales_details.date',[$request->from_date,$request->to_date])
                ->get();
            }
            else
            {
                $data = DB::table('sales_details')
                ->join('sales','sales.id','=','sales_details.sales_id')
                ->join('medicines','medicines.id','=','sales_details.medicine_id')
                ->join('customers','customers.id','=','sales_details.customer_id')
                ->select('sales.code','medicines.name','sales_details.quantity','sales_details.price','sales_details.profit','sales_details.date','customers.customer_name')
                ->orderBy('sales_details.date','desc')
                ->get();

            }

            return response()->json($data);
        }
    }

    public function customerPdf(Request $request) {

        $customer = Customer::find($request->customer);
        $customerName = $customer->customer_name;

        $total = $request->total;

        $data = DB::table('sales_details')
                ->join('sales','sales.id','=','sales_details.sales_id')
                ->join('medicines','medicines.id','=','sales_details.medicine_id')
                ->join('customers','customers.id','=','sales_details.customer_id')
                ->select('sales.code','medicines.name','sales_details.quantity','sales_details.price','sales_details.profit','sales_details.date','customers.customer_name')
                ->where('customers.id',$request->customer)
                ->whereBetween('sales_details.date',[$request->from_date,$request->to_date])
                ->get();


                $pdf = PDF::loadView('customerpdf',compact('data','customerName','total'));
                // $customPaper = array(0,0,360,360);
                 $pdf->setPaper('A5', 'portrait');
        
                return $pdf->stream($request->customer.'.pdf',["Attachment" => false]);
    }
}
