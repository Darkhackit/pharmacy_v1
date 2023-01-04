<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Manufacturer;
use App\Medicine;
use App\MedicineType;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class MedicineController extends Controller
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
        if(auth()->user()->email == "alicegodwill7@gmail.com") {
            $medicines = Medicine::where('hidden',false)->orderBy('name', 'asc')->get();
        }else {
            $medicines = Medicine::orderBy('name', 'asc')->get();
        }
        $manufactures = Manufacturer::all();
        $categories = Category::all();
        $supply = Supplier::all();
        $type = MedicineType::all();
        $units = Unit::all();

        return view('medicine.index', compact('medicines', 'manufactures', 'categories', 'supply', 'type', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacture = Manufacturer::pluck('manufacturer_name', 'id');
        $category = Category::pluck('category_name', 'id');
        $supply = Supplier::pluck('company_name', 'id');
        $type = MedicineType::pluck('name', 'id');
        $unit = Unit::pluck('name', 'id');
        return view('medicine.create', compact('manufacture', 'category', 'supply', 'type', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMedicineRequest $request)
    {
        $medicine = new Medicine();
        $medicine->name = $request->name;
        $medicine->barcode = $request->code;
        $medicine->generic_name = $request->generic;
        $medicine->strength = $request->strength;
        $medicine->half_life = $request->halfLife;
        $medicine->manDate = $request->manDate;
        $medicine->exDate = $request->expDate;
        $medicine->stock = $request->stock;
        $medicine->purchase_price = $request->pprice;
        $medicine->selling_price = $request->sprice;
        $medicine->manufacturer_id = $request->manufacture_id;
        $medicine->supplier_id = $request->supply_id;
        $medicine->category_id = $request->category_id;
        $medicine->medicine_type_id = $request->type_id;
        $medicine->indicator = $request->indicator;
        $medicine->missed_dose = $request->misdosage;
        $medicine->dosage = $request->dosage;
        $medicine->precaution = $request->precautions;
        $medicine->side_effect = $request->effect;
        $medicine->unit_id = $request->unit_id;
        $medicine->wholesale = $request->wholesale;

        if ($request->file('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image_name = 'medicine_image' . time() . '.' . $extension;
            Image::make($file)->resize(200, 200)->save(public_path('/medicine_images/' . $image_name));
            $medicine->image = $image_name;
        } else {

            $medicine->image = 'default.png';
        }

        $medicine->save();

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
        $medicine = Medicine::find($id);
        $category = Category::where('id', $medicine->category_id)->get();
        $type = MedicineType::where('id', $medicine->medicine_type_id)->get();
        $manufacture = Manufacturer::where('id', $medicine->manufacturer_id)->get();
        $supply = Supplier::where('id', $medicine->supplier_id)->get();
        $unit = Unit::where('id', $medicine->unit_id)->get();

        return response()->json(['medicine' => $medicine, 'category' => $category, 'type' => $type, 'manufacture' => $manufacture, 'supply' => $supply, 'unit' => $unit]);
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
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->barcode = $request->code;
        $medicine->name = $request->name;
        $medicine->generic_name = $request->generic;
        $medicine->strength = $request->strength;
        $medicine->half_life = $request->half_life;
        $medicine->manDate = $request->manDate;
        $medicine->exDate = $request->expDate;
        $medicine->purchase_price = $request->pprice;
        $medicine->selling_price = $request->sprice;
        $medicine->manufacturer_id = $request->manufacture_id;
        $medicine->supplier_id = $request->supply_id;
        $medicine->category_id = $request->category_id;
        $medicine->medicine_type_id = $request->type_id;
        $medicine->indicator = $request->indicator;
        $medicine->missed_dose = $request->misdosage;
        $medicine->dosage = $request->dosage;
        $medicine->precaution = $request->precautions;
        $medicine->side_effect = $request->effect;
        $medicine->unit_id = $request->unit_id;
        $medicine->wholesale = $request->wholesale;


        if ($request->file('image')) {

            @unlink(\public_path('/medicine_image/' . $medicine->image));

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image_name = 'medicine_image' . time() . '.' . $extension;
            Image::make($file)->resize(200, 200)->save(public_path('/medicine_images/' . $image_name));
            $medicine->image = $image_name;
        }

        $medicine->save();

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
        Medicine::where('id', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function stock()
    {

        $medicines = Medicine::orderBy('name', 'asc')->get();

        return view('medicine.stock', compact('medicines'));
    }

    public function updatestock(Request $request, $id)
    {

        $medicine = Medicine::find($id);
        $medicine->stock = $medicine->stock + $request->quantity;
        $medicine->comment = $request->comment;

        $medicine->update();

        return response()->json(['success' => true]);
    }

    public function expire()
    {
        if(auth()->user()->email == "alicegodwill7@gmail.com") {
            $medicines = Medicine::where('hidden',false)->orderBy('name', 'asc')->get();
        }else {
            $medicines = Medicine::all();
        }



        return view('medicine.expire', compact('medicines'));
    }

    public function prescription()
    {

        $medicines = Medicine::all();

        return view('medicine.prescription', compact('medicines'));
    }

    public function reportMedicine()
    {

        $DayMed = DB::table('medicines')
            ->leftJoin('sales_details', 'sales_details.medicine_id', '=', 'medicines.id')
            ->leftJoin('wastages', 'wastages.medicine', '=', 'medicines.id')
            ->select(DB::raw("medicines.name,SUM(sales_details.quantity) as quantity,medicines.stock,medicines.created_at,SUM(sales_details.profit) as profit,medicines.most_p,SUM(wastages.quantity) as wasteQuant,wastages.purchase_price as lose"))
            ->orderByDesc('sales_details.date')
            ->groupBy("medicines.id")
            ->get();

        // dd($DayMed);



        return view('medicine.report', compact('DayMed'));
    }

    public function checkStock()
    {
        $medicines = Medicine::all();
        $medicine = Medicine::pluck('name', 'id');
        return view('medicine.checkStock', compact('medicines', 'medicine'));
    }

    public function resetstock(Request $request)
    {
        $medicines = Medicine::where('name', '!=', null)->get();

        foreach ($medicines as $medicine) {
            $medicine->stock = 0;

            $medicine->update();
        }

        return response()->json(['success' => true]);
    }

    public function updatestockValue(Request $request)
    {
        $this->validate($request, [
            'physicalStock' => 'required|array',
            'medicine' => 'required|array',
        ]);

        $medicine = $request->medicine;
        $physicalStock = $request->physicalStock;

        for ($i = 0; $i < count($medicine); $i++) {

            $med = Medicine::find($medicine[$i]);

            $med->stock = $physicalStock[$i];

            $med->update();
        }

        return response()->json(['success' => true]);
    }

    public function hidden($id)
    {
//        dd($id);
        $medicine = Medicine::where('id',$id)->first();
        if($medicine->hidden) {
            $medicine->hidden = false;
        }else {
            $medicine->hidden = true;
        }
        $medicine->update();

        return response()->json(['success' => true]);
    }
}
