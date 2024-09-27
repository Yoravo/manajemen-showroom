@include('template.header')

@include('template.sidebar')
<!--begin::Footer-->

<!--end::Footer-->
</div>
<!--end::Aside-->
<!--begin::Wrapper-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    @include('template.navbar')
    <!--end::Header-->
    <!--begin::Content-->
    @yield('content')
    @include('template.footer')