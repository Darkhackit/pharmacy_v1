@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Expense Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Expense</a>
                   @endpermission
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">


                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Expense Category</th>
                                        <th>Tax</th>
                                        <th>Description</th>
                                        <th>Note</th>

                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)


                                    <tr>
                                        <td>{{$expense->date}}</td>
                                        <td>₵ {{$expense->amount}}</td>
                                        <td>{{$expense->payment_name}}</td>
                                        <td>{{$expense->expense_name}}</td>
                                        <td>₵ {{$expense->tax}}</td>
                                        <td>{{$expense->description}}</td>
                                        <td>{{$expense->note}}</td>



                                        <td>
                                            @permission(['Unit Edit','All'])
                                            <button class="btn btn-info btn-sm loadCat" id="{{$expense->id}}"><i class="fa fa-pencil"></i></button>
                                            @endpermission
                                            @permission(['Unit Delete','All'])
                                            <form id="deleteCategory" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $expense->id }}">
                                                  <button type="button" id="{{ $expense->id }}" class="btn btn-danger btn-sm deleteCat"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>


                                    @endforeach

                                </tbody>
                                <div class="modal fade text-left" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Edit Category</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" id="CatEdit">
                                                    @csrf
                                                     @method('patch')
                                                     <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                                    <input type="date"   class="form-control" id="date" name="date" placeholder="">
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-calender"></i>
                                                                    </div>
                                                                    <label for="first-name-floating-icon">Date</label>
                                                                    <div class="text-danger" id="derror-date"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                                    <input type="text" id="amount"  class="form-control num" name="amount" placeholder="Enter Amount">
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-money"></i>
                                                                    </div>
                                                                    <label for="first-name-floating-icon">Amount</label>
                                                                    <div class="text-danger" id="derror-amount"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                                   <select name="payment" id="payments" class="form-control">
                                                                        <option id="pay_id">Select Payment Type</option>
                                                                        @foreach ($payments as $payment)
                                                                        <option value="{{ $payment->id }}">{{ $payment->payment_name }}</option>
                                                                        @endforeach

                                                                   </select>
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-fa-briefcase"></i>
                                                                    </div>
                                                                    <label for="first-name-floating-icon">Payment Type</label>
                                                                    <div class="text-danger" id="derror-payment"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                                   <select name="category" id="categorys" class="form-control">
                                                                        <option id="cat_id">Select Category</option>
                                                                        @foreach ($categories as $category)

                                                                        <option value="{{ $category->id }}">{{ $category->expense_name }}</option>
                                                                        @endforeach
                                                                   </select>
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-list-ul"></i>
                                                                    </div>
                                                                    <label for="first-name-floating-icon">Expense Category</label>
                                                                    <div class="text-danger" id="derror-category"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                                  <input type="text" name="tax" id="taxs" class="form-control tax">
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-database"></i>
                                                                    </div>
                                                                    <label for="first-name-floating-icon">Tax</label>
                                                                    <div class="text-danger" id="derror-tax"></div>
                                                                </div>
                                                            </div>



                                                             <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                              <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-fort-awesome"></i>
                                                                    </div>
                                                                    <label for="contact-floating-icon">Description</label>
                                                                    <div class="text-danger" id="derror-description"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-label-group position-relative has-icon-left">
                                                              <textarea name="note" id="note" cols="5" rows="5" class="form-control"></textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="fa fa-file-word-o"></i>
                                                                    </div>
                                                                    <label for="contact-floating-icon">Note</label>
                                                                    <div class="text-danger" id="derror-note"></div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="id" id="catId">

                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary editCate">save</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Expenses</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="CatAdd">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="date"   class="form-control" name="date" placeholder="">
                                    <div class="form-control-position">
                                        <i class="fa fa-calender"></i>
                                    </div>
                                    <label for="first-name-floating-icon">Date</label>
                                    <div class="text-danger" id="error-date"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text"   class="form-control num" name="amount" placeholder="Enter Amount">
                                    <div class="form-control-position">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <label for="first-name-floating-icon">Amount</label>
                                    <div class="text-danger" id="derror-amount"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                   <select name="payment" id="payment" class="form-control">
                                        <option>Select Payment Type</option>
                                        @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}">{{ $payment->payment_name }}</option>
                                        @endforeach

                                   </select>
                                    <div class="form-control-position">
                                        <i class="fa fa-fa-briefcase"></i>
                                    </div>
                                    <label for="first-name-floating-icon">Payment Type</label>
                                    <div class="text-danger" id="error-payment"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                   <select name="category" id="category" class="form-control">
                                        <option>Selext Category</option>
                                        @foreach ($categories as $category)

                                        <option value="{{ $category->id }}">{{ $category->expense_name }}</option>
                                        @endforeach
                                   </select>
                                    <div class="form-control-position">
                                        <i class="fa fa-list-ul"></i>
                                    </div>
                                    <label for="first-name-floating-icon">Expense Category</label>
                                    <div class="text-danger" id="error-category"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                  <input type="text" name="tax" id="tax" class="form-control tax">
                                    <div class="form-control-position">
                                        <i class="fa fa-database"></i>
                                    </div>
                                    <label for="first-name-floating-icon">Tax</label>
                                    <div class="text-danger" id="error-tax"></div>
                                </div>
                            </div>



                             <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                              <textarea name="description" id="" cols="5" rows="5" class="form-control"></textarea>
                                    <div class="form-control-position">
                                        <i class="fa fa-fort-awesome"></i>
                                    </div>
                                    <label for="contact-floating-icon">Description</label>
                                    <div class="text-danger" id="error-description"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                              <textarea name="note" id="" cols="5" rows="5" class="form-control"></textarea>
                                    <div class="form-control-position">
                                        <i class="fa fa-file-word-o"></i>
                                    </div>
                                    <label for="contact-floating-icon">Note</label>
                                    <div class="text-danger" id="error-note"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="code" value="{{ mt_rand() }}">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary addCate">save</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('.num').number(true,2)
    $('.tax').number(true,2)

    $('.addCate').click(function () {

        let form = $('#CatAdd').serialize();
        $('#error-date').html("");
        $('#error-amount').html("");
        $('#error-payment').html("");
        $('#error-category').html("");
        $('#error-tax').html("");
        $('#error-description').html("");
        $('#error-note').html("");
        $.ajax({
            url: "{{ route('expense.store') }}",
            method:'POST',
            data:form,
            success:function (response) {
                toastr.success('Expense Added successfully.', 'Expense Added  successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#addUser').modal('hide');
                    location.reload()

                },2000)

            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.date) {

                       $('#error-date').html(data.errors.date[0])

                    }
                     if(data.errors.amount) {

                       $('#error-amount').html(data.errors.amount[0])

                   }
                   if(data.errors.payment) {

                    $('#error-payment').html(data.errors.payment[0])

                }
                if(data.errors.category) {

                    $('#error-category').html(data.errors.category[0])

                }
                if(data.errors.tax) {

                    $('#error-tax').html(data.errors.tax[0])

                }
                if(data.errors.description) {

                    $('#error-description').html(data.errors.description[0])

                }
                if(data.errors.note) {

                    $('#error-note').html(data.errors.note[0])

                }


                }

            }
        })
    })

    $('.loadCat').click(function () {



        let id = $(this).attr('id');


        $.ajax({
            url:'{{url('/expense')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (response) {

                console.log(response)
               response.forEach(function(i) {

                $('#date').val(i.date)
                $('#amount').val(i.amount)
                $('#taxs').val(i.tax)
                $('#description').val(i.description)
                $('#note').val(i.note)
                $('#catId').val(i.id)

                $('#pay_id').val(i.payment_id)
                $('#pay_id').html(i.payment_name)


                $('#cat_id').val(i.expense_category_id)
                $('#cat_id').html(i.expense_name)



               })



            }
        })
        $('#editCategory').modal('show')
    })

    $('.editCate').click(function () {

        let id = $('#catId').val();
        let form = $('#CatEdit').serialize();
        console.log(form)
        $.ajax({
            url:'{{url('/expense')}}' + '/' + id,
            method:'POST',
            data:form,
            success:function (response) {

                toastr.success('Expense updated successfully.', 'Expense updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#editCategory').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.category_name) {

                       $('#error-edcategory_name').html(data.errors.category_name[0])

                    }
                     if(data.errors.description) {

                       $('#error-eddescription').html(data.errors.description[0])

                   }


                }

            }
        })
    })

    $('.deleteCat').click(function () {
        let tbh = $(this)
        let id = $(this).attr('id');

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

                    url:'{{url('/expense')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteCategory').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tbh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Expense has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                              })
                        }else{
                            Swal.fire({
                                title: 'Error Deleting Category',
                                text:'This category is already associated with some medicines',
                                animation: false,
                                customClass: 'animated shake',
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                              })
                        }

                    }
                })
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                  title: 'Cancelled',
                  text: 'Your imaginary file is safe :)',
                  type: 'error',
                  confirmButtonClass: 'btn btn-success',
                })
              }
    })
    })
</script>

@endsection
