@php
    $path = config('cms.asset_url') ? config('cms.asset_url').'/laracms/js/cms_bootstrap.js' : '/laracms/js/cms_bootstrap.js';
@endphp
<script type="text/javascript" src="{{ asset($path) }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                'blockQuote'
            ],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    }
                ]
            }
        })
        .then(editor => {
            // console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

</script>
@stack('script')
