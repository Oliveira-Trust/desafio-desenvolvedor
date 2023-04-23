<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ExCalc</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.js" integrity="sha512-CTSrPIDxxtTdaIYlTKHEyvHa+70TOhC1pY3PLDgrUqCFifFtV7KrucZCvPy2K7hB0HtKgt0r4INTGBISqnaLNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!-- Datatables -->
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            .tab-pane {
                padding: 0.5em;
            }

            #exchange_form {
                width: 40%;
                margin: 0 auto;
            }

            div.slider {
                display: none;
                width: 70%;
            }

            .input-group-text{
                width: 6em;
                display: block;
            }

            #submit-edit, .submit-create{
                width: 10em;
            }
        </style>

        <script>
            function get_currency_exchange_rate()
            {
                var from_currency = $("#from_currency").val()
                var to_currency = $("#to_currency").val()
                var payment_method = $("#payment_method").val()
                var amount = $("#amount").val()

                var url = "{{ url('/get_exchange_rate') }}" + '/' + from_currency + "-" + to_currency;

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        payment_method: payment_method,
                        amount: amount
                    },
                    success: function(response) {
                        $("#payment_method_tax").val(response.data.payment_method_tax)
                        $("#amount_tax").val(response.data.amount_tax)
                        $("#final_amount").val(response.data.final_amount)
                        $("#total_amount").val(response.data.total_amount)
                        $("#rate_exchange").val(response.data.rate_exchange)
                    },
                    error: function (xhr, error, code) {
                        var msg = xhr.responseJSON.message
                        if (xhr.responseJSON.errors) {
                            msg = "";
                            $.each(xhr.responseJSON.errors, function(k, i){
                                msg += i.join(',');
                            });
                        }
                        $(".container").prepend('<div role=\"alert\" class=\"alert alert-danger\">' + msg + '</div>') ;
                    }
                });
            }

            function format_value(data, type, row, meta)
            {
                return "$" + data.toFixed(2);
            }

            function tax(data, type, row, meta)
            {
                return row.payment_method.name + " (%" + (row.payment_method_rate * 100).toFixed(2) + ")";
            }

            $(document).ready(function ()
            {
                var table = $('#exchangeHistoryTable').DataTable({
                    ajax: {
                        url: "{{ url('/get_history') }}",
                        error: function (xhr, error, code) {
                            $(".container").prepend('<div role=\"alert\" class=\"alert alert-danger\">' + xhr.responseJSON.message + '</div>') ;
                        }
                    },
                    columns: [
                        { data: 'id', title: '#' },
                        { data: 'from_currency', title: 'From' },
                        { data: 'to_currency', title: 'To' },
                        { data: 'amount', title: 'Amount', render: format_value },
                        { data: 'amount_tax', title: 'Amount Tax', render: format_value },
                        { title: 'Payment Method', render: tax },
                        { data: 'payment_method_tax', title: 'Payment Method Tax', render: format_value },
                        { data: 'amount_after_taxes', title: 'Amount after taxes', render: format_value },
                        { data: 'currency_value', title: 'Currency Value', render: format_value },
                        { data: 'net_total', title: 'Net Total', render: format_value },
                    ],
                });

                $("#exchange_form").on('submit', function (e) {
                    e.preventDefault();
                    get_currency_exchange_rate();
                    table.ajax.reload( null, false );
                });

                $("#clear-history-btn").on('click', function (e) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('/delete_history') }}",
                        success: function(response) {
                            $(".container").prepend('<div role=\"alert\" class=\"alert alert-success\">' + "History erased" + '</div>') ;
                            table.ajax.reload( null, false );
                        },
                        error: function (xhr, error, code) {
                            $(".container").prepend('<div role=\"alert\" class=\"alert alert-danger\">' + xhr.responseJSON.message + '</div>') ;
                        }
                    });
                });

                $(".currency-dropdown").on('keyup', function(e) {
                    content = $(this).val().toLowerCase()

                    if ($(this).attr('direction') == 'to') {
                        $.each($(".direction-to li a"), function (k,i) {
                            if (i.innerHTML.toLowerCase().indexOf(content) > -1) {
                                i.style.display = "";
                            } else {
                                i.style.display = "none";
                            }
                        });
                    }

                    if ($(this).attr('direction') == 'from') {
                        $.each($(".direction-from li a"), function (k,i) {
                            if (i.innerHTML.toLowerCase().indexOf(content) > -1) {
                                i.style.display = "";
                            } else {
                                i.style.display = "none";
                            }
                        });
                    }
                });

                $(".direction-from li a").on('click', function (e) {
                    $("#from_currency").val($(this)[0].innerHTML)
                });

                $(".direction-to li a").on('click', function (e) {
                    $("#to_currency").val($(this)[0].innerHTML)
                    $(".to_currency_net_total").html("in <b>" + $(this)[0].innerHTML + "<b>")
                });

                
            });

            $(document).bind('DOMSubtreeModified', function () {
                if ($(".alert").is(":visible")) {
                    setInterval(function() {
                        $(".alert").slideUp('slow');
                    }, 5000);
                }
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ExCalc</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               Olá, {{ Illuminate\Support\Facades\Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Home</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('/logout') }}">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" style="margin-top: 2em;">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create-tab-pane" type="button" role="tab" aria-controls="create-tab-pane" aria-selected="false">Create</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="true">My History</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="create-tab-pane" role="tabpanel" aria-labelledby="create-tab" tabindex="0">
               
                    <form action="{{ url('/get_exchange_rate') }}" method="post" id="exchange_form" >
                        <div class="row">
                            <div class="col">
                                <label for="email" class="form-label">From</label>
                                <div class="dropdown">
                                    <input type="text" class="form-control dropdown-toggle currency-dropdown" autocomplete="off" data-bs-toggle="dropdown" direction="from" placeholder="Select currency" id="from_currency"/>
                                    <ul class="dropdown-menu direction-from">
                                        @foreach($currencies as $k=>$i)
                                            <li><a class="dropdown-item" href="#" currency="{{ $k }}">{{ $k }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">To</label>
                                <div class="dropdown">
                                    <input type="text" class="form-control dropdown-toggle currency-dropdown"  autocomplete="off" data-bs-toggle="dropdown" direction="to" placeholder="Select currency" id="to_currency"/>
                                    <ul class="dropdown-menu direction-to">
                                        @foreach($currencies as $k=>$i)
                                            <li><a class="dropdown-item" href="#" currency="{{ $k }}">{{ $k }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Payment Method</label>
                            <div class="dropdown">
                                <select class="form-select" aria-label="Default select example" id="payment_method" name="payment_method">
                                    @foreach($paymentMethods as $paymentMethod)
                                        <option value="{{ $paymentMethod->id }}"> {{ $paymentMethod->name }} (%{{ $paymentMethod->fee_value * 100 }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Payment Method Tax</label>
                            <input type="text" class="form-control" id="payment_method_tax" name="payment_method_tax" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Amount Tax</label>
                            <input type="text" class="form-control" id="amount_tax" name="amount_tax" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Amount after Tax</label>
                            <input type="text" class="form-control" id="final_amount" name="final_amount" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Rate exchange</label>
                            <input type="text" class="form-control" id="rate_exchange" name="rate_exchange" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Net Total <span class='to_currency_net_total'></span></label>
                            <input type="text" class="form-control" id="total_amount" name="total_amount" required disabled>
                        </div>

                        
                        <div class="mb-3" align="center">
                            <button type="submit" class="btn btn-sm btn-outline-primary submit-create">Calculate </i></button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
                    <p><button class="btn btn-sm btn-primary" id="clear-history-btn">Clear History</button></p>
                    <table class="table" id="exchangeHistoryTable" style="width: 100%">
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
