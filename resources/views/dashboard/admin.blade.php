@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">

        <div class="flex flex-col items-start space-y-2 sm:space-y-0 sm:flex-row sm:items-center">
            <h3 class="text-2xl sm:text-3xl font-medium text-gray-700"><span class="text-indigo-600">HI</span>,
                {{ ucfirst(auth()->user()->username) }}.</h3>
        </div>


        <div class="max-w-7xl w-full p-6 md:p-8 md:max-w-12xl mx-auto" x-data="chartComponent()" x-init="fetchChartData()">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-4">📊 Postingan per Hari</h2>

            <!-- Canvas Chart -->
            <div class="relative flex flex-col items-center">
                <canvas id="lineChart" class="md:h-96 w-full md:w-auto"></canvas>
            </div>

            <!-- Tombol Update Data -->
            <div class="flex justify-center mt-4 space-x-4">
                <button @click="fetchChartData()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    🔄 Refresh Data
                </button>
            </div>
        </div>

        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("chartComponent", () => ({
                    chart: null,
                    labels: [],
                    dataset: [],

                    // Fetch data dari API Laravel
                    async fetchChartData() {
                        try {
                            const response = await fetch(
                            "api/chart-data"); // Ambil data dari API Laravel
                            const data = await response.json();

                            // Ambil label tanggal & jumlah postingan
                            this.labels = data.map(item => item.date);
                            this.dataset = data.map(item => item.count);

                            // Jika chart belum dibuat, buat chart baru
                            if (!this.chart) {
                                this.initChart();
                            } else {
                                this.updateChart();
                            }
                        } catch (error) {
                            console.error("Gagal mengambil data:", error);
                        }
                    },

                    // Inisialisasi Chart.js
                    initChart() {
                        const ctx = document.getElementById("lineChart").getContext("2d");
                        this.chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: this.labels,
                                datasets: [{
                                    label: "Jumlah Postingan",
                                    data: this.dataset,
                                    borderColor: "rgb(59, 130, 246)",
                                    backgroundColor: "rgba(59, 130, 246, 0.2)",
                                    borderWidth: 2,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },

                    // Update Chart dengan data baru
                    updateChart() {
                        this.chart.data.labels = this.labels;
                        this.chart.data.datasets[0].data = this.dataset;
                        this.chart.update();
                    }
                }));
            });
        </script>



    </div>
@endsection
