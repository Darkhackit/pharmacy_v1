@extends('layouts.app')

@section('content')

@php
    // Grand totals (any period set sums to the same all-time total).
    $grandSales  = array_sum(array_map('floatval', $Dtotal));
    $grandProfit = array_sum(array_map('floatval', $Dprofit));
    $margin      = $grandSales > 0 ? ($grandProfit / $grandSales) * 100 : 0;
    $daysRecorded = count($Ddates);

    // Report sections rendered as tables. `reverse` shows most recent first.
    $sections = [
        ['title' => 'Daily Sales & Profit',   'period' => 'Date',  'labels' => $Ddates, 'sales' => $Dtotal, 'profit' => $Dprofit, 'reverse' => true, 'limit' => 30],
        ['title' => 'Weekly Sales & Profit',  'period' => 'Week',  'labels' => $Wdates, 'sales' => $Wtotal, 'profit' => $Wprofit, 'reverse' => true],
        ['title' => 'Monthly Sales & Profit', 'period' => 'Month', 'labels' => $dates,  'sales' => $total,  'profit' => $profit,  'reverse' => true],
        ['title' => 'Yearly Sales & Profit',  'period' => 'Year',  'labels' => $Ydates, 'sales' => $Ytotal, 'profit' => $Yprofit, 'reverse' => false],
    ];
@endphp

{{-- Summary cards --}}
<div class="row">
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h3 class="text-success mb-0">&#8373; {{ number_format($grandSales, 2) }}</h3>
                    <span>Total Sales</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h3 class="text-primary mb-0">&#8373; {{ number_format($grandProfit, 2) }}</h3>
                    <span>Total Profit</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h3 class="text-warning mb-0">{{ number_format($margin, 1) }}%</h3>
                    <span>Profit Margin</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h3 class="text-info mb-0">{{ number_format($daysRecorded) }}</h3>
                    <span>Days Recorded</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail tables --}}
@foreach ($sections as $s)
    @php
        $labels = $s['reverse'] ? array_reverse($s['labels']) : $s['labels'];
        $sales  = $s['reverse'] ? array_reverse($s['sales'])  : $s['sales'];
        $profit = $s['reverse'] ? array_reverse($s['profit']) : $s['profit'];

        // Optionally cap long tables (e.g. Daily) to the most recent N periods.
        $limit = $s['limit'] ?? null;
        $totalPeriods = count($labels);
        if ($limit && $totalPeriods > $limit) {
            $labels = array_slice($labels, 0, $limit);
            $sales  = array_slice($sales, 0, $limit);
            $profit = array_slice($profit, 0, $limit);
            $showingNote = "latest {$limit} of {$totalPeriods}";
        } else {
            $showingNote = null;
        }

        // Footer total reflects the rows actually shown.
        $sumSales  = array_sum(array_map('floatval', $sales));
        $sumProfit = array_sum(array_map('floatval', $profit));
    @endphp
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $s['title'] }}
                    @if ($showingNote)<small class="text-muted">&mdash; {{ $showingNote }}</small>@endif
                </h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>{{ $s['period'] }}</th>
                                    <th class="text-right">Sales (&#8373;)</th>
                                    <th class="text-right">Profit (&#8373;)</th>
                                    <th class="text-right">Margin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($labels as $i => $label)
                                    @php
                                        $rowSales  = (float) $sales[$i];
                                        $rowProfit = (float) $profit[$i];
                                        $rowMargin = $rowSales > 0 ? ($rowProfit / $rowSales) * 100 : 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td class="text-right">{{ number_format($rowSales, 2) }}</td>
                                        <td class="text-right">{{ number_format($rowProfit, 2) }}</td>
                                        <td class="text-right">{{ number_format($rowMargin, 1) }}%</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No sales recorded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if (count($labels))
                                <tfoot>
                                    <tr class="font-weight-bold">
                                        <td>Total</td>
                                        <td class="text-right">{{ number_format($sumSales, 2) }}</td>
                                        <td class="text-right">{{ number_format($sumProfit, 2) }}</td>
                                        <td class="text-right">{{ number_format($sumSales > 0 ? ($sumProfit / $sumSales) * 100 : 0, 1) }}%</td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
