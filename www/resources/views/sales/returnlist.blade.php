@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   <a href="{{ route('sales.return') }}" class="btn btn-primary">Return Medicine</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Sales Code</th>
                                        <th>Medicine</th>
                                        <th>Quantity</th>
                                        <th>Customer</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($returnLists as $return)


                                    <tr>
                                        <td>{{ $return->sales_id }}</td>
                                        <td>{{ $return->name }}</td>
                                        <td>{{ $return->medicine_quantity }}</td>
                                        <td>{{ $return->customer_name }}</td>
                                        <td>{{ $return->reason }}</td>
                                        <td>{{ date('F j Y',strtotime($return->date  ))}}</td>
                                        <td>
                                            <button id="{{ $return->returnID }}" class="btn btn-info btn-sm btnView"><i class="fa fa-eye"></i></button>
                                            @permission(['Sale Delete','All'])
                                            <form id="deleteCategory" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $return->returnID  }}">
                                                  <button type="button" id="{{ $return->returnID }}" class="btn btn-danger btn-sm btnDel"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission

                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

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
                <h4 class="modal-title" id="myModalLabel17">Reason</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div id="reason">

               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('.btnView').click(function () {

        let id = $(this).attr('id');

        $.ajax({

            url:'{{url('returned/reason')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (res) {

                res.forEach(function (i) {

                   $('#reason').html(i.reason)
                })
            }
        })

        $('#addUser').modal('show')
    })

    $('.btnDel').click(function () {

        let tdh = $(this);
        let id = $(this).attr('id');

        console.log(id)

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

                    url:'{{url('returned/reason')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteCategory').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tdh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Returns has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                              })
                        }else {
                            Swal.fire({
                                title: 'Error Deleting Sale',
                                text:'This Sale is already associated with some medicines',
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
