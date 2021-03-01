<script type="text/javascript">

    $(document).ready(function () {
        $('.ckeditor').ckeditor();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // init quill editor
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{'header': 1}, {'header': 2}],               // custom button values
            [{'list': 'ordered'}, {'list': 'bullet'}],
            [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
            [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
            [{'direction': 'rtl'}],                         // text direction

            [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
            [{'header': [1, 2, 3, 4, 5, 6, false]}],

            [{'color': []}, {'background': []}],          // dropdown with defaults from theme
            [{'font': []}],
            [{'align': []}],
            ['link', 'image'],
            ['clean']                                         // remove formatting button
        ];

        const editor = new Quill('#editor', {
            modules: {
                toolbar:     toolbarOptions,
                imageResize: {}
            },
            theme:   'snow'
        });

        editor.root.innerHTML = '{!! old('body') ? (old('body')) :  ($news->body ?? '') !!}';

        // handle quill upload image

        /**
         * Step1. select image
         *
         */
        function selectLocalImage() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.click();

            // Listen upload local image and save to server
            input.onchange = () => {
                const file = input.files[0];

                // file type is only image.
                if (/^image\//.test(file.type)) {
                    saveToServer(file);
                } else {
                    console.warn('You could only upload images.');
                }
            };
        }

        /**
         * Step2. save to server
         *
         * @param {File} file
         */
        function saveToServer(file) {


            var formdata = new FormData(); // high importance!

            formdata.append('file', file);

            $.ajax({
                url:         "",
                type:        "POST",
                data:        formdata,
                dataType:    'json',
                processData: false,
                contentType: false,
                success:     function (response) {
                    if (response.success) {
                        let url = response.url;
                        insertToEditor(url)
                    }
                },
            });
        }

        /**
         * Step3. insert image url to rich editor.
         *
         * @param {string} url
         */
        function insertToEditor(url) {
            // push image url to rich editor.
            const range = editor.getSelection();
            editor.insertEmbed(range.index, 'image', url);
        }

        // quill editor add image handler
        editor.getModule('toolbar').addHandler('image', () => {
            selectLocalImage();
        });

        $("form").on("submit", function () {
            let hvalue = $('.ql-editor').html();
            $(this).append("<textarea name='body' style='display:none'>" + hvalue + "</textarea>");
        });

    });


</script>
