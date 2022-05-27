@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quotes by Kenya West</div>
                <div class="d-flex justify-content-end mt-3">
                    <div class="btn btn-primary d-inline" id="refresh-btn">Refresh the quotes</div>
                </div>
                <div class="card-body">
                    <!-- place the quotes here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            fetchQuotes();
        })

        $('#refresh-btn').click(function() {
            $(this).addClass('disabled');
            fetchQuotes();
        });
        // Fetching quotes from an API route 
        function fetchQuotes() {     
            var token = '{!! \Session::get("my-api-token"); !!}';
            var htmlBlock = '';
            $.ajax({
                url: 'api/fetch-quotes',
                method: 'get',
                type: 'json',
                headers: {
                    "Authorization": "Bearer " + token
                },
                success: function(response) {
                    $('#refresh-btn').removeClass('disabled');
                    var quotes = response.quotes;
                    $.each(quotes, function(key, quote) {
                        htmlBlock = htmlBlock + `
                                                <hr>
                                                <h4>${quote}</h4>
                                                `;
                    })
                    $('.card-body').html(`${htmlBlock}`);
                }
            })
        }
    </script>
@endpush
