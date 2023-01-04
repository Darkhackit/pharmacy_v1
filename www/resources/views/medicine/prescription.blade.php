@extends('layouts.app')

@section('content')
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
                    <th>PRICE</th>
                    <th>GENERIC NAME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine)


                <tr>
                    <td></td>
                    <td class="product-name">{{ $medicine->name }}
                        <input type="hidden" name="" value="{{ $medicine->indicator }}">
                    </td>
                    <td class="product-category">{{ $medicine->category->category_name }}
                        <input type="hidden" name="" value="{{ $medicine->missed_dose }}">
                    </td>
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
                            <input type="hidden" name="" value="{{ $medicine->side_effect }}">
                            <div class="chip-body">
                                <div class="chip-text">{{$medicine->stock}}</div>
                            </div>
                        </div>
                        @endif
                    </td>
                    <td>
                        ₵ {{ $medicine->selling_price }}
                        <input type="hidden" name="" value="{{ $medicine->dosage }}">

                    </td>
                    <td class="product-price">{{ $medicine->generic_name }}
                        <input type="hidden" name="" value="{{ $medicine->precaution }}">
                    </td>
                    <td class="product-action">
                        <span id="{{ $medicine->id}}" class="action-edit"><i class="fa fa-eye"></i></span>

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

<div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title medName" id="myModalLabel16"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <section class="app-ecommerce-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5 mt-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src=""  class="img-fluid medPic" alt="product image">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="medName">
                                    </h5>

                                    <div class="ecommerce-details-price d-flex flex-wrap">

                                        <p class="text-primary font-medium-3 mr-1 mb-0 medPrice"></p>

                                    </div>
                                    <hr>
                                    <h1>DOSAGE</h1>
                                    <p class="medDosage"></p>

                                    <hr>
                                    <h1>INDICATOR</h1>
                                    <p class="medIndicator"></p>



                                    <hr>
                                    <p class="medStock"> - <span class="text-success">In stock</span></p>

                                    <hr>

                                </div>
                            </div>
                        </div>
                        <div class="item-features py-5">
                            <div class="row text-center pt-2">
                                <div class="col-12 col-md-4 mb-4 mb-md-0 ">
                                    <div class="w-75 mx-auto">
                                        <i class="feather icon-award text-primary font-large-2"></i>
                                        <h5 class="mt-2 font-weight-bold">MISSED DOSE</h5>
                                        <p class="medmissDose"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i class="feather icon-clock text-primary font-large-2"></i>
                                        <h5 class="mt-2 font-weight-bold">SIDE EFFECT</h5>
                                        <p class="medSide">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i class="feather icon-shield text-primary font-large-2"></i>
                                        <h5 class="mt-2 font-weight-bold">PRECAUTIONS</h5>
                                        <p class="medPrecaution">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
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
    $('.action-edit').click(function () {

        let id = $(this).attr('id')

        $.ajax({

            url:'{{url('/medicine')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function(res) {

                console.log(res.medicine.name)

                $('.medName').html(res.medicine.name)
                $('.medPrice').html('₵' + res.medicine.selling_price)
                $('.medDosage').html(res.medicine.dosage)
                $('.medIndicator').html(res.medicine.indicator)
                $('.medmissDose').html(res.medicine.missed_dose)
                $('.medSide').html(res.medicine.side_effect)
                $('.medPrecaution').html(res.medicine.precaution)
                $('.medPic').attr('src', '{{ asset('medicine_images') }}' + '/' + res.medicine.image)
                $('.medStock').html(res.medicine.stock + ' ' +' <span class="text-success">In stock</span>')
            }
        })

        $('#xlarge').modal('show')
    })
</script>

@endsection



