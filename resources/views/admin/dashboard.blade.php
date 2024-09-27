@extends('template.master')

@section('page-tite', 'Dashboard')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $greeting }}, {{ Auth::user()->name }}!</h2> <!-- Sapaan sesuai waktu -->
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <p>{{ $motivation }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection