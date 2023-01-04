@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <section id="data-list-view" class="data-list-view-header">
        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">
                <div class="btn-group dropdown actions-dropodown">
                    <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable starts -->
        <div class="table-responsive">
            <table class="table data-list-view">
                <thead>
                    <tr>
                        <th></th>
                        <th>NAME</th>
                        <th>CATEGORY</th>
                        <th>STOCK</th>
                        <th>LAST UPDATE</th>
                        <th>COMMENT</th>
                        <th>UPDATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicines as $medicine)


                    <tr>
                        <td></td>
                        <td class="product-name">{{ $medicine->name }}</td>
                        <td class="product-category">{{ $medicine->category->category_name }}</td>
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
                        <td>
                            {{ date('F j Y',strtotime($medicine->updated_at ))}}
                        </td>
                        <td class="product-price">
                            {{ $medicine->comment }}
                        </td>
                        <td class="product-action">
                            <span class="action-edit" id="{{ $medicine->id }}" medname="{{ $medicine->name }}"><i class="feather icon-edit"></i></span>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- DataTable ends -->

        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">List View Data</h4>
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
</section>

<div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Update Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form id="updateStock">
                   @csrf
                   @method('patch')
                   <div class="form-group">
                       <label for="">Name</label>
                       <input type="text" class="form-control" id="name" readonly>
                   </div>
                   <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="number" min="0" class="form-control" id="quantity" name="quantity">
                </div>
                <input type="hidden" name="id" id="medID">
                <div class="form-group">
                    <label for="">Comment</label>
                   <textarea name="comment" id="comment" cols="5" rows="5" class="form-control"></textarea>
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary updateM" >Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('.action-edit').click(function () {

        let id = $(this).attr('id')
        let name = $(this).attr('medname')

        $('#name').val(name)
        $('#medID').val(id)

        $('#addUser').modal('show')


    })

    $('.updateM').click(function () {

        let id =  $('#medID').val()

        let form = $('#updateStock').serialize();

        $.ajax({
            url:'{{url('stock/update')}}' + '/' + id,
            method:'POST',
            data:form,
            success: function (res) {

                if(res.success == true) {

                    toastr.success('Medicine Updated successfully.', 'Medicine Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                    setTimeout(function () {
                     //   $("#submitMedicine").trigger("reset");
                        location.reload()


                    },2000)
                }
            }
        })
    })
</script>

@endsection
