@extends('layouts.app')

@section('content')
<section id="data-thumb-view" class="data-thumb-view-header">
    <div class="action-btns d-none">
        <div class="btn-dropdown mr-1 mb-1">
            <div class="btn-group dropdown actions-dropodown">
                <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                    <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                    <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                    <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
                </div>
            </div>
        </div>
    </div>
    <!-- dataTable starts -->
    <div class="table-responsive">
        <table class="table data-thumb-view tabi">
            <thead>
                <tr>
                    <th></th>
                    <th>Image</th>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>MEDICINE TYPE</th>
                    <th>STOCK</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine)
                <tr>
                    <td></td>
                    <td class="product-img"><img src="{{ asset('medicine_images') }}/{{ $medicine->image }}" alt="{{ $medicine->name }}">
                    </td>
                    <td class="product-name">{{ $medicine->name }}</td>
                    <td class="product-category">{{ $medicine->category->category_name }}</td>
                    <td class="product-category">{{ $medicine->medicine_type->name }}</td>
                    <td>
                        @if($medicine->stock <= 99 && $medicine->stock >= 50 )
                        <div class="chip chip-warning">

                            <div class="chip-body">
                                <div class="chip-text">{{$medicine->stock}}</div>
                            </div>
                        </div>
                        @elseif($medicine->stock <= 49)
                        <div class="chip chip-danger">
                            <div class="chip-body">
                                <div class="chip-text">{{$medicine->stock}}</div>
                            </div>
                        </div>
                        @else
                        <div class="chip chip-success">
                            <div class="chip-body">
                                <div class="chip-text">{{$medicine->stock}}</div>
                            </div>
                        </div>
                        @endif
                    </td>
                    <td class="product-price">₵ {{ $medicine->selling_price }}</td>
                    <td class="product-action">
                        @permission(['Medicine Edit','All'])
                        <span class="action-edit" id="{{$medicine->id}}"><i class="feather icon-edit"></i></span>
                        @endpermission
                        @permission(['Medicine Delete','All'])
                        <form id="deleteMed" style="display:inline">
                            @csrf
                            @method('delete')
                        <span id="{{$medicine->id}}" class="action-delete"><i class="feather icon-trash"></i></span>
                        <input type="hidden" name="id" value="{{ $medicine->id }}">
                    </form>
                    @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- dataTable ends -->

    <!-- add new sidebar starts -->
    <div class="add-new-data-sidebar">
        <div class="overlay-bg"></div>
        <div class="add-new-data">
            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase">Thumb View Data</h4>
                </div>
                <div class="hide-data-sidebar">
                    <i class="feather icon-x"></i>
                </div>
            </div>
            <div class="data-items pb-3">
                <div class="data-fields px-2 mt-3">
                    <div class="row">
                        <div class="col-sm-12 data-field-col">
                            <label for="data-name">Name</label>
                            <input type="text" class="form-control" id="data-name">
                        </div>
                        <div class="col-sm-12 data-field-col">
                            <label for="data-category"> Category </label>
                            <select class="form-control" id="data-category">
                                <option>Audio</option>
                                <option>Computers</option>
                                <option>Fitness</option>
                                <option>Appliance</option>
                            </select>
                        </div>
                        <div class="col-sm-12 data-field-col">
                            <label for="data-status">Order Status</label>
                            <select class="form-control" id="data-status">
                                <option>Pending</option>
                                <option>Canceled</option>
                                <option>Delivered</option>
                                <option>On Hold</option>
                            </select>
                        </div>
                        <div class="col-sm-12 data-field-col">
                            <label for="data-price">Price</label>
                            <input type="text" class="form-control" id="data-price">
                        </div>
                        <div class="col-sm-12 data-field-col data-list-upload">
                            <form action="#" class="dropzone dropzone-area" id="dataListUpload">
                                <div class="dz-message">Upload Image</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                <div class="add-data-btn">
                    <button class="btn btn-primary">Add Data</button>
                </div>
                <div class="cancel-data-btn">
                    <button class="btn btn-outline-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add new sidebar ends -->
</section>


<div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Edit Medicine</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" enctype="multipart/form-data" id="UpdateMedici">
                            @csrf
                            @method('patch')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control " id="code" name="code" placeholder="Barcode">
                                            <div class="text-danger error-barcode"></div>
                                            <label for="first-name-column">Barcode or QrCode</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control required" id="name" name="name" placeholder="Name">
                                            <div class="text-danger error-name"></div>
                                            <label for="last-name-column">Medicine Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control " id="generic" name="generic" placeholder="Generic Name">
                                            <div class="text-danger error-generic"></div>
                                            <label for="city-column">Generic Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control required" id="strength" name="strength" placeholder="Example 2g">
                                            <div class="text-danger error-strength"></div>
                                            <label for="country-floating">Strength</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control required" id="halfLife" name="halfLife" placeholder="Example 2hrs">
                                            <div class="text-danger error-halfLife"></div>
                                            <label for="company-column">Half Life</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="number" class="form-control  required" id="alert_quantity" name="alert_quantity" placeholder="Alert Quantity">
                                            <div class="text-danger error-manDate"></div>
                                            <label for="email-id-column">Alert Quantity</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="date" class="form-control  required" id="expDate" name="expDate" placeholder="Expiration Date">
                                            <div class="text-danger error-expDate"></div>
                                            <label for="email-id-column">Expiry Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control pp required" id="pprice" name="pprice" placeholder="Purchase Price">
                                            <div class="text-danger error-pprice"></div>
                                            <label for="email-id-column">Purchase Price</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="">
                                            <label>Hide Medicine</label>
                                            <input type="checkbox" id="hidden" name="hidden" class="minimal"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control sp required" id="sprice" name="sprice" placeholder="Selling Price">

                                                  <input type="number" class="form-control input-sm newPercentage" min="0" value="40" required>


                                            <div class="text-danger error-sprice"></div>
                                            <input type="checkbox" class="minimal percentage" checked>
                                            Use Percentage

                                            <label for="email-id-column">Retail Price</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control sp required" id="wprice" name="wholesale" placeholder="WholeSale Price">

                                                  <input type="number" class="form-control input-sm wnewPercentage" min="0" value="10" required>


                                            <div class="text-danger error-wprice"></div>
                                            <input type="checkbox" class="minimal wpercentage" checked>
                                            Use Percentage

                                            <label for="email-id-column">WholeSale Price</label>
                                        </div>
                                    </div>

                                  <hr>
                                  <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">Manufacture</label>
                                        <select name="manufacture_id" id="manufacture_id" class="form-control">
                                            <option id="manufact_id"></option>
                                            @foreach ($manufactures as $manufacture)
                                            <option value="{{$manufacture->id}}">{{$manufacture->manufacturer_name}}</option>
                                            @endforeach

                                        </select>
                                            <div class="text-danger error-manufacture_id"></div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Category</label>
                                        <select name="category_id" id="categorys_id" class="form-control custom-select required">
                                            <option id="category_id"></option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach

                                        </select>
                                        <div class="text-danger error-category_id"></div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Supplier</label>
                                        <select name="supply_id" id="supplys_id" class="form-control custom-select required">
                                            <option id="supply_id"></option>
                                            @foreach ($supply as $supp)
                                            <option value="{{$supp->id}}">{{$supp->company_name}}</option>
                                            @endforeach

                                        </select>
                                        <div class="text-danger error-supply_id"></div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Medicine Type</label>
                                        <select name="type_id" id="types_id" class="form-control custom-select required">
                                            <option id="type_id"></option>
                                            @foreach ($type as $typ)
                                            <option value="{{$typ->id}}">{{$typ->name}}</option>
                                            @endforeach

                                        </select>
                                        <div class="text-danger error-type_id"></div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Unit</label>
                                        <select name="unit_id" id="unit_id" class="form-control custom-select required">
                                            <option id="units_id"></option>
                                            @foreach ($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach

                                        </select>
                                        <div class="text-danger error-type_id"></div>

                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" class="newPhotp"  name="image" id="image">
                                    </div>
                                    <p class="help-block">Photo should be maximum of 20mb</p>
                                    <img src="{{ URL::asset('app-assets/images/anonymous.png') }}" class="img-thumbnail previewer" alt="" width="100px" id="premiage">
                                    <input type="hidden" id="realImage">
                                </div>
                                <hr>
                                <div class="col-md-6 col-12">
                                    <div class="form-label-group">

                                        <textarea name="indicator" id="indicator" cols="5" rows="5" class="form-control"></textarea>

                                        <label for="email-id-column">Indicators</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-label-group">

                                        <textarea name="dosage" id="dosage" cols="5" rows="5" class="form-control"></textarea>
                                        <label for="email-id-column">Dosage</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-label-group">

                                        <textarea name="misdosage" id="misdosage" cols="5" rows="5" class="form-control"></textarea>
                                        <label for="email-id-column">Misdosage</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-label-group">

                                        <textarea name="precautions" id="precautions" cols="5" rows="5" class="form-control"></textarea>
                                        <label for="email-id-column">Prcautions</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-label-group">

                                        <textarea name="effect" id="effect" cols="5" rows="5" class="form-control"></textarea>
                                        <label for="email-id-column">Effect</label>
                                    </div>
                                </div>

                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary mr-1 mb-1 updateMed">Update</button>
                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="medicineID">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--  <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
            </div>  --}}
        </div>
    </div>
</div>



@endsection

@section('script')
<script src="{{URL::asset('tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{URL::asset('tinymce/tinymce.min.js')}}"></script>
<script>

    tinymce.init({
        selector: 'textarea#indicator'
      });
      tinymce.init({
        selector: 'textarea#dosage'
      });
      tinymce.init({
        selector: 'textarea#misdosage'
      });
      tinymce.init({
        selector: 'textarea#precautions'
      });
      tinymce.init({
        selector: 'textarea#effect'
      });
</script>
<script>

     // On Edit
  $('.tabi').on("click","span.action-edit",function(){
    // e.stopPropagation();
    // $('#data-name').val('Altec Lansing - Bluetooth Speaker');
    // $('#data-price').val('$99');
    // $(".add-new-data").addClass("show");
    // $(".overlay-bg").addClass("show");
    let id = $(this).attr('id');
     $.ajax({
         url:'{{url('/medicine')}}' + '/' + id,
         method:'GET',
         data:{id:id},
         success: function (feedback) {

            console.log(feedback)

            $('#manufact_id').val(feedback.manufacture[0].id)
            $('#manufact_id').html(feedback.manufacture[0].manufacturer_name)

             $('#category_id').val(feedback.category[0].id)
            $('#category_id').html(feedback.category[0].category_name)

            $('#units_id').val(feedback.unit[0].id)
            $('#units_id').html(feedback.unit[0].name)

             $('#supply_id').val(feedback.supply[0].id)
            $('#supply_id').html(feedback.supply[0].company_name)

            $('#type_id').val(feedback.type[0].id)
            $('#type_id').html(feedback.type[0].name)


            $('#code').val(feedback.medicine.barcode);
            $('#name').val(feedback.medicine.name);
            $('#generic').val(feedback.medicine.generic_name);
            $('#strength').val(feedback.medicine.strength);
            $('#halfLife').val(feedback.medicine.half_life);
            $('#alert_quantity').val(feedback.medicine.alert_quantity);
            $('#expDate').val(feedback.medicine.exDate);
            $('#pprice').val(feedback.medicine.purchase_price);
            $('#sprice').val(feedback.medicine.selling_price);
            $('#medicineID').val(feedback.medicine.id);
            $('#realImage').val(feedback.medicine.image);
            $('#wprice').val(feedback.medicine.wholesale);

            console.log('hidden',feedback.medicine.hidden)

            if(feedback.medicine.hidden == 1) {
                $('#hidden').prop( "checked", true )
            }else {
                $('#hidden').prop( "checked", false )
            }

            if(feedback.medicine.image !== "default.png") {

                $('#premiage').attr('src',"{{ asset('medicine_images') }}" + "/" + feedback.medicine.image)


            }


            tinymce.get("indicator").setContent(feedback.medicine.indicator);
            tinymce.get("dosage").setContent(feedback.medicine.dosage);
            tinymce.get("misdosage").setContent(feedback.medicine.missed_dose);
            tinymce.get("precautions").setContent(feedback.medicine.precaution);
            tinymce.get("effect").setContent(feedback.medicine.side_effect);












         }
     })
    $('#xlarge').modal('show')
  });

  //on Update

     $('#hidden').on('change',function () {
         let id =  $('#medicineID').val();
         $.ajax({
             url:'{{url('/medicine/hidden')}}' + '/' + id,
             method:'GET',
             data:{id:id},
             dataType:'JSON',
             cache:false,
             processData:false,
             contentType:false,
             success: function (feedback) {

                   toastr.success('Medicine Updated successfully.', 'Medicine Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

             }

         })
     })

  $('.updateMed').click(function () {

    let id =  $('#medicineID').val();




  let indicator = tinyMCE.get('indicator').getContent()
  let dosage = tinyMCE.get('dosage').getContent()
  let misdosage = tinyMCE.get('misdosage').getContent()
  let precautions = tinyMCE.get('precautions').getContent()
  let effect = tinyMCE.get('effect').getContent()
 let code = $('#code').val();
 let name = $('#name').val();
 let generic = $('#generic').val();
 let strength = $('#strength').val();
 let half_life = $('#halfLife').val();
 let alert_quantity =  $('#alert_quantity').val();
 let exDate = $('#expDate').val();
 let pprice = $('#pprice').val();
 let sprice = $('#sprice').val();
 let wholesale = $('#wprice').val();
 let medicineID = $('#medicineID').val();
 let  manufacture_id = $('#manufacture_id').val();
 let category_id = $('#categorys_id').val();
 let supply_id = $('#supplys_id').val();
 let types_id = $('#types_id').val();
 let unit_id = $('#unit_id').val();
 let image = $('#image')[0].files[0]


 console.log(image)
  let form = new FormData()
  form.append('code',code);
  form.append('name',name);
  form.append('generic',generic);
  form.append('strength',strength);
  form.append('half_life',half_life);
  form.append('alert_quantity',alert_quantity);
  form.append('expDate',exDate);
  form.append('pprice',pprice);
  form.append('sprice',sprice);
  form.append('wholesale',wholesale);
  form.append('indicator',indicator);
  form.append('dosage',dosage);
  form.append('misdosage',misdosage);
  form.append('precautions',precautions);
  form.append('effect',effect);
  form.append('manufacture_id',manufacture_id);
  form.append('category_id',category_id);
  form.append('supply_id',supply_id);
  form.append('type_id',types_id);
  form.append('unit_id',unit_id);
  if(image !== "" || image !== undefined) {
    form.append('image',image);
  }

  form.append('_token',"{{ csrf_token() }}");
  form.append('_method',"{{ 'patch' }}");

  console.log(form)

    $.ajax({
        url:'{{url('/medicine')}}' + '/' + id,
        method:'POST',
        data:form,
        dataType:'JSON',
        cache:false,
        processData:false,
        contentType:false,
        success: function (feedback) {

            if(feedback.success == true) {

                toastr.success('Medicine Updated successfully.', 'Medicine Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                // setTimeout(function () {
                //  //   $("#submitMedicine").trigger("reset");
                //     location.reload()
                //
                //
                // },2000)
                $('#xlarge').modal('hide')
            }

        }

    })


  })

  // On Delete
    $('.tabi').on("click","span.action-delete",function(e){
    e.stopPropagation();
    let id = $(this).attr('id')
    let tbh = $(this);
    Swal.fire({
        title: 'Are you sure ?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
      }).then(function (result) {

        if(result.value) {

            $.ajax({

                url:'{{url('/medicine')}}' + '/' + id,
                method:'POST',
                data:$('#deleteMed').serialize(),
                success: function (response) {

                    console.log(response)

                    if(response.success == true) {

                        tbh.parents('tr').hide()
                        Swal.fire({
                            type: "success",
                            title: 'Deleted!',
                            text: 'Medicine Type has been deleted.',
                            confirmButtonClass: 'btn btn-success',
                          })
                    }
                }
            })
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Medicine not deleted',
              type: 'error',
              confirmButtonClass: 'btn btn-success',
            })
          }
})
   // $(this).closest('td').parent('tr').fadeOut();
  });


    $('.pp').number(true,2);
    $('.sp').number(true,2);



    $('.newPhotp').change(function () {

        var image = this.files[0];

        //Emmanuel Arthur

        if(image['type'] != 'image/jpeg' && image['type'] != 'image/png') {

            $('.newPhotp').val('');
            Swal.fire({
                title: 'Error uploading Image',
                text:'The file you are uploading is not an image',
                animation: false,
                customClass: 'animated shake',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
              })
        }else if(image['size'] > 20000000) {

            $('.newPhotp').val('');

            Swal.fire({
                title: 'Error uploading Image',
                text:'Image size should be less than 2mb',
                animation: false,
                customClass: 'animated shake',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
              })

        }else {

            var dataImage = new FileReader;

            dataImage.readAsDataURL(image);

            $(dataImage).on('load',function (e) {

                var resultImage = e.target.result

                $('.previewer').attr('src',resultImage)
            })
        }
    })


    $('#sprice , #pprice').change(function () {

        if($(".percentage").prop("checked")){

            var valuePercentage = $(".newPercentage").val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#sprice").val(percentage);
            $("#sprice").prop("readonly",true);
        }
    })

    $(".newPercentage").change(function(){

        if($(".percentage").prop("checked")){

            var valuePercentage = $(this).val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#sprice").val(percentage);
		    $("#sprice").prop("readonly",true);

        }


    })

    $(".percentage").change(function(){

        if(this.checked){

            $("#sprice").prop("readonly",true);
        }else{

            $("#sprice").prop("readonly",false);
        }



    })

    $('#wprice , #pprice').change(function () {

        if($(".wpercentage").prop("checked")){

            var valuePercentage = $(".wnewPercentage").val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#wprice").val(percentage);
            $("#wprice").prop("readonly",true);
        }
    })

    $(".wnewPercentage").change(function(){

        if($(".wpercentage").prop("checked")){

            var valuePercentage = $(this).val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#wprice").val(percentage);
		    $("#wprice").prop("readonly",true);

        }


    })

    $(".wpercentage").change(function(){

        if(this.checked){

            $("#wprice").prop("readonly",true);
        }else{

            $("#wprice").prop("readonly",false);
        }



    })


</script>

@endsection
