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
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    $(document).ready(() => {
        //jquery 
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

        //axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

        //ckeditor
        document.querySelectorAll(".rich-text").forEach(_elem => {
            _elem.style.display = "none";
            const _node = document.createElement("div");
            const _editor = ClassicEditor
                .create(_node)
                .then(editor => {
                    function htmlDecode(input) {
                        var doc = new DOMParser().parseFromString(input, "text/html");
                        return doc.documentElement.textContent;
                    }
                    editor.setData(htmlDecode(_elem.innerHTML));
                    editor.model.document.on('change:data', () => {
                        const data = editor.getData();
                        _elem.innerHTML = data;
                    });
                })
                .catch(error => {
                    console.error(error);
                    _elem.style.display = null;
                });
            _elem.parentNode.insertBefore(_node, _elem.nextSibling);
        });

        //money
        window.money = (amount)=>{
            return "₹" +Intl.NumberFormat('en-US').format(amount);
        }
    });
</script>

</html>