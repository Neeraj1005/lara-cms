<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Edit Post') }}</h1>
        </x-slot>

        <div class="card">
            <form action="{{ route('posts.update', $post->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <x-cms::button class="btn btn-sm btn-primary float-right mx-1" name="postType" value="publish">
                            {{ __('Publish') }}</x-cms::button>
                        <x-cms::button class="btn btn-sm btn-outline-secondary float-right mx-1" name="postType"
                            value="draft">{{ __('Draft') }}</x-cms::button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <x-cms::label for="title" :value="__('Title')" />
                                <x-cms::input type="text" name="title" id="title"
                                    value="{{ old('title', $post->title) }}" />
                                <x-cms::auth-validation-errors :error="__('title')" />
                            </div>

                            <div class="form-group">
                                <x-cms::label for="description" :value="__('Description')" />
                                <textarea name="body" id="description" class="form-control" cols="30"
                                    rows="10">{{ old('body', $post->body) }}</textarea>
                                <x-cms::auth-validation-errors :error="__('body')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-cms::label for="category" :value="__('Category')" />
                                <select class="form-control" name="category" id="category">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" {{ $post->cms_category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-cms::content-wrapper>
    @push('script')
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
                console.error('someting went wrong in your editor',error);
            });
    
    </script>
    @endpush
</x-cms::layouts.app>
