<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Report') }}</h1>
        </x-slot>

        <div class="card">
            <canvas id="myChart" width="400" height="175"></canvas>
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
                                label: 'Post - Last 30 Days post',
                                data: data,
                                backgroundColor: [
                                    'rgba(87, 31, 171, 1)'
                                ],
                                borderColor: [
                                    'rgba(87, 31, 171, 0.2)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                            }
                        }
                    });
                }

            </script>
        @endpush
    </x-cms::content-wrapper>
</x-cms::layouts.app>
