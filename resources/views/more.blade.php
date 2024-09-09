@extends('layouts.user')

@section('content')
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4" style="font-family: monospace;">Daftar Training</h1>
        <div class="row g-4">
            @foreach($training as $data)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('images/training/' . $data->cover) }}" class="card-img-top" alt="{{ $data->nama_training }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $data->nama_training }}</h5>
                            <p class="card-text">{{ $data->formatted_tanggal }}</p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($data->konten, 50) }}</p>
                            <a href="{{ url('pelatihan', $data->id) }}" class="btn btn-primary mt-auto">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('welcome') }}" class="btn btn-secondary btn-lg" style="width: 50%; margin-bottom: 15.5rem; margin-top:4rem;">Kembali</a>
        </div>
    </div>

    <!-- Optional: Tambahkan Bootstrap JS jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
