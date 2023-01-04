@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                 <h4>Transfer Medicines</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="submitPurchase">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                          <select name="from" id="from" class="form-control select2 pnam" required>
                                                  <option disabled selected>Select Shop</option>
                                                  @foreach ($shops as $shop)
                                                   <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                                  @endforeach

                                          </select>
                                            <label for="first-name-column">FROM</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                          <select name="to" id="to" class="form-control select2 pnam" required>
                                                  <option disabled selected>Select Shop to Transfer To</option>
                                                  @foreach ($shops as $shop)
                                                   <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                                  @endforeach

                                          </select>
                                            <label for="first-name-column">TO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="date" id="date" class="form-control" placeholder="" name="date" required>
                                            <label for="last-name-column">Purchase Date</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                          <select name="mode" id="payment" class="form-control select2" required>
                                              <option disabled>Select Mode</option>
                                                   <option value="sent" selected>Sent</option>
                                                   <option value="recieved">Recieved</option>
                                          </select>
                                            <label for="company-column">Mode</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12" id="payment_date">

                                    </div>


                                    <hr>

                                    <table class="table mb-5 table-striped tab">
                                        <thead>
                                            <tr>
                                                <th>Medicine</th>
                                                <th>Stock/Quantity</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>  <button type="button" class="btn btn-sm btn-info addMed">Add Medicine</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th>Grand Total</th>
                                                <td>
                                                    <input type="number" name="total" id="grandTotal" value="0.00"  class="form-control" readonly>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>


                                    <div class="col-12">
                                        <button type="button" class="mb-1 mr-1 btn btn-primary submitP">Submit</button>

                                    </div>
                                </div>
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

    $(window).on('load',function () {

        toastr.warning('PLEASE MAKE SURE YOU FILL ALL FIELDS.', 'PLEASE MAKE SURE YOU FILL ALL FIELDS.', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 10000 });

    })


    $(document).ready(function () {


        $('#payment').change(function () {

            let payment = $(this).val();

            if(payment == "2")
            {
                $('#payment_date').html(`

                <div class="form-label-group">
                    <input type="date" id="last-name-column" class="form-control" placeholder="" name="payment_date" required>
                    <label for="last-name-column">Payment Date</label>
                     <br>
                    <input type="number" id="last-name-column" class="form-control" placeholder="Paid Amount" name="paid_amount" value="0" required>
                </div>
                `)
            }
            else
            {
                $('#payment_date').html("")
            }
        })



                    $(document).on('click','.addMed',function () {

                        $('tbody#data').append(`

                           <tr>
                               <td>
                                <select class="form-control select2 pnam" name="medicine[]">
                                    <option>SELECT MEDICINE</option>
                                    @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                    @endforeach
                                </select>

                               </td>

                               <td>
                                   <input type="number" name="stock[]" class="form-control stock" readonly required>
                               </td>
                               <td>
                                   <input type="number" name="quantity[]" class="form-control quantity" required>
                               </td>
                               <td>
                                   <input type="hidden" name="purchase_price[]" class="form-control pprice" required>
                               </td>
                               <td>
                                <input type="hidden" name="newPrice[]" class="form-control newPrice" required>
                            </td>
                               <td>
                                   <input type="number" name="netTotal[]" class="form-control netTotal" value="0.00" readonly required>
                               </td>

                               <td>
                                   <button type="button" class="btn btn-danger btn-sm btnremove">&times;</button>
                               </td>
                           </tr>
                        `)



                        $('.select2').select2();
                    })



                    $(".tab").delegate('.pnam','change',function () {


                        var id = this.value;
                        var tr = $(this).parent().parent();
                        console.log(id)

                        $.ajax({
                            url:'{{url('/medicine')}}' + '/' + id,
                            method:'GET',
                            data:{id,id},
                            success:function (response) {

                                console.log(response.medicine)
                                tr.find('.stock').val(response.medicine.stock)
                                tr.find('.pprice').val(response.medicine.purchase_price)
                                tr.find('.newPrice').val(response.medicine.selling_price)
                            }
                        })



                        $('.quantity').on('keyup',function () {

                            var qty = $(this);
                            console.log(qty.val())
                            var tr = $(this).parent().parent();

                            let mode = $('#payment').val()

                            console.log(mode)

                            let stock = parseFloat(tr.find('.stock').val())

                            let manuPrice = tr.find('.newPrice').val()

                            if(mode == 'sent')
                            {
                                if(parseFloat(qty.val()) > stock) {

                                    console.log('Peace')
                                Swal.fire({
                                    title: 'The quantity entered is not available',

                                    animation: false,
                                    customClass: 'animated shake',
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })

                                $(this).val(0)
                                }
                            }




                            tr.find('.netTotal').val(parseFloat(qty.val() * manuPrice))

                            sumAll()

                        })

                        function sumAll() {
                            var sumPriceArray = [];

                            let priceItem = $('.netTotal')

                            for(var i = 0 ; i < priceItem.length; i++) {

                                sumPriceArray.push(parseFloat($(priceItem[i]).val()))

                            }

                                function sumArrayPrices(total , number) {

                                    return total + number;

                                }
                                var sumArrayPrice = sumPriceArray.reduce(sumArrayPrices)

                                $('#grandTotal').val(sumArrayPrice)

                        }

                        $(document).on('click','.btnremove',function () {

                            $(this).closest('tr').remove();
                            sumAll()

                        })


                    })



                    $('.submitP').click(function () {

                        let form = $('#submitPurchase').serialize()
                        let from = $('#from').val()
                        let to = $('#to').val()
                        let date = $('#date').val()
                        let payment = $('#payment').val()
                        let pnam = $('.pnam').val()

                        if(from == '' || to == '' || date == '' || payment == null || pnam == null || pnam == '')
                        {

                            return     toastr.warning('PLEASE MAKE SURE YOU FILL ALL FIELDS.', 'PLEASE MAKE SURE YOU FILL ALL FIELDS.', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 10000 });
                        }




                     $.ajax({

                       url:"{{ route('transfer.store') }}",
                        method:'POST',
                        data:form,
                        success:function (response) {


                            if(response.error)
                            {
                                toastr.warning(`${response.error}`, `${response.error}`, { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 10000 });
                            }

                           if(response.success == true) {

                            toastr.success('Medicine Transfered successfully.', 'Medicine Transfered successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                            setTimeout(function () {

                                location.reload()

                          },1000)
                           }
                        },
                        error: (jqXHR,textStatus , errorThrown) => {


                            data = jqXHR.responseJSON;
                            console.log(data.message)
                            toastr.warning(`${data.message}`, `${data.message}`, { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 10000 });
                            // if(data.errors) {
                            // if(data.errors.name) {

                            //     $('#error-edcategory_name').html(data.errors.name[0])

                            //     }
                            //     if(data.errors.description) {

                            //     $('#error-eddescription').html(data.errors.description[0])

                            // }


                            // }

                        }
                      })

                    })


        $('.select2').select2();


    })
</script>

@endsection
