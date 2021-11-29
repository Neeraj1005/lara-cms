<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Create Post') }}</h1>
        </x-slot>
        <div class="card">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <x-cms::button class="btn btn-sm btn-primary float-right mx-1" name="postType"
                            value="{{ Neeraj1005\Cms\Models\Post::TYPE_PUBLISHED }}">
                            {{ __('Publish') }}</x-cms::button>
                        <x-cms::button class="btn btn-sm btn-outline-secondary float-right mx-1" name="postType"
                            value="{{ Neeraj1005\Cms\Models\Post::TYPE_DRAFT }}">
                            {{ __('Draft') }}</x-cms::button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <x-cms::label for="title" :value="__('Title')" />
                                <x-cms::input type="text" name="title" id="title"
                                    value="{{ old('title') }}" />
                                <x-cms::auth-validation-errors :error="__('title')" />
                            </div>

                            <div class="form-group">
                                <x-cms::label for="description" :value="__('Description')" />
                                <textarea name="body" id="description" class="form-control" cols="30"
                                    rows="10">{{ old('description') }}</textarea>
                                <x-cms::auth-validation-errors :error="__('body')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-cms::label for="category" :value="__('Category')" />
                                <select class="form-control" name="category" id="category">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <x-cms::auth-validation-errors :error="__('category')" />
                            </div>
                            <div class="form-group">
                                <x-cms::label for="picture" :value="__('Featured Image')" />
                                <x-cms::input type="file" name="picture" id="picture" aria-describedby="fileHelp" />
                                <small id="fileHelp" class="form-text text-muted">
                                    {{ __('Please upload a valid image file. Size of image should not be more than 2MB.') }}
                                </small>
                                <x-cms::auth-validation-errors :error="__('picture')" />
                            </div>

                            <div class="form-group">
                                <x-cms::label for="tags" :value="__('Tags')" />
                                <x-cms::input type="text" name="tags" id="tags" class="form-control"
                                    value="{{ old('tags') }}" />
                                <small id="tags" class="text-muted">
                                    {{ __('Separate tags with commas') }}
                                </small>
                                <x-cms::auth-validation-errors :error="__('tags')" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-cms::content-wrapper>
    @push('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
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
                if (this.xhr) {
                    this.xhr.abort();
                }
            }
            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open('POST', '{{ route('cms.imageupload') }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
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
                        return reject(response && response.error ? response.error.message :
                            genericErrorText);
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
            // ...
        }

        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor.create(document.querySelector("#description"), {
                extraPlugins: [SimpleUploadAdapterPlugin],
            })
            .then((editor) => {
                if (editor.sourceElement.labels.length > 0) {
                    editor.sourceElement.labels[0].addEventListener('click', e => editor.editing.view.focus());
                }
            })
            .catch((error) => {
                console.error("someting went wrong in your editor", error);
            });

    </script>

    @endpush
</x-cms::layouts.app>
