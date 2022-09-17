<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('/js/admin/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body class="">
    <div id="preloader" class="position-fixed align-items-center justify-content-center py-1 px-3 rounded shadow-sm" style="background-color: #f8facf;  backdrop-filter: blur(20px); z-index: 999999999; top: 80px; left: 50%; transform:translateX(-50%); display: none">

        Please wait while loading...

    </div>
    @include('admin.layouts.partials.navbar')
    <div>
        @yield('subnav')
    </div>
    <main>

        <div class="container-lg py-4">
            @yield('content')
        </div>
        <div class="text-center p-2">
            <small>Made by <a href="">Xpeed Technologies</a></small>
        </div>
    </main>

    @section("scripts")

    @show
</body>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ajaxStart(() => {
        $("#preloader").fadeIn();
    })
    $(document).ajaxComplete(() => {
        $("#preloader").fadeOut();
    });

    $(document).ready(() => {
        console.log("cool");
        //axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

        document.querySelectorAll(".rich-text").forEach(_elem => {
            var _editor = document.createElement("div");
            _elem.parentNode.insertBefore(_editor, _elem.nextSibling);
            var quill = new Quill(_editor, {
                theme: 'snow'
            });
            quill.root.innerHTML = _elem.innerHTML;
            quill.on('text-change', function(delta, oldDelta, source) {
                _elem.innerHTML = quill.root.innerHTML;
                if (source == 'api') {
                    console.log("An API call triggered this change.");
                } else if (source == 'user') {
                    console.log("A user action triggered this change.");
                }
            });
            _elem.style.display="none"
        });
    });
</script>

</html>