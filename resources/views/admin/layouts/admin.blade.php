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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"
        integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js"
        integrity="sha512-pgmLgtHvorzxpKra2mmibwH/RDAVMlOuqU98ZjnyZrOZxgAR8hwL8A02hQFWEK25V40/9yPYb/Zc+kyWMplgaA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css"
        integrity="sha512-w4sRMMxzHUVAyYk5ozDG+OAyOJqWAA+9sySOBWxiltj63A8co6YMESLeucKwQ5Sv7G4wycDPOmlHxkOhPW7LRg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body class="">
    <div id="preloader" class="position-fixed align-items-center justify-content-center py-1 px-3 shadow-sm"
        style="background-color: #f8facf;  backdrop-filter: blur(20px); z-index: 999999999; top: 80px; left: 50%; transform:translateX(-50%); display: none">
        Please wait while loading...
    </div>
    <div class="d-flex flex-column" style="height: 100vh;">
        @include('admin.layouts.partials.navbar')
        <div>
            @yield('subnav')
        </div>
        <main class="flex-grow-1 overflow-auto">

            <div class="container-lg py-4">
                @yield('content')
            </div>
            <div class="text-center p-2 py-3">
                <small>Made by <a href="https://www.xpeed.co.in">Xpeed Technologies</a></small>
            </div>
        </main>

    </div>

    @section('scripts')

    @show

    <div class="modal fade" id="ask-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <p id="message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" id="cancel-btn">NO</button>
                    <button type="button" class="btn btn-sm btn-primary" id="confirm-btn">YES</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cropper-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header mb-0">
                    <h5 class="modal-title" id="title">Confirm</h5>
                </div>
                <div class="modal-body p-0 mt-0">
                    <div id="preview"
                        style="width: 100%; padding-top:100%; background-size:cover; background-position:center"></div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" id="cancel-btn">NO</button>
                    <button type="button" class="btn btn-sm btn-primary" id="confirm-btn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    class CKUploadAdapter {
        constructor(loader) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }


        // Starts the upload process.
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }

        // Aborts the upload process.
        abort() {
            // Reject the promise returned from the upload() method.
            server.abortUpload();
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open('POST', '{{ url('/admin/files/ck-upload') }}', true);
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            xhr.setRequestHeader('X-Requested-With', "XMLHttpRequest");
            xhr.responseType = 'json';
        }
        // Initializes XMLHttpRequest listeners.
        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve({
                    default: response.url
                });
            });

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }
        // Prepares the data and sends the request.
        _sendRequest(file) {
            // Prepare the form data.
            const data = new FormData();

            data.append('upload', file);

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send(data);
        }
    }

    function CKUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            // Configure the URL to the upload script in your back-end here!
            return new CKUploadAdapter(loader);
        };
    }
</script>
<script>
    $(document).ready(() => {
        //
        function ___postAjax(){
            document.querySelectorAll("input[type=datetime]:not(.flatpickr-input)").forEach(_elm => {
                flatpickr(_elm, {
                    enableTime: true,
                });
            });
        }
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
            ___postAjax();
        });

        //axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
        axios.interceptors.request.use(function(config) {
            $("#preloader").fadeIn();
            return config;
        }, function(error) {
            $("#preloader").fadeOut();
            return Promise.reject(error);
        });
        axios.interceptors.response.use(function(response) {
            $("#preloader").fadeOut();
            return response;
        }, function(error) {
            $("#preloader").fadeOut();
            return Promise.reject(error);
        });


        //money
        const ask_modal_container = document.getElementById('ask-modal');
        const ask_modal = new bootstrap.Modal(ask_modal_container, {
            backdrop: 'static',
            keyboard: false,
        });
        window.ask = async (message) => {
            return new Promise((resolve, reject) => {
                ask_modal_container.querySelector("#message").innerHTML = message;
                ask_modal_container.querySelector("#confirm-btn").onclick = () => {
                    ask_modal.hide();
                    resolve(true);
                }
                ask_modal_container.querySelector("#cancel-btn").onclick = () => {
                    ask_modal.hide();
                    reject(false);
                }
                ask_modal.show();
            });
        }


        //flatpicker 
        ___postAjax();

    });
</script>

</html>
