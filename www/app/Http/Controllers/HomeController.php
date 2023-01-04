<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Medicine;
use App\Purchase;
use App\Purchase_Owing;
use App\Sales;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //    $this->middleware('MachineInfo');
        $this->middleware('FullyPaid');
        $this->middleware('isSeller');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $checkSales = Sales::where('date', date('Y-m-d'))->count();
        $result = DB::table('sales')
            ->selectRaw('sum(total_price) as t')
            ->where('date', date('Y-m-d'))
            ->get();
        $medicine_count = Medicine::count();
        $medicine_stocks = Medicine::all();
        $medicine_expires = Medicine::all();
        $sales = DB::table('sales')->join('customers', 'customers.id', '=', 'sales.customer_id')->join('users', 'users.id', '=', 'sales.user_id')
            ->select('sales.code', 'customers.customer_name', 'users.name', 'sales.total_price', 'sales.payment_method', 'sales.created_at', 'sales.id')
            ->orderByDesc('sales.id')
            ->limit(5)
            ->get();
        $medicine_high = DB::table('medicines')
            ->orderByDesc('number_of_sales')
            ->limit(10)
            ->get();

        $medicine_low = DB::table('medicines')
            ->orderBy('number_of_sales', 'ASC')
            ->limit(10)
            ->get();

        $count_all_medicine = DB::table('medicines')->select(DB::raw("SUM(stock) as stock "))->get();

        $countTotalToday = DB::table('sales')
            ->join('sales_details', 'sales_details.sales_id', '=', 'sales.id')
            ->select(DB::raw('SUM(sales_details.quantity) as quantity'))
            ->where('sales.date', date('Y-m-d'))
            ->get();

        $bestSellers = DB::table('sales')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->select(DB::raw('SUM(sales.total_price) as sale'), DB::raw('users.name'), DB::raw('users.image'))
            ->groupBy('sales.user_id')
            ->orderByDesc('sales')
            ->where('sales.date', date('Y-m-d'))
            ->get();
        //  dd($bestSellers);



        ob_start();
        system('ipconfig /all');
        $mycomsys = ob_get_contents();
        ob_clean();
        $find_mac = "Physical";
        $pmac = strpos($mycomsys, $find_mac);
        $macaddress = substr($mycomsys, ($pmac + 36), 17);


        //    dd($macaddress);

        $owing =  DB::table('purchase__owings')
            ->join('purchases', 'purchases.id', '=', 'purchase__owings.purchase_id')
            ->join('suppliers', 'suppliers.id', '=', 'purchases.manufacture')
            ->select('purchases.invoice_number', 'suppliers.company_name', 'purchase__owings.paid_amount', 'purchases.total', 'purchase__owings.id as own_id')
            ->where('purchases.status', false)
            ->get();

        //  dd($owing);



        return view('home', compact('checkSales', 'result', 'medicine_count', 'medicine_expires', 'medicine_stocks', 'sales', 'medicine_high', 'medicine_low', 'count_all_medicine', 'countTotalToday', 'bestSellers', 'owing'));
    }

    public function account()
    {

        $user = Auth::user();
        $settings = Setting::find(1);

        return view('account', compact('user', 'settings'));
    }

    public function updateaccount(UpdateUser $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->file('image')) {

            @unlink(\public_path('/medicine_image/' . $user->image));

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image_name = 'user_image' . time() . '.' . $extension;
            Image::make($file)->resize(200, 200)->save(public_path('/user_images/' . $image_name));
            $user->image = $image_name;
        }

        $user->update();

        return response()->json(['success' => true]);
    }

    public function passwordupdate(Request $request, $id)
    {

        $user = User::find($id);
        $user->password = Hash::make($request->password);

        $user->update();

        return response()->json(['success' => true]);
    }

    public function getLowStock()
    {

        $date = date("Y-m-d");

        $lowStock = DB::table('medicines')
            ->where("stock", "<=", 1)
            ->get();

        return response()->json($lowStock);
    }

    public function purchaseOwing()
    {
        $owing =  DB::table('purchase__owings')
            ->join('purchases', 'purchases.id', '=', 'purchase__owings.purchase_id')
            ->get();

        dd($owing);
    }

    public function pay($id)
    {
        $pay = Purchase_Owing::find($id);


        $payMe = Purchase::find($pay->purchase_id);
        $payMe->status = true;
        $payMe->update();

        $pay->paid_amount = $payMe->total;

        $pay->update();


        return response()->json(['success' => true]);
    }
}
