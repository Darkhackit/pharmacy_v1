<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateSalesRequest;
use App\Http\Requests\ReturedMedicineRequest;
use App\Medicine;
use App\Sales;
use App\Sales_Details;
use App\SalesReturn;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('MachineInfo');
        $this->middleware('FullyPaid');
    }
    public function index(Request $request)
    {
        $start = $request->startDate;
        $end = $request->endDate;


        $sales = DB::table('sales')->join('customers', 'customers.id', '=', 'sales.customer_id')->join('users', 'users.id', '=', 'sales.user_id')
            ->latest()
            ->get();

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $customers = Customer::all();
        //  $medicines = DB::table('medicines')->where('stock','>','0')->get();
        if(\auth()->user()->email == "alicegodwill7@gmail.com") {
            $medicines = Medicine::where('hidden',false)->get();
        }else {
            $medicines = DB::table('medicines')->orderBy('medicines.name', 'asc')->get();
        }

        $bestSellers = DB::table('sales')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->select(DB::raw('SUM(sales.total_price) as sale'), DB::raw('users.name'), DB::raw('users.image'))
            ->groupBy('sales.user_id')
            ->orderByDesc('sales')
            ->where('sales.date', date('Y-m-d'))
            ->where('users.id', Auth::user()->id)
            ->get();
        // dd($bestSellers);
        return view('sales.create', compact('customers', 'medicines', 'bestSellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(CreateSalesRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $sale = new Sales();
            $sale->code = $request->code;
            $sale->customer_id = $request->customer;
            $sale->user_id = $request->seller;
            $sale->tax = (float)$request->taxPrice;
            $sale->net_price = (float)$request->netPrice;
            $sale->total_price = (float)$request->total;
            $sale->date = $request->date;
            $sale->payment_method = $request->PaymentMethod;
            $sale->type = $request->type;

            if ($request->paidAmount) {

                $sale->paid_Amount = (float)$request->paidAmount;
            }
            if ($request->due) {

                $sale->due = (float)$request->due;
            }

            $price = $request->price;
            $purchase = $request->purchasePrice;
            $stock = $request->stock;
            $quantity = $request->quantity;
            $productName = $request->profuctName;
            $medicineID = $request->proID;
            $customer_id = $request->customer;
            $mainProfit = $request->mainProfit;

            $sale->save();
            $quantities =   array_map('intval', $quantity);
            $customer = Customer::find($customer_id);
            $customer->last_purchase = date('d-m-Y');
            $customer->number_of_purchase = $customer->number_of_purchase + array_sum($quantities);
            $customer->update();

            if ($sale->id) {

                for ($i = 0; $i < count($price); $i++) {



                    //dd($quantity[$i]);

                    $profit = (float)$mainProfit[$i] - (float)$purchase[$i];

                    if ($request->type != 'Profoma') {

                        $remaining = (float)$stock[$i] - (float)$quantity[$i];
                    }





                    $medicine = Medicine::find($medicineID[$i]);
                    if ($request->type != 'Profoma') {

                        $medicine->stock = (float)$remaining;
                    }

                    $medicine->number_of_sales = (float)$medicine->number_of_sales + (float)$quantity[$i];
                    $medicine->most_p = date('Y-m-d');
                    $medicine->update();



                    $sales_detail = new Sales_Details();
                    $sales_detail->sales_id = $sale->id;
                    $sales_detail->medicine_id = $medicineID[$i];
                    $sales_detail->price = (float)$price[$i];
                    $sales_detail->quantity = (float)$quantity[$i];
                    $sales_detail->profit = $profit * (float)$quantity[$i];
                    $sales_detail->customer_id = $customer_id;
                    $sales_detail->date = $request->date;

                    $sales_detail->save();
                }
            }

            DB::commit();

        }catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['errors' => [
                "customer" => [$exception->getMessage()]
            ]],422);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {

        $sales = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->join('medicines', 'medicines.id', '=', 'sales_details.medicine_id')
            ->where('sales.code', $id)
            ->get();

        return response()->json([$sales]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse

    {

        $sale = Sales::where('code', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function range(Request $request): JsonResponse
    {

        $start = $request->startDate;
        $end = $request->endDate;

        if ($start == null) {

            $sales = DB::table('sales')->join('customers', 'customers.id', '=', 'sales.customer_id')->join('users', 'users.id', '=', 'sales.user_id')
                ->get();
        } elseif ($start == $end) {

            $sales = DB::table('sales')->join('customers', 'customers.id', '=', 'sales.customer_id')->join('users', 'users.id', '=', 'sales.user_id')
                ->where('sales.date', 'LIKE', "%{$start}%")->get();
        } else {

            $sales = DB::table('sales')->join('customers', 'customers.id', '=', 'sales.customer_id')->join('users', 'users.id', '=', 'sales.user_id')
                ->whereBetween('sales.date', [$start, $end])->get();
        }

        dd($sales);

        // return view('sales.index', compact('sales'));

        return response()->json([$sales]);
    }

    public function report()
    {


        $monthlysales = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->select(DB::raw('sum(sales_details.price) as total'), DB::raw("strftime('%m-%Y', date(sales.created_at)) as dates"), DB::raw('sum(sales_details.profit) as profit'))
            ->groupBy('dates')
            ->orderBy('dates', 'asc')
            ->get();

        $dates = [];
        $total = [];
        $profit = [];

        foreach ($monthlysales as $mon) {

            array_push($dates, $mon->dates);
            array_push($total, $mon->total);
            array_push($profit, $mon->profit);

            // dd($monthlysales);

        }

        $weekSale = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->select(DB::raw('sum(sales_details.price) as total'), DB::raw("strftime('%W', date(sales.created_at))  as dates"), DB::raw('sum(sales_details.profit) as profit'))
            ->groupBy('dates')
            ->orderBy('dates', 'asc')
            ->get();

        $Wdates = [];
        $Wtotal = [];
        $Wprofit = [];

        foreach ($weekSale as $mon) {

            array_push($Wdates, $mon->dates);
            array_push($Wtotal, $mon->total);
            array_push($Wprofit, $mon->profit);
        }

        $YearSale = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->select(DB::raw('sum(sales_details.price) as total'), DB::raw("strftime('%Y', date(sales.created_at))  as dates"), DB::raw('sum(sales_details.profit) as profit'))
            ->groupBy('dates')
            ->orderBy('dates', 'asc')
            ->get();

        $Ydates = [];
        $Ytotal = [];
        $Yprofit = [];

        foreach ($YearSale as $mon) {

            array_push($Ydates, $mon->dates);
            array_push($Ytotal, $mon->total);
            array_push($Yprofit, $mon->profit);
        }

        $DaySale = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->select(DB::raw("strftime('%d-%m-%Y', sales.created_at)  as dates,SUM(sales_details.profit) as profit ,SUM(sales_details.price) as total"))
            ->groupBy("dates")
            ->orderBy('dates', 'asc')
            ->get();

        $Ddates = [];
        $Dtotal = [];
        $Dprofit = [];

        foreach ($DaySale as $mon) {

            array_push($Ddates, $mon->dates);
            array_push($Dtotal, $mon->total);
            array_push($Dprofit, $mon->profit);
        }

        //  dd($DaySale);

        return view('sales.report', compact('dates', 'total', 'profit', 'Wdates', 'Wtotal', 'Wprofit', 'Ydates', 'Ytotal', 'Yprofit', 'Ddates', 'Dtotal', 'Dprofit'));
    }

    public function returnsales()
    {

        $medicine = Sales::pluck('code', 'id');


        return view('sales.return', compact('medicine'));
    }

    public function returnsalesCode($code)
    {


        $returns = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->join('medicines', 'medicines.id', '=', 'sales_details.medicine_id')
            ->join('customers', 'customers.id', '=', 'sales.customer_id')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->select('customers.customer_name', 'users.name as userName', 'sales.total_price', 'sales.payment_method', 'medicines.name', 'customers.id as customerId', 'sales.id as salesID', 'medicines.id as medID')
            ->where('sales.id', $code)
            ->get();


        return response()->json($returns);
    }

    public function returnStore(ReturedMedicineRequest $request)
    {

        $medicineID = $request->medicine;
        $salesID = $request->code;

        $selectedSales = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->where('sales.id', $salesID)
            ->where('sales_details.medicine_id', $medicineID)
            ->get();


        foreach ($selectedSales as $sale) {

            // dd($sale);

            $actualPrice = $sale->quantity * $sale->price;

            $mainSales = Sales::find($sale->sales_id);
            $mainSales->total_price = $mainSales->total_price - $actualPrice;
            $mainSales->net_price = $mainSales->net_price - $actualPrice;
            $mainSales->update();

            $medicine = Medicine::find($sale->medicine_id);
            $medicine->stock = $medicine->stock + $sale->quantity;
            $medicine->update();


            $return = new SalesReturn();
            $return->sales_id = $sale->code;
            $return->medicine = $sale->medicine_id;
            $return->medicine_quantity = $sale->quantity;
            $return->reason = $request->reason;
            $return->customer = $sale->customer_id;
            $return->save();

            Sales_Details::where('sales_id', $sale->sales_id)->where('medicine_id', $sale->medicine_id)->delete();
        }

        return response()->json(['success' => true]);
    }

    public function returnList()
    {

        $returnLists = DB::table('sales_returns')
            ->join('customers', 'customers.id', '=', 'sales_returns.customer')
            ->join('medicines', 'medicines.id', '=', 'sales_returns.medicine')
            ->select('medicines.name', 'customers.customer_name', 'sales_returns.medicine_quantity', 'sales_returns.sales_id', 'sales_returns.id as returnID', 'sales_returns.reason', 'sales_returns.created_at as date')
            ->get();

        return view('sales.returnlist', compact('returnLists'));
    }

    public function returnReason($id)
    {

        $reason = SalesReturn::find($id);

        return response()->json([$reason]);
    }

    public function returnDelete($id)
    {

        SalesReturn::where('id', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function createpdf(Request $request)
    {


        $customer = Customer::find($request->customer);
        $customerName = $customer->customer_name;
        $seller = $request->seller_name;
        $type = $request->type;

        $total = $request->total;
        $tax = $request->taxPrice;
        $paid = $request->paidAmount;
        $payment = $request->PaymentMethod;


        $discount = $request->discount;

        if ($discount == null) {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }


        $due = $request->due;

        $code = $request->code;
        $sales = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->join('medicines', 'medicines.id', '=', 'sales_details.medicine_id')
            ->where('sales.code', $code)
            ->select('medicines.name as medName', 'sales_details.quantity', 'sales_details.price', 'medicines.selling_price', 'medicines.exDate')
            ->get();
        // dd($sales);
        $pdf = PDF::loadView('pdf', compact('sales', 'customerName', 'total', 'tax', 'paid', 'due', 'payment', 'seller', 'type', 'discount'));
        // $customPaper = array(0,0,360,360);
        $pdf->setPaper('A5', 'portrait');

        return $pdf->stream($code . '.pdf', ["Attachment" => false]);
    }

    public function getAllSales()
    {
        return view('sales.filter');
    }

    public function fetchSales(Request $request)
    {
        $from = $request->from_date ?  $request->from_date :  now()->startOfMonth()->format("Y-m-d");
        $to = $request->to_date ? $request->to_date :  now()->endOfMonth()->format("Y-m-d");
        if ($request->ajax()) {
                $data = DB::table('sales_details')
                    ->join('sales', 'sales.id', '=', 'sales_details.sales_id')
                    ->join('medicines', 'medicines.id', '=', 'sales_details.medicine_id')
                    ->join('customers', 'customers.id', '=', 'sales_details.customer_id')
                    ->select('sales.code', 'medicines.name', 'sales_details.quantity', 'sales_details.price', 'sales_details.profit', 'sales_details.date', 'customers.customer_name')
                    ->whereBetween('sales_details.date', [$from, $to])
                    ->get();
            return response()->json($data);
        }
    }

    public function wholesales()
    {

        $customers = Customer::all();
        $medicines = DB::table('medicines')->get();
        $bestSellers = DB::table('sales')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->select(DB::raw('SUM(sales.total_price) as sale'), DB::raw('users.name'), DB::raw('users.image'))
            ->groupBy('sales.user_id')
            ->orderByDesc('sales')
            ->where('sales.date', date('Y-m-d'))
            ->where('users.id', Auth::user()->id)
            ->get();
        // dd($bestSellers);
        return view('sales.wholesale', compact('customers', 'medicines', 'bestSellers'));
    }
    public function profoma()
    {

        $customers = Customer::all();
        $medicines = DB::table('medicines')->get();
        $bestSellers = DB::table('sales')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->select(DB::raw('SUM(sales.total_price) as sale'), DB::raw('users.name'), DB::raw('users.image'))
            ->groupBy('sales.user_id')
            ->orderByDesc('sales')
            ->where('sales.date', date('Y-m-d'))
            ->where('users.id', Auth::user()->id)
            ->get();
        // dd($bestSellers);
        return view('sales.profoma', compact('customers', 'medicines', 'bestSellers'));
    }
    public function salesValue()
    {

        $costPrice = DB::table('medicines')
            ->select(DB::raw('SUM(medicines.purchase_price * medicines.stock) as p'))
            ->get();

        $sellingPrice = DB::table('medicines')
            ->select(DB::raw('SUM(medicines.selling_price * medicines.stock) as s'))
            ->get();

        $medicines = Medicine::all();


        // dd($costPrice[0]->p,$sellingPrice[0]->s);
        return view('sales.salesValue', compact('costPrice', 'sellingPrice', 'medicines'));
    }
}
