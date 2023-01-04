@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profoma &nbsp; <span> sales Made : ₵
                @foreach ($bestSellers as $bestSeller)
                    {{ $bestSeller->sale }}
                @endforeach
                </span></h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical fromSale" id="formSales" action="{{ route('sales.pdf') }}" method="POST" target="_blank">
                        @csrf
                        <div class="form-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="position-relative ">
                                            <input type="text" id="seller" class="form-control" value="{{ Auth::user()->name }}" name="seller_name" placeholder="" readonly>
                                            <input type="hidden" name="seller" value="{{ Auth::user()->id  }}">
                                            {{-- <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" id="code" class="form-control" name="code" value="{{ mt_rand() }}" placeholder="" readonly>
                                            {{-- <div class="form-control-position">
                                                <i class="feather icon-mail"></i>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="position-relative ">
                                           <select name="customer" id="customer" class="form-control">
                                               @foreach ($customers as $customer)
                                               <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                               @endforeach
                                           </select>
                                            {{-- <div class="form-control-position">
                                                <i class="fa fa-users"></i>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group newProduct">
                            </div>

                            <hr>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Discount</label>
                                        <div class="position-relative ">
                                            <input type="number" id="discount" class="form-control discount"  name="discount" placeholder="%" >
                                            <input type="hidden" name="discountPrice" id="discountPrice">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Tax</label>
                                        <div class="position-relative ">
                                            <input type="number" id="tax" class="form-control"  name="" placeholder="%" >
                                            {{-- <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div> --}}
                                            <input type="hidden" name="taxPrice" id="taxPrice">
                                            <input type="hidden" name="netPrice" id="netPrice">
                                            <input type="hidden" name="type" value="Profoma">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <label for="">Total</label>
                                            <input type="text" id="total" class="form-control" name="total"  total="" placeholder="0.00" readonly required>
                                            {{-- <div class="form-control-position">
                                                <i class="feather icon-mail"></i>
                                            </div> --}}
                                        </div>
                                        <input type="hidden" name="totalSales" id="totalSales" required>
                                    </div>
                                </div>
                            </div>

                                <hr>
                                <div class="form-row form-inline input-group">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="position-relative ">
                                               <select name="payment" id="payment" class="form-control">
                                                    <option value="">Select Payment</option>
                                                   <option value="cash">Cash</option>
                                                   <option value="momo">Mobile Money</option>
                                                   <option value="cc">Credit Card</option>

                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paymentBox "></div>
                                </div>
                                <input type="hidden" name="PaymentMethod" id="listPaymentMethod" required>
                                <input type="hidden" name="paidAmount" id="paidAmount" required>
                                <input type="hidden" name="due" id="due" required>
                                <div class="form-row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                         <button type="button" class="btn btn-success btnSaveSales">Save</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                </div>

                <div class="card-content">
                    <div class="card-body">
                        <section id="data-list-view" class="data-list-view-header">
                            <div class="action-btns d-none">

                            </div>

                            <!-- DataTable starts -->
                            <div class="table-responsive">
                                <table class="table data-list-view salesTable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>BARCODE</th>
                                            <th>IMAGE</th>
                                            <th>NAME</th>
                                            <th>STOCK</th>
                                            <th>PRICE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medicines as $medicine)


                                        <tr>
                                            <td></td>
                                            <td class="product-name">{{ $medicine->barcode }}</td>
                                            <td class=""><img src="{{ asset('medicine_images') }}/{{ $medicine->image }}" alt="{{ $medicine->name }}" width="50px"></td>
                                            <td>
                                               {{$medicine->name}}
                                            </td>
                                            <td>
                                                @if($medicine->stock <= 99 && $medicine->stock >= 50 )
                                                <div class="chip chip-warning">
                                                    <div class="chip-body">
                                                        <div class="chip-text mainStock" proId="{{ $medicine->id }}">{{$medicine->stock}}</div>
                                                    </div>
                                                </div>
                                                @elseif($medicine->stock <= 49)
                                                <div class="chip chip-danger">
                                                    <div class="chip-body">
                                                        <div class="chip-text mainStock" proId="{{ $medicine->id }}">{{$medicine->stock}}</div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="chip chip-success">
                                                    <div class="chip-body">
                                                        <div class="chip-text mainStock" proId="{{ $medicine->id }}">{{$medicine->stock}}</div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td class="product-price">₵ {{ $medicine->selling_price }}</td>
                                            <td class="product-price">
                                                <button type="button" product_id="{{ $medicine->id }}" class="btn btn-icon rounded-circle btn-success mr-1 mb-1 addMedicine readd recover" id="{{ $medicine->id }}"><i class="fa fa-shopping-cart"></i></button>
                                            </td>


                                       </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </section>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection

@section('script')

<script>

    $('.salesTable tbody').on('click','button.addMedicine',function () {

        let id = $(this).attr('id');

        $(this).removeClass('addMedicine btn-success').addClass('btn-default');

        $.ajax({

            url:'{{url('medicine')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (res) {

                let productName = res.medicine.name;
                let productStock = res.medicine.stock;
                let productId = res.medicine.id;
                let productSellingPrice = res.medicine.selling_price;
                let productPurchasePrice = res.medicine.purchase_price;

                if(productStock <= 0) {

                    Swal.fire({
                        title: 'Cant Add Medicine',
                        text:`${productName} is out of stock`,
                        animation: false,
                        customClass: 'animated shake',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                      })

                      $("button[product_id='"+productId+"']").addClass('btn-success addMedicine');

                      return;
                }

                $('.newProduct').append(`

                <div class="form-row">
                    <div class="col-md-1">
                        <button type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1 removeProduct" product_id="${productId}"><i class="fa fa-trash-o"></i></button>
                    </div>
                    <div class="col-md-5 ">
                        <div class="input-group">
                                <input type="text" id="password-icon" class="form-control" name="profuctName[]"  value="${productName}" placeholder="" readonly>
                            </div>

                    </div>
                    <div class=" col-md-2">
                        <div class="input-group">
                            <input type="number" class="form-control productQuantity" value="1" proId="${productId}" stock="${productStock}" newStock="${parseFloat(productStock - 1)}" name="quantity[]" id="quantity">
                        </div>
                    </div>

                    <input type="hidden" name="stock[]" value="${productStock}">
                    <input type="hidden" name="proID[]" value="${productId}">
                    <div class="col-3 increasePrice">
                        <div class="input-group">
                                <input type="hidden" name="mainProfit[]" class="mainProfit" value="${productSellingPrice}">
                                <input type="hidden" name="purchasePrice[]" class="purchase" value="${productPurchasePrice}">
                                <input type="text" id="price" class="form-control productPrice" realPrice="${productSellingPrice}" name="price[]" value="${productSellingPrice}" placeholder="" readonly>

                        </div>
                    </div>
                </div>
                `)



                sumTotalPrice()
                addTax()
                discount()

                $('.productPrice').number(true,2);
            }
        })
    })
    let  removeProductId = [];
    $('.salesTable').on('draw.dt',function () {

        if(localStorage.getItem("removeProduct") != null) {

            var productIdList = JSON.parse(localStorage.getItem("removeProduct"))

            for (var i = 0;i < productIdList.length; i++) {

                $('button.recover[product_id="'+productIdList[i]["product_id"]+'"]').removeClass('btn-default')
                $('button.recover[product_id="'+productIdList[i]["product_id"]+'"]').addClass('btn-success addMedicine')


            }
        }
    })




    localStorage.removeItem("removeProduct")

    $('.fromSale').on('click','button.removeProduct',function () {

        $(this).parent().parent().remove();

        var productId =  $(this).attr('product_id')

        if(localStorage.getItem("removeProduct") == null) {

            removeProductId = [];
         }else {

            removeProductId.concat(localStorage.getItem("removeProduct"))
         }

         removeProductId.push({'product_id':productId});

        localStorage.setItem("removeProduct",JSON.stringify(removeProductId))


        $('button.recover[product_id="'+productId+'"]').removeClass('btn-default')
        $('button.recover[product_id="'+productId+'"]').addClass('btn-success addMedicine')

        if($('.newProduct').children().length == 0) {

            $('#total').val(0)
            $('#totalSales').val(0)
            $('#tax').val(0)
            $('#total').attr('total',0)

          }else{

            sumTotalPrice()
            addTax()
            discount()

          }



    })


    let stockProId = []

    $('.salesTable').on('draw.dt',function () {

        if(localStorage.getItem("stockProduct") != null) {

            var proId = JSON.parse(localStorage.getItem("stockProduct"))

            for (var i = 0;i < proId.length; i++) {

                $('.mainStock[proId="'+proId+'"]').html(newStock)

            }
        }
    })

    localStorage.setItem('stockProduct',JSON.stringify(stockProId))
    $('.fromSale').on('change','input.productQuantity', function () {

        let price = $(this).parent().parent().siblings('.increasePrice').children().children('.productPrice');
        let purchase = $(this).parent().parent().siblings('.increasePrice').children().children('.purchase');
        let finalPrice = $(this).val() * price.attr('realPrice')
        price.val(finalPrice)

        var newStock = parseFloat($(this).attr('stock')) - $(this).val();

        let proId = $(this).attr('proId')

        if(localStorage.getItem("stockProduct") == null) {

            stockProId = [];
         }else {

            stockProId.concat(localStorage.getItem("stockProduct"))
         }

         stockProId.push({'proId':proId});

         localStorage.setItem("stockProduct",JSON.stringify(stockProId))

        $('.mainStock[proId="'+proId+'"]').html(newStock)

        $(this).attr('newStock',newStock);

        if(parseInt($(this).val()) > parseInt($(this).attr('stock'))) {

            Swal.fire({
                title: 'The quantity entered is not available',

                animation: false,
                customClass: 'animated shake',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
              })

            $(this).val(1);

            var priceFinal = $(this).val() * price.attr('realPrice')

            price.val(priceFinal)

            sumTotalPrice()
            addTax()
            discount()


        }

        sumTotalPrice()
        addTax()
        discount()

    })

    function sumTotalPrice() {

        var priceItem = $('.productPrice')
        var purchase = $('.purchase')

        var sumPurchase = [];
        var sumPriceArray = [];

        for(var i = 0 ; i < purchase.length; i++) {

            sumPurchase.push(parseFloat($(purchase[i]).val()))

        }

        for(var i = 0 ; i < priceItem.length; i++) {

            sumPriceArray.push(parseFloat($(priceItem[i]).val()))

        }

        function sumArrayPrices(total , number) {

            return total + number;

        }
        var sumArrayPurchases = sumPurchase.reduce(sumArrayPrices)



        var sumArrayPrices = sumPriceArray.reduce(sumArrayPrices)

      $('#total').val(sumArrayPrices)
      $('#totalSales').val(sumArrayPrices)
      $('#total').attr('total',sumArrayPrices)

    }



    function addTax() {

        let tax = $('#tax').val()

        let totalPrice = $('#total').attr('total')

        let taxTotal = parseFloat(totalPrice * tax/100);

        let totalTax = parseFloat(taxTotal) + parseFloat(totalPrice)

        $('#total').val(totalTax);

        $('#taxPrice').val(taxTotal)
        $('#netPrice').val(totalPrice)
      }

      function discount() {

        let dis = $('#discount').val()

        let totalPrice = $('#total').attr('total')

        let discountTotal = parseFloat(totalPrice * dis/100);

        let totalDiscount =  parseFloat(totalPrice) - parseFloat(discountTotal)

        $('#total').val(totalDiscount);
        $('#discountPrice').val(discountTotal)
        $('#netPrice').val(totalPrice)

      }

      $('#discount').change(function () {
        discount();
      })

      $('#tax').change(function () {

        addTax();
    })

    $('#payment').change(function () {

        let method = $(this).val();

        if(method == 'cash') {


                      $(this).parent().parent().parent().removeClass('col-md-6');
                      $(this).parent().parent().parent().addClass('col-md-4');
                      $(this).parent().parent().parent().parent().children('.paymentBox').html(`

                    <div class="col-md-3">
                        <div class="form-group">
                                <input type="text" id="cashValue" class="form-control cashValue" placeholder="0.00" >
                        </div>
                    </div>
                    <div class="col-md-3 changofeValue">
                        <div class="form-group">
                                <input type="text" id="changeValue" class="form-control changeValue"  total="" placeholder="0.00" readonly>
                        </div>
                    </div>
                      `)





        }else{

            $(this).parent().parent().parent().removeClass('col-md-6');
            $(this).parent().parent().parent().addClass('col-md-4');
            $(this).parent().parent().parent().parent().children('.paymentBox').html(`

          <div class="col-md-4">
              <div class="form-group">
                      <input type="text" id="transactionCode" class="form-control transactionCode"   placeholder="Transaction code" >
              </div>
          </div>

          `)

        }

        $('.cashValue').number(true,2);
        $('.changeValue').number(true,2);

        listMethods()
    })

    $(".fromSale").on("change", "input.transactionCode", function(){

        // List method in the entry
         listMethods()


    })


    $('.fromSale').on('keyup','input.cashValue',function () {

        var money = $(this).val()

        $('#paidAmount').val(money)

        var change = parseFloat(money)  - parseFloat($('#total').val())

        $('#due').val(change)

        var cashChange = $(this).parent().parent().parent().children('.changofeValue').children().children('.changeValue')

        cashChange.val(change)



     })
     $('#total').number(true,2);

     function listMethods(){

        var listMethods = "";

        if($("#payment").val() == 'cash'){

            $("#listPaymentMethod").val("cash");

        }else{

         $("#listPaymentMethod").val($("#payment").val()+"-"+$("#transactionCode").val());

        }

    }

    $('.btnSaveSales').click(function () {

        let form = $('#formSales').serialize();


        let pri = JSON.stringify(form)

        $.ajax({
            url:"{{ route('sales.store') }}",
            method:'POST',
            data:form,
            success:function (res) {

                if(res.success == true) {

                    $('#formSales').submit()


                  //  window.location.href = '{{url('createpdf')}}' + '/' + pri
                   toastr.success('Sales created successfully.', 'Sales updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                   setTimeout(function () {

                       location.reload()

                  },5000)
                 //$('.newProduct').children().remove();

                // $('#formSales').trigger('reset');


                }
            }
        })
    })
</script>

@endsection


