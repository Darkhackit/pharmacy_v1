@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                 <div class="row">
                     <div class="col-8">
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" name="from_date" id="from_date" readonly>
                            <div  class="input-group-append">to</div>
                            <input type="text" class="form-control" name="to_date" id="to_date" readonly>
                        </div>
                         <div class="col-md-6 col-12 mt-2">
                             <div class="form-label-group">
                                 <select name="medicine_id" id="medicine_id" class="form-control select2 pnam" >
                                     <option value="">All Medicines</option>
                                          @foreach ($medicines as $medicine)
                                              <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                          @endforeach
                                 </select>
                                 <label for="first-name-column">Select Medicine</label>
                             </div>
                         </div>
                     </div>

                     <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
                     </div>
                     <div class="col-md-2">
                        <button type="button" name="refresh" id="refresh" class="btn btn-warning">Refresh</button>
                     </div>
                 </div>

                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <p class="mb-1"><strong>Records:</strong> <span id="total_records">0</span></p>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered filterTable">
                                <thead>
                                    <tr>
                                        <th>Sales ID</th>
                                        <th>Medicine Name</th>
                                        <th>Customer</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Price (&#8373;)</th>
                                        <th class="text-right">Profit (&#8373;)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold">
                                        <th colspan="4" class="text-right">TOTAL SALES:</th>
                                        <td class="text-right totalSales">0.00</td>
                                        <td class="text-right totalProfit">0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
                            @csrf
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')

<script src="{{ URL::asset('picker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('print/print.min.js') }}"></script>

<script>
    $(document).ready(function ()
    {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        let _token = $('input[name="_token"]').val();

        function money(value) {
            return (parseFloat(value) || 0).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function fetch_data(from_date = "", to_date = "", medicine = "")
        {
            $.ajax({
                url: "{{ route('sales.fetch_data') }}",
                method: 'POST',
                data: { from_date: from_date, to_date: to_date, _token: _token, medicine: medicine },
                dataType: 'json',
                success: function (data)
                {
                    let totalSales = 0;
                    let totalProfit = 0;
                    let output = "";

                    $('#total_records').text(data.length);

                    if (data.length === 0) {
                        output = '<tr><td colspan="7" class="text-center text-muted">No sales found for this selection.</td></tr>';
                    }

                    data.forEach(function (i) {
                        output += '<tr>';
                        output += '<td>' + i.code + '</td>';
                        output += '<td>' + i.name + '</td>';
                        output += '<td>' + (i.customer_name || '') + '</td>';
                        output += '<td class="text-right">' + i.quantity + '</td>';
                        output += '<td class="text-right">' + money(i.price) + '</td>';
                        output += '<td class="text-right">' + money(i.profit) + '</td>';
                        output += '<td>' + i.date + '</td>';
                        output += '</tr>';

                        totalSales += parseFloat(i.price) || 0;
                        totalProfit += parseFloat(i.profit) || 0;
                    });

                    $('tbody').html(output);
                    $('.totalSales').text(money(totalSales));
                    $('.totalProfit').text(money(totalProfit));
                }
            });
        }

        // Initial load (defaults to the current month on the server).
        fetch_data();

        $('#filter').click(function ()
        {
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let medicine = $('#medicine_id').val();

            if (from_date !== "" && to_date !== "")
            {
                fetch_data(from_date, to_date, medicine);
            }
            else
            {
                alert('Both dates are required');
            }
        });

        $('#refresh').click(function ()
        {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#medicine_id').val('').trigger('change');

            fetch_data('', '', '');
        });
    });

</script>


@endsection
