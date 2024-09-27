@extends('template.master')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>
                                    @php
                                        $hour = now()->format('H');
                                        if ($hour >= 5 && $hour < 12) {
                                            $greeting = "Selamat Pagi";
                                        } elseif ($hour >= 12 && $hour < 15) {
                                            $greeting = "Selamat Siang";
                                        } elseif ($hour >= 15 && $hour < 18) {
                                            $greeting = "Selamat Sore";
                                        } else {
                                            $greeting = "Selamat Malam";
                                        }
                                    @endphp
                                    {{ $greeting }}, {{ Auth::user()->name }}!
                                </h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <p>
                                Selamat datang di ARR MOTOR! Tempat terbaik untuk menemukan mobil impianmu. Jelajahi berbagai pilihan mobil berkualitas yang sesuai dengan gaya dan kebutuhanmu. Semangat dalam mencapai impianmu, karena perjalanan selalu lebih baik dengan kendaraan yang tepat.
                            </p>
                        </div>
                    </div>
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>
                                    @php
                                        $hour = now()->format('H');
                                        if ($hour >= 5 && $hour < 12) {
                                            $greeting = "Selamat Pagi";
                                        } elseif ($hour >= 12 && $hour < 15) {
                                            $greeting = "Selamat Siang";
                                        } elseif ($hour >= 15 && $hour < 18) {
                                            $greeting = "Selamat Sore";
                                        } else {
                                            $greeting = "Selamat Malam";
                                        }
                                    @endphp
                                    {{ $greeting }}, {{ Auth::user()->name }}!
                                </h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <p>
                                Selamat datang di ARR MOTOR! Tempat terbaik untuk menemukan mobil impianmu. Jelajahi berbagai pilihan mobil berkualitas yang sesuai dengan gaya dan kebutuhanmu. Semangat dalam mencapai impianmu, karena perjalanan selalu lebih baik dengan kendaraan yang tepat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
