<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ route('cms.imageupload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
