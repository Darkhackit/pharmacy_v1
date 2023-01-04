<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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

        $users = User::where('id' , '!=',Auth::user()->id)->get();
        $role = Role::pluck('name','id');

        return view('users.index',compact('users','role'));
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
    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password) ;

        if($request->file('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image_name = 'user_image'. time().'.'.$extension;
            Image::make($file)->resize(200,200)->save(public_path('/user_images/'.$image_name));
            $user->image = $image_name;
        }else {

            $user->image = 'default.png';
        }

        $user->save();

        foreach($request->role as $value) {

            $user->attachRole($value);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return response()->json(['user' => $user]);
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
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->edname;
        $user->email = $request->edemail;

        if($request->password) {

            $user->password = Hash::make($request->edpassword) ;
        }
        if($request->file('image')) {

            @unlink(\public_path('/medicine_image/'.$user->image));

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image_name = 'user_image'. time().'.'.$extension;
            Image::make($file)->resize(200,200)->save(public_path('/user_images/'.$image_name));
            $user->image = $image_name;
        }

        $user->update();

        DB::table('role_user')->where('user_id',$id)->delete();
        foreach($request->edrole as $value) {

            $user->attachRole($value);
        }
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
        User::where('id', $id)->delete();

        return response()->json(['success'=> true]);
    }

    public function salPerson()
    {
        $users = User::all();

        // dd($users);
        return view('sales.personnel',compact('users'));
    }

    public function fetchUserSales(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != "" && $request->to_date != "" && $request->customer != '')
            {
                $data = DB::table('sales_details')
                ->join('sales','sales.id','=','sales_details.sales_id')
                ->join('medicines','medicines.id','=','sales_details.medicine_id')
                ->join('users','users.id','=','sales.user_id')
                ->select('sales.code','medicines.name','sales_details.quantity','sales_details.price','sales_details.profit','sales_details.date','users.name as userName')
                ->where('users.id',$request->customer)
                ->whereBetween('sales_details.date',[$request->from_date,$request->to_date])
                ->get();
            }
            else
            {
                $data = DB::table('sales_details')
                ->join('sales','sales.id','=','sales_details.sales_id')
                ->join('medicines','medicines.id','=','sales_details.medicine_id')
                ->join('users','users.id','=','sales.user_id')
                ->select('sales.code','medicines.name','sales_details.quantity','sales_details.price','sales_details.profit','sales_details.date','users.name as userName')
                ->orderBy('sales_details.date','desc')
                ->get();

            }

            return response()->json($data);
        }
    }
}
