@extends('layouts.app')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header row">
                <div class="col-md-6">
                    <h4 class="card-title">Medicine Stock Check</h4>
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control" id="date">
                </div>


            </div>
            <form id="checkStockings">
                @csrf
            <div class="card-content">
                <div class="card-body">
                    <table class="table  checkStockTab">
                        <thead>
                            <tr>
                                <th>Medcine</th>

                                <th>Physical Stock</th>

                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody id="maintBody">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        {{ Form::select("medicine[]",$medicine,null,["placeholder"=>"SELECT MEDICINE","class"=>"form-control select2 pnam","name"=>"medicine[]","width"=>"100%"]) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="physicalStock[]" id="" class="form-control">
                                      </div>

                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm btnremove"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::select("medicine[]",$medicine,null,["placeholder"=>"SELECT MEDICINE","class"=>"form-control select2 pnam","name"=>"medicine[]","width"=>"100%"]) }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="physicalStock[]" id="" class="form-control">
                                      </div>

                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm btnremove"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::select("medicine[]",$medicine,null,["placeholder"=>"SELECT MEDICINE","class"=>"form-control select2 pnam","name"=>"medicine[]","width"=>"100%"]) }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="physicalStock[]" id="" class="form-control">
                                      </div>

                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm btnremove"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::select("medicine[]",$medicine,null,["placeholder"=>"SELECT MEDICINE","class"=>"form-control select2 pnam","name"=>"medicine[]","width"=>"100%"]) }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="physicalStock[]" id="" class="form-control">
                                      </div>

                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm btnremove"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::select("medicine[]",$medicine,null,["placeholder"=>"SELECT MEDICINE","class"=>"form-control select2 pnam","name"=>"medicine[]","width"=>"100%"]) }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="physicalStock[]" id="" class="form-control">
                                      </div>

                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm btnremove"><i class="fa fa-trash-o"></i></button></td>
                            </tr>


                        </tbody>

                    </table>
                     <div class="row">
                         <div class="col-md-4">
                            <button type="button" class="btn btn-primary populate">Populate List</button>
                         </div>
                         <div class="col-md-4">
                            <button type="button" class="btn btn-danger reset">Reset Current Stock</button>
                         </div>
                         <div class="col-md-4">
                            <button type="button" class="btn btn-warning update">Update Stock Table</button>
                         </div>


                     </div>

                </div>
            </div>
            </form>
        </div>
    </div>


@endsection
@section('script')

<script>

    let getDate = JSON.parse(localStorage.getItem('date'))

    if(getDate)
    {
        $('#date').val(getDate)
    }
    const str = date => date.toISOString().slice(0, 10);

    $(window).on('load',function () {

        console.log(str(new Date()))
    })

    $('.populate').click(function () {

       console.log( $('.pnam').length)
        if( $('.pnam').length >= 30) return

        $('#maintBody').append(`

        <tr>
            <td>
                <select class="form-control select2 pnam" name="medicine[]">
                    <option>SELECT MEDICINE</option>
                    @foreach($medicines as $medicine)
                    <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                    @endforeach
                </select>

            </td>
            <td>
                <input type="number" name="physicalStock[]" id="" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-danger btnremove btn-sm"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>

        `)

        $('.select2').select2();


    })

    $(document).on('click','.btnremove',function () {

        $(this).closest('tr').remove();


    })

    $(document).on('click','.reset',function () {

        console.log('hi')
        Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reset Current Stock',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
          }).then(function (result) {

            if(result.value) {

                $('#checkStockings').serialize();

                $.ajax({

                   url:'{{url('resetstock')}}',
                   method:'POST',
                   data: $('#checkStockings').serialize(),
                   success:function (response) {

                   if(response.success == true)
                   {
                    Swal.fire({
                        type: "success",
                        text: 'Current Stock Resetted',
                        confirmButtonClass: 'btn btn-success',
                      })
                   }
                   }
                })


            }
    })

})

$(document).on('click','.update',function () {

    Swal.fire({
        title: 'Are you sure ?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update Stock Table',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
      }).then(function (result) {

        $('#checkStockings').serialize();


      //  return console.log($('#checkStockings').serialize())

        $.ajax({

            url:'{{url('updatestockValue')}}',
            method:'POST',
            data: $('#checkStockings').serialize(),
            success:function (response) {

            if(response.success == true)
            {
                stn = str(new Date())
                $('#date').val(str(new Date()))
                window.localStorage.setItem('date',JSON.stringify(stn))
               Swal.fire({
                 type: "success",
                 text: 'Stock Table Updated',
                 confirmButtonClass: 'btn btn-success',
               })
               setTimeout(function () {
                   location.reload()
               },3000)
            }
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR;
                console.log(data.responseJSON)
                toastr.error('ERROR', data.responseJSON.errors.server[0], { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

            }

        })

      })


})



</script>



@endsection
