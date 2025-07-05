@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

    <canvas id="penjualanChart" height="120"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chartLabels = JSON.parse("{{ addslashes(json_encode($labels)) }}");
        var chartTotals = JSON.parse("{{ addslashes(json_encode($totals)) }}");
        var canvas = document.getElementById('penjualanChart');
        if (canvas) {
            var ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Penjualan (Rp)',
                        data: chartTotals,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat().format(value);
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
