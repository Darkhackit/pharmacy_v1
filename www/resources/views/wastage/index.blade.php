@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   <a href="{{ route('wastage.create') }}"  class="btn btn-primary">Add Wastage</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Manufacturer</th>
                                        <th>Quantity</th>
                                        <th>Waste Type</th>
                                        <th>Lose</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wastages as $wastage)

                                    @php
                                        $lose = (float)$wastage->quantity * (float)$wastage->purchase_price
                                    @endphp

                                    <tr>
                                        <td>{{ $wastage->medName }}</td>
                                        <td>{{ $wastage->manufacturer_name }}</td>
                                        <td>{{ $wastage->quantity }}</td>
                                        <td>{{ $wastage->wasteName }}</td>
                                        <td>₵ {{ $lose }}</td>
                                        <td>{{ $wastage->date }}</td>
                                        <td>
                                            @permission(['Wastage Delete','All'])
                                            <form id="deleteCategory" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $wastage->id }}">
                                                  <button type="button" id="{{ $wastage->id }}" class="btn btn-danger btn-sm deleteCat"><i class="fa fa-trash-o"></i></button>

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

@endsection

@section('script')

<script>
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

                    url:'{{url('/wastage')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteCategory').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tbh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Wastage has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                              })
                        }else {
                            Swal.fire({
                                title: 'Error Deleting Unit',
                                text:'This Unit is already associated with some medicines',
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
                  text: 'Wastage is safe :)',
                  type: 'error',
                  confirmButtonClass: 'btn btn-success',
                })
              }
    })
    })
</script>


@endsection


