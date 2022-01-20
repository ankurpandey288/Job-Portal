@extends('employer.layouts.app')
@section('title')
    {{ __('messages.transactions') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.transactions') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('employer.transactions.table')
                </div>
            </div>
        </div>
        @include('employer.transactions.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let transactionUrl = "{{ route('transaction.index') }}";
        let invoiceUrl = "{{ url('employer/invoices') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('js/currency.js') }}"></script>
    <script src="{{mix('assets/js/employer_transactions/transactions.js')}}"></script>
@endpush

