<x-cms::layouts.app>
    <x-cms::content-wrapper>

        <x-slot name="header">
            <h1>
                {{ __('Posts') }}
            </h1>
        </x-slot>

        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('posts.index', ['type' => Neeraj1005\Cms\Models\Post::TYPE_PUBLISHED]) }}"
                            class="btn {{ (request('type') == null)|| (request('type') == Neeraj1005\Cms\Models\Post::TYPE_PUBLISHED) ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            {{ __('Published') }}
                        </a>
                        <a href="{{ route('posts.index', ['type' => Neeraj1005\Cms\Models\Post::TYPE_DRAFT]) }}"
                            class="btn {{ request('type') == Neeraj1005\Cms\Models\Post::TYPE_DRAFT ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            {{ __('Draft') }}
                        </a>
                        <a href="{{ route('posts.index', ['type' => Neeraj1005\Cms\Models\Post::TYPE_TRASH]) }}"
                            class="btn {{ request('type') == Neeraj1005\Cms\Models\Post::TYPE_TRASH ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            {{ __('Trash') }}
                        </a>

                        <div class="card-tools">
                            <a class="btn btn-primary float-right"
                                href="{{ route('posts.create') }}">{{ __('New Post') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-cms::table>
                            <x-slot name="tableHeading">
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Views') }}</th>
                                <th>{{ __('Action') }}</th>
                            </x-slot>
                            @forelse($posts as $post)
                                <tr>
                                    <td>
                                        @if($post->picture)
                                            <img src="{{ asset($post->profileImage()) }}" width="5%"
                                                alt="{{ $post->slug }}">
                                        @endif
                                        <a href="{{ route('home.cms.show', $post->slug) }}"
                                            target="_blank" rel="noopener">{{ $post->title }}</a>
                                    </td>
                                    <td>
                                        {{ $post->cms_category->name ?? '' }}
                                    </td>

                                    <td>
                                        {{ $post->created_at->isoFormat('DD/M/YYYY') }}
                                    </td>

                                    <td>
                                        {{ $post->views ?? '' }}
                                    </td>

                                    <td>
                                        <x-cms::table-action-btn>
                                            <a class="dropdown-item text-default text-btn-space"
                                                href="{{ route('posts.edit', $post->id) }}">
                                                {{ __('Edit') }}
                                            </a>
                                            <a class="dropdown-item text-default text-btn-space" href="#" type="submit"
                                                role="button" onclick="event.preventDefault();
                                                        if(confirm('Are you sure!')){
                                                            $('#form-delete-{{ $post->id }}').submit();
                                                        }
                                                    ">
                                                {{ __('Delete') }}
                                            </a>
                                            <form style="display:none" id="form-delete-{{ $post->id }}"
                                                action="{{ route('posts.destroy',$post->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </x-cms::table-action-btn>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>{{ __('Data not available') }}</td>
                                </tr>
                            @endforelse
                        </x-cms::table>
                    </div>
                    <div class="card-footer">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
