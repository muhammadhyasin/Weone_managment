<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Invoice</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
    <body>
        
    

<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-16"><strong>Order # {{ $order->id }}</strong></h4>
                            <h3>
                                <img src="/images/logo.svg" alt="logo" height="40"/>
                            </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    {{ $order->customer_name }} <br>
                                    {{ $order->phone_number }}
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <address>
                                    <strong>Shipped To:</strong><br>
                                    {{ $order->address }}<br>
                                    {{ $order->postcode }}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-4">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{ $order->payment_method }}
                                </address>
                            </div>
                            <div class="col-6 mt-4 text-end">
                                <address>
                                    <strong>Delivery Date:</strong><br>
                                    {{ $order->updated_at }}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-size-16"><strong>Order summary</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>Item</strong></td>
                                            <td class="text-center"><strong>Price</strong></td>
                                            <td class="text-center"><strong>Quantity</strong>
                                            </td>
                                            <td class="text-end"><strong>Totals</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        <tr>
                                            <td>{{ $order->product_name }}</td>
                                            <td class="text-center">{{ $order->price }}</td>
                                            <td class="text-center">1</td>
                                            <td class="text-end">{{ $order->price }}</td>
                                        </tr>
                                        <tr>
                                            <td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center">
                                                <strong>Subtotal</strong></td>
                                            <td class="thick-line text-end">{{ $order->price }}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>Total</strong></td>
                                            <td class="no-line text-end"><h4 class="m-0">£ {{ $order->price }}</h4></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div>
<script>
    // Ensure light mode is selected by default
    document.addEventListener('DOMContentLoaded', function () {
        const lightModeSwitch = document.getElementById('light-mode-switch');
        const darkModeSwitch = document.getElementById('dark-mode-switch');

        // Check the light mode by default
        if (lightModeSwitch) {
            lightModeSwitch.checked = true;
        }

        // Optionally, uncheck dark mode
        if (darkModeSwitch) {
            darkModeSwitch.checked = false;
        }

        // Apply light mode styles dynamically if needed
        // Example: Ensure proper style is loaded
        document.getElementById('bootstrap-style').href = "{{ asset('/css/bootstrap.min.css') }}";
        document.getElementById('app-style').href = "{{ asset('/css/app.min.css') }}";
    });
</script>




<script src="/libs/jquery/jquery.min.js"></script>
<script src="/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/libs/metismenu/metisMenu.min.js"></script>
<script src="/libs/simplebar/simplebar.min.js"></script>
<script src="/libs/node-waves/waves.min.js"></script>

<script src="/js/app.js"></script>

</body>
</html>