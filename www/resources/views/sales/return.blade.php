@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-content">
                    <div class="card-body card-dashboard">
                  <form action="" id="editSale">
                        @csrf
                        <div class="table-responsive">
                            <table id="data" class="table table-striped tap">
                                <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>CUSTOMER</th>
                                        <th>SELLER</th>
                                        <th>TOTAL</th>
                                        <th>PAYMENT</th>
                                        <th>MEDICINES</th>
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm btnAdd">Add Return</button>
                                        </th>

                                    </tr>
                                </thead>


                            </table>
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea name="reason" id="reason" cols="5" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-success btn-lg mb-2 submitReturn">Return</button>
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

            $('.btnAdd').hide()


            let html = "";
            html += "<tr>";
            html +='<td>{{ Form::select("code[]",$medicine,null,["placeholder"=>"Select Code","class"=>"form-control select2 pnam","id"=>"code","width"=>"100%"]) }}</td>';
            html +='<td><input type="text" name="customer_id[]" class="form-control customer" id="customer_id" readonly></td>';
            html +='<td><input type="text" name="seller_id[]" class="form-control seller" id="seller_id" readonly></td>';
            html +='<td><input type="text" name="total[]" class="form-control total" id="total" readonly></td>';
            html +='<td><input type="text" name="payment[]"  class="form-control payment" id="payment" readonly></td>';
            html +='<td><select class="select2 form-control medicine" name="medicine[]" style="width:100%" multiple></select></td>';
            html +='<td><center><button id="" name="remove[]" class="btn btn-danger btn-sm btnremove" ><i class="fa fa-times"></i></button></center></td>';
            $('#data').append(html);

            $('.select2').select2();

            $(".tap").delegate('.pnam','change',function () {

                $('select.medicine').html('')
                let code = $(this).val();

                let tr = $(this).parent().parent();

                $.ajax({
                    url:'{{url('/returned/sales')}}' + '/' + code,
                    method:'GET',
                    data:{'code':code},
                    success:function (res) {

                        console.log(res)

                        tr.find(".customer").val(res[0].customer_name)
                        tr.find(".total").val('₵'+''+ res[0].total_price)
                        tr.find(".seller").val(res[0].userName)
                        tr.find(".payment").val(res[0].payment_method)
                        tr.find('.medicine').val(  res.forEach(function (i) {

                            $('select.medicine').append(`

                            <option value="${i.medID}" selected>${i.name}</option>
                            `)

                        }))


                    }
                })




            })




        })

        $(document).on('click','.btnremove',function () {

            $(this).closest('tr').remove();

            $('.btnAdd').show()

        })

        $('.submitReturn').click(function () {

            let form = $('#editSale').serialize();

            if(!$('.medicine').val()) {

                toastr.warning('Select the returned medicine', 'The reason for returning is required', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
            }else {


               $.ajax({

                url:"{{ route('returned.store') }}",
                method:'POST',
                data:form,
                success:function (res) {

                    if(res.success == true) {

                        toastr.success('Medicine returned successfully', 'Medicine returned successfully', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
                        setTimeout(function () {

                            location.reload()
                        },1000)

                    }
                }
               })
            }



        })




    })
</script>

@endsection
