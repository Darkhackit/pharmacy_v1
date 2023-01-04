@extends('layouts.app')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Medicine Report</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>Medcine</th>
                                <th>Stock</th>
                                <th>Quantity Bought</th>
                                <th>Profit Made</th>
                                <th>Last Purchased</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($DayMed as $medicine)


                            <tr>
                                <td>{{ $medicine->name }}</td>
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

                                    @if($medicine->quantity == null)

                                     {{ '0' }}
                                    @else


                                    <span>{{ $medicine->quantity }}</span>
                                    <div class="progress progress-bar-success mt-1 mb-0">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="{{ $medicine->quantity }}" aria-valuemin="0" aria-valuemax="{{ $medicine->quantity + $medicine->stock }}"></div>
                                    </div>



                                    @endif

                                </td>
                                <td>
                                    @if($medicine->profit == null)

                                    ₵ {{ '0' }}
                                    @else

                                    ₵ {{ $medicine->profit }}

                                    @endif


                                </td>
                                <td>
                                    @if($medicine->quantity == null)
                                      {{ 'No purchase yet' }}
                                    @else
                                     {{ date('F j Y',strtotime($medicine->most_p  ))}}

                                     @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')



@endsection
