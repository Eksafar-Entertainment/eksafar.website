<div class="position-relative">
    <div id="{{ $id }}-container"></div>
    <textarea name="{{ $attributes['name'] ?? '' }}" id="{{ $id }}-textarea" {{ $attributes }}
        class="position-absolute rich-text-textarea form-control w-100 h-100 top-0 start-0 bg-transparent"
        style="resize: none; z-index:2; pointer-events: none; color: transparent" required>{{ $slot }}</textarea>
</div>
<style>
    .rich-text-textarea::placeholder {
        color: transparent
    }
    :root {
        --ck-border-radius: 6px
    }
    .ck.ck-balloon-panel {
        z-index: 999999999999999999999999!important
    }
</style>

<script>
    $(function() {
        const _node = document.querySelector("#{{ $id }}-container");
        const _elem = document.querySelector("#{{ $id }}-textarea");
        const _editor = CKEDITOR.ClassicEditor
            .create(_node, {
                extraPlugins: [CKUploadAdapterPlugin],
                placeholder: '{{ $attributes['placeholder'] ?? '' }}',
                toolbar: {
                    items: [
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: false
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            })
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
    })
</script>
