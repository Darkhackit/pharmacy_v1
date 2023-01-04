@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-content">
                    <div class="card-body card-dashboard">
                  <form action="" id="wastage">
                        @csrf
                        <div class="table-responsive">
                            <table id="data" class="table table-striped tap">
                                <thead>
                                    <tr>
                                        <th>MEDICINE</th>
                                        <th>MANUFACTURER</th>
                                        <th>STOCK</th>
                                        <th>QUANTITY</th>
                                        <th>WASTAGE TYPE</th>
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm btnAdd">Add Medicine</button>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody id="data">

                                </tbody>


                            </table>
                        </div>

                        <div class="float-right">
                            <button type="button" class="btn btn-success btn-lg mb-2 submitWaste">Add Wastage</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

<script>

    $(document).ready(function () {

        $(document).on('click','.btnAdd',function () {

            let html = "";
            html += "<tr>";
            html +='<td>{{ Form::select("medicine[]",$medicine,null,["placeholder"=>"Select Medicine","class"=>"form-control select2 pnam","id"=>"code","width"=>"100%"]) }}</td>';
            html +='<td><input type="text" name="manufacture[]" class="form-control manufacture" id="manufacture" readonly><input type="hidden" name="manu_id[]" class="form-control manu_id" id="manu_id"></td>';
            html +='<td><input type="text" name="stock[]" class="form-control stock" id="stock" readonly></td>';
            html +='<td><input type="number" name="quantity[]" class="form-control quantity" id="quantity"><input type="hidden" name="purchase[]" class="form-control purchase" id="purchase"></td>';
            html +='<td>{{ Form::select("wastage[]",$wastage,null,["placeholder"=>"Select Wastage Type","class"=>"form-control select2 wastage","id"=>"code","width"=>"100%"]) }}</td>';
            html +='<td><center><button id="" name="remove[]" class="btn btn-danger btn-sm btnremove" ><i class="fa fa-times"></i></button></center></td>';
            $('tbody#data').append(html);
            $('.select2').select2();


            $(".tap").delegate('.pnam','change',function () {

                let id = $(this).val();
                let tr = $(this).parent().parent();

                $.ajax({
                    url:'{{url('/medicine')}}' + '/' + id,
                    method:'GET',
                    data:{'id':id},
                    success:function (res) {

                        tr.find('.manufacture').val(res.manufacture[0].manufacturer_name)
                        tr.find('.stock').val(res.medicine.stock)
                        tr.find('.manu_id').val(res.medicine.manufacturer_id)
                        tr.find('.purchase').val(res.medicine.purchase_price)

                    }
                })




            })

            $('.quantity').on('keyup',function () {

                let qty = parseInt($(this).val())

                let tr = $(this).parent().parent()

                 let stock = parseInt(tr.find('.stock').val()) ;

                if(qty > stock) {

                    Swal.fire({
                        title: 'The quantity entered is not available',

                        animation: false,
                        customClass: 'animated shake',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                      })

                      $(this).val(0)
                }


            })

            $(document).on('click','.btnremove',function () {

                $(this).closest('tr').remove();

            })






        })



        $('.submitWaste').click(function () {

            if($('.quantity').val() != "") {

            let form = $('#wastage').serialize();

            $.ajax({

                url:'{{ route('wastage.store') }}',
                method:'POST',
                data:form,
                success:function (response) {

                    toastr.success('Wastage Added successfully.', 'Wastage Added successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                    setTimeout(function () {

                        $('#addUser').modal('hide');
                        location.reload()

                    },2000)
                }

            })

            }
        })




    })
</script>

@endsection
