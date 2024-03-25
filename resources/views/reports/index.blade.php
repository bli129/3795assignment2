@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('title', 'Expense Report')

@section('content')
<div class="container mt-5">
    <h2>Expense Report for Year: {{ $year }}</h2>
    <hr>

    <div class="row">
        <!-- Placeholder for the pie chart -->
        <div class="col-md-6">
            <div id="piechart" style="width: 100%; height: 500px;"></div>
        </div>

        <!-- Displaying the data table -->
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Amount Spent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData as $category => $amount)
                    <tr>
                        <td>{{ $category }}</td>
                        <td>${{ number_format($amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Google Charts Script -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Category', 'Amount Spent'],
            @foreach($reportData as $category => $amount)
                ['{{ $category }}', {{ $amount }}],
            @endforeach
        ]);

        var options = {
            title: 'Expenses by Category for {{ $year }}',
            is3D: true,
            backgroundColor: 'transparent',
            legend: { textStyle: { color: 'black', fontSize: 12 } },
            titleTextStyle: { color: 'black', fontSize: 16 },
            chartArea: {width: '100%', height: '100%'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
@endsection
