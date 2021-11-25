<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Report') }}</h1>
        </x-slot>

        <div class="card">
            <div class="card-body">
                <canvas id="myChart" width="400" height="175"></canvas>
            </div>
            <div class="card-footer table-responsive table-bordered">
                <table class="table text-center">
                    <thead class="h3">
                        <th>Total Posts</th>
                        <th>All-time views</th>
                    </thead>
                    <tbody>
                        <tr class="h3">
                            <td >{{ count($totalPosts) }}</td>
                            <td>{{ $totalPosts->sum('views') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @push('script')
            <script type="text/javascript" src="{{ asset('public/laracms/chart.js') }}"></script>

            <script>
                $(function () {
                    runChart();
                });

                function runChart() {
                    let labels = @json($labels);
                    let data = @json($data);
                    barChart(labels, data)
                }

                function barChart(labels, data) {
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Post - Last 30 Days',
                                data: data,
                                backgroundColor: [
                                    'rgba(29, 136, 175, 1)'
                                ],
                                borderColor: [
                                    'rgba(29, 136, 175, 0.2)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: false
                                },
                            }
                        }
                    });
                }

            </script>
        @endpush
    </x-cms::content-wrapper>
</x-cms::layouts.app>
