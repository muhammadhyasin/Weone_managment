<!doctype html>
<html lang="en">

    <head>
        <script>
            function updateTime() {
                const indianTimeElement = document.getElementById('indian-time');
                const ukTimeElement = document.getElementById('uk-time');
        
                // Get current UTC time
                const now = new Date();
        
                // Create options for formatting
                const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        
                // Calculate Indian Time (UTC + 5:30)
                const indianTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Kolkata' }));
                indianTimeElement.innerHTML = `India: ${indianTime.toLocaleTimeString('en-US', options)}`;
        
                // Calculate UK Time (UTC + 0)
                const ukTime = new Date(now.toLocaleString('en-US', { timeZone: 'Europe/London' }));
                ukTimeElement.innerHTML = `UK: ${ukTime.toLocaleTimeString('en-US', options)}`;
            }
        
            // Update the time every second
            setInterval(updateTime, 1000);
        
            // Initial call to display time immediately
            updateTime();
        </script>
        
        
        <script>
            function updateLastSeen() {
                fetch('{{ route("user.updateLastSeen") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                }).then(response => {
                    if (!response.ok) {
                        console.error('Failed to update last seen');
                    }
                }).catch(error => console.error('Error:', error));
            }
        
            // Send the request every 1 minute
            setInterval(updateLastSeen, 60000);
        
            // Send the request when the page loads
            updateLastSeen();
        </script>
        
        <script>
            (function () {
                const theme = sessionStorage.getItem("is_visited") || "dark-mode-switch";
                const themes = {
                    "light-mode-switch": {
                        bootstrap: "/css/bootstrap.min.css",
                        app: "/css/app.min.css"
                    },
                    "dark-mode-switch": {
                        bootstrap: "/css/bootstrap-dark.min.css",
                        app: "/css/app-dark.min.css"
                    },
                    "rtl-mode-switch": {
                        bootstrap: "/css/bootstrap-rtl.min.css",
                        app: "/css/app-rtl.min.css"
                    }
                };
        
                const selectedTheme = themes[theme];
                if (selectedTheme) {
                    document.write(`
                        <link id="bootstrap-style" href="${selectedTheme.bootstrap}" rel="stylesheet">
                        <link id="app-style" href="${selectedTheme.app}" rel="stylesheet">
                    `);
                }
            })();
        </script>
        
        
        <meta charset="utf-8" />
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/images/logo.svg') }}">

        <!-- jquery.vectormap css -->
        <link href="{{ asset('/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- DataTables -->
        <link href="{{ asset('/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Responsive datatable examples -->
        <link href="{{ asset('/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Bootstrap Css -->
       
        
        <!-- Icons Css -->
        <link href="{{ asset('/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- App Css-->
        


        <!-- PWA manifest -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <!-- Full-screen mode for iOS Safari -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <!-- Theme color for Android's address bar and task switcher -->
        <meta name="theme-color" content="#000000">

        <!-- App icons -->
        <link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">

        <!-- Splash screens for iOS -->
        <link rel="apple-touch-startup-image" media="screen and (device-width: 440px) and (device-height: 956px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_16_Pro_Max_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 402px) and (device-height: 874px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_16_Pro_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_16_Plus__iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_16__iPhone_15_Pro__iPhone_15__iPhone_14_Pro_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_11_Pro_Max__iPhone_XS_Max_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_11__iPhone_XR_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/13__iPad_Pro_M4_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/12.9__iPad_Pro_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/11__iPad_Pro_M4_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/11__iPad_Pro__10.5__iPad_Pro_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/10.9__iPad_Air_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/10.5__iPad_Air_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/10.2__iPad_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{ asset('splash_screens/8.3__iPad_Mini_landscape.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 440px) and (device-height: 956px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_16_Pro_Max_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 402px) and (device-height: 874px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_16_Pro_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_16_Plus__iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_16__iPhone_15_Pro__iPhone_15__iPhone_14_Pro_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_11_Pro_Max__iPhone_XS_Max_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_11__iPhone_XR_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/13__iPad_Pro_M4_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/12.9__iPad_Pro_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/11__iPad_Pro_M4_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/11__iPad_Pro__10.5__iPad_Pro_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/10.9__iPad_Air_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/10.5__iPad_Air_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/10.2__iPad_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait.png') }}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{ asset('splash_screens/8.3__iPad_Mini_portrait.png') }}">


        


    </head>
    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                // If the page was restored from cache, reload it
                window.location.reload();
            }
        });
    </script>
    
    

    <body>
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/images/logo.svg" alt="logo-sm" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="/images/logo.svg" alt="logo-dark" height="35">
                                </span>
                            </a>

                            <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('/images/logo.svg') }}" alt="logo-sm-light" height="25">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('/images/logo.svg') }}" alt="logo-light" height="25">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>
                        <!-- App Search-->
                        <div class="dropdown d-inline-block user-dropdown d-none d-lg-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="createDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Create <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                </button>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('orders.create') }}">
                                    <i class="ri-add-line align-middle me-1"></i> New Order
                                </a>
                                <a class="dropdown-item" href="{{ route('create.pickup') }}">
                                    <i class="ri-add-line align-middle me-1"></i> New Pickup
                                </a>
                                @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
                                <a class="dropdown-item d-block" href="{{ route('expense.create') }}"><i class="ri-add-line align-middle me-1"></i> New Expense</a>
                                @endif
                                @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
                                <a class="dropdown-item d-block" href="{{ route('users.create') }}"><i class="ri-add-line align-middle me-1"></i> Create User</a>
                                @endif
                                
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="d-flex">

                        <div class="dropdown d-inline-block user-dropdown d-lg-none ms-2">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="createDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-add-line"></i>
                                </button>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('orders.create') }}">
                                    <i class="ri-add-line align-middle me-1"></i> New Order
                                </a>
                                @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
                                <a class="dropdown-item d-block" href="{{ route('expense.create') }}"><i class="ri-add-line align-middle me-1"></i> New Expense</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('create.pickup') }}">
                                    <i class="ri-add-line align-middle me-1"></i> New Pickup
                                </a>
                                @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
                                <a class="dropdown-item" href="{{ route('users.create') }}">
                                    <i class="ri-add-line align-middle me-1"></i> Add User
                                </a>
                                @endif
                            </div>
                        </div>
                    
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-notification-3-line"></i>
                                <span class="noti-dot"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Coming soon</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">soon</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    {{-- <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="/images/users/avatar-4.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a> --}}
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('/images/users/avatar-1.png') }}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="ri-user-line align-middle me-1"></i> {{ __('Profile') }}
                                </a>
                                
                                <a class="dropdown-item d-block" href="#"><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                                    </a>

                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="ri-settings-2-line"></i>
                            </button>
                        </div>
            
                    </div>
                </div>
            </header>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                const profilePic = document.getElementById('profile-pic');
                const profilePicInput = document.getElementById('profile-pic-input');

                // Trigger file input when the image is clicked
                profilePic.addEventListener('click', function () {
                    profilePicInput.click();
                });

                // Preview the selected image
                profilePicInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            profilePic.src = e.target.result; // Update the profile picture preview
                        };
                        reader.readAsDataURL(file);

                        // Optional: Send the image to the server after selection
                        uploadProfilePicture(file);
                    }
                });

                // Upload the profile picture to the server
                function uploadProfilePicture(file) {
                const formData = new FormData();
                formData.append('profile_picture', file);

                fetch('{{ route("profile.upload") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Profile picture updated successfully:', data.path);
                    } else {
                        console.error('Error updating profile picture:', data.error);
                    }
                })
                .catch(error => console.error('Upload error:', error));
            }

            });

            </script>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!-- User details -->
                    <div class="user-profile text-center mt-3">
                        <div class="position-relative">
                            <img 
                                id="profile-pic" 
                                src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('/images/users/avatar-1.png') }}" 
                                alt="Profile Picture" 
                                class="avatar-md rounded-circle" 
                                style="cursor: pointer;"
                            >
                            <input 
                                type="file" 
                                id="profile-pic-input" 
                                style="display: none;" 
                                accept="image/*"
                            >
                        </div>
                        
                        <div class="mt-3">
                            <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>
                            <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
                            <small><p id="indian-time" class="mb-sm-0"></p></small>
                            <small><p id="uk-time" class="mb-sm-0"></p></small>
                        </div>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                    <i class="ri-dashboard-line"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-shopping-cart-2-line"></i>
                                    <span>Orders</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('orders.index') }}">All orders</a></li>
                                    <li><a href="{{ route('orders.pending') }}">Pending orders</a></li>
                                    <li><a href="{{ route('orders.completed') }}">Completed orders</a></li>
                                    <li><a href="{{ route('orders.refunded') }}">Refunded orders</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-shopping-bag-2-line"></i>
                                    <span>Pickups</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('pickup.index') }}">All Pickups</a></li>
                                    <li><a href="{{ route('pickup.pending') }}">Pending Pickups</a></li>
                                    <li><a href="{{ route('pickup.completed') }}">Completed orders</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">Admin</li>
                            @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
                            <li>
                                <a href="{{ route('users.index') }}" class="waves-effect">
                                    <i class="ri-user-line"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('shifts.index') }}" class="waves-effect">
                                    <i class="mdi mdi-account-clock-outline"></i>
                                    <span>Shift</span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user() && (Auth::user()->role === 'superadmin'))
                            <li class="menu-title">Superadmin</li>
                            <li>
                                <a href="{{ route('superlogs.index') }}" class="waves-effect">
                                    <i class="ri-dashboard-line"></i>
                                    <span>Global Logs</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <!-- end page title -->
                        

                        @yield('content')
                        

                        <!-- end row -->
                        <!-- end row -->
                    </div>
                    
                </div>
                <!-- End Page-content -->
               
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © conceptmates.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
            
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="{{ asset('/css/bootstrap-dark.min.css') }}" data-appStyle="{{ asset('/css/app-dark.min.css') }}">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
                    
                
                    

            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/libs/node-waves/waves.min.js') }}"></script>
        
        <!-- apexcharts -->
        <script src="{{ asset('/libs/apexcharts/apexcharts.min.js') }}"></script>
        
        <!-- jquery.vectormap map -->
        <script src="{{ asset('/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>
        
        <!-- Required datatable js -->
        <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
        <!-- Responsive examples -->
        <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        
        <script src="{{ asset('/js/pages/dashboard.init.js') }}"></script>
        
        <!-- App js -->
        <script src="{{ asset('/js/app.js') }}"></script>
        

        <script src="/js/pages/datatables.init.js"></script>
        <script src="/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="/libs/jszip/jszip.min.js"></script>
        <script src="/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        @stack('scripts')
        
    </body>

</html>