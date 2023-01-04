@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Purchase Price</th>
                                        <th>Stock</th>
                                        <th>Selling Price</th>
                                        <th>Profit Margin</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicines as $medicine)

                                    <tr>
                                        <td>{{ $medicine->name }}</td>
                                        <td>{{ $medicine->purchase_price }}</td>
                                        <td>{{ $medicine->stock }}</td>
                                        <td>{{ $medicine->selling_price }}</td>
                                        <td></td>
                                    </tr>

                                    @endforeach




                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>
                                            GHC <span class="" style="font-size:20px">{{ $costPrice[0]->p }}</span>
                                        </td>
                                        <td></td>
                                        <td>
                                            GHC <span class="" style="font-size:20px">{{ $sellingPrice[0]->s}}</span>
                                        </td>
                                        <td>
                                            GHC <span class="" style="font-size:20px">{{ $sellingPrice[0]->s -  $costPrice[0]->p }}</span>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



