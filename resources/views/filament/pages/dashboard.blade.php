<x-filament::page>
    <h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>

    {{-- Total Alumni --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Alumni</h3>
            <p class="text-3xl">{{ \App\Models\Alumni::count() }}</p>
        </div>
    </div>

    {{-- Alumni Terbaru --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <h3 class="text-lg font-semibold mb-4">Alumni Terbaru</h3>
        <ul>
            @foreach (\App\Models\Alumni::latest()->take(5)->get() as $alumni)
                <li class="mb-2">
                    <strong>{{ $alumni->nama }}</strong> - {{ $alumni->angkatan }}<br>
                    <small>{{ $alumni->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Grafik Alumni per Jurusan --}}
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">Grafik Alumni per Jurusan</h3>
        <canvas id="alumniChart"></canvas>
    </div>

    {{-- Chart Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch('{{ route('chart.alumni.jurusan') }}')
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('alumniChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Jumlah Alumni',
                            data: data.data,
                            backgroundColor: 'rgba(59, 130, 246, 0.6)',
                        }]
                    }
                });
            });
    </script>
</x-filament::page>
