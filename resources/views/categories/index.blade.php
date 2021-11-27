<x-cms::layouts.app>
    <x-cms::content-wrapper>

        <x-slot name="header">
            <h1>
                {{ __('Category') }}
            </h1>
        </x-slot>

        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary float-right" href="{{ route('posts.categories.create') }}">{{ __('New Category') }}</a>
            </div>
            <div class="card-body">
                <x-cms::table>
                    <x-slot name="tableHeading">
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Posts') }}</th>
                        <th>{{ __('Action') }}</th>
                    </x-slot>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <a
                                    href="{{ route('home.cms', ['category' => $category->slug]) }}"
                                    target="_new"
                                    rel="noopener noreferrer">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td>
                                {{ $category->cms_posts_count ?? '' }}
                            </td>
                            <td>
                                <x-cms::table-action-btn>
                                    <small>
                                        <a class="dropdown-item text-default text-btn-space"
                                            href="{{ route('posts.categories.edit', $category->id) }}">
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="dropdown-item text-default text-btn-space" href="#" type="submit"
                                            role="button" onclick="event.preventDefault();
                                            if(confirm('Are you sure!')){
                                                $('#form-delete-{{ $category->id }}').submit();
                                            }
                                        ">
                                            {{ __('Delete') }}
                                        </a>
                                        <form style="display:none" id="form-delete-{{ $category->id }}"
                                            action="{{ route('posts.categories.destroy',$category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </small>
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
                {{ $categories->links() }}
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
