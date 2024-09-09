    @extends('layouts.user')

    @section('content')
    <style>
        /* Custom shadow for the image */
    .shadow-custom {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adjust values for a softer or stronger shadow */
        border-radius: 0.25rem; /* Ensure the rounded corners match the card */
    }

    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .card img {
        max-height: 100%;
        object-fit: cover;
    }


    </style>
    <div class="container mt-5 bg-light">
        <div class="row justify-content-center">
            <div class="col">
                <!-- Card untuk gambar dan konten -->
                <div class="card">
                    <div class="row g-0">
                        <!-- Kolom kiri untuk gambar dengan shadow -->
                        <div class="col">
                            <img src="{{ asset('images/training/' . $training->cover) }}" alt="{{ $training->nama_training }}" class="img-fluid rounded-start shadow-custom" style="height: 100%; object-fit: cover;">
                        </div>
                        <!-- Kolom kanan untuk konten -->
                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title">{{ $training->nama_training }}</h5>
                                <p class="card-text"><strong>Tanggal:</strong> {{ $training->formatted_tanggal }}</p>
                                <p class="card-text">{{ $training->konten }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol kembali ke halaman sebelumnya -->
                <div class="text-center mt-4 mb-5">
                    <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg" style="width: 50%; margin-bottom: 15rem; margin-top:6rem; ">
                        Kembali ke halaman sebelumnya
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection
