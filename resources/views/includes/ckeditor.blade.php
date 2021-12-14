<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        extraPlugins: 'embed,autoembed,image2',
        
        // Load the default contents.css file plus customizations for this sample.
        contentsCss: [
            'http://cdn.ckeditor.com/4.17.1/full-all/contents.css',
            'https://ckeditor.com/docs/ckeditor4/4.17.1/examples/assets/css/widgetstyles.css'
        ],

        // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
        embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

        // upload image ckFinder
        filebrowserUploadUrl: "{{ route('cms.imageupload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });

</script>
