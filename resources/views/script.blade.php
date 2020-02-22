@section('script')

<script src="{{ mix('js/app.js') }}" ></script>
<script src="/dist/scripts/flat-ui.min.js"></script>
<script src="/dist/scripts/application.js"></script>
@yield('page_script')

@endsection