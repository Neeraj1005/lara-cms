<x-cms::layouts.app>
    <x-slot name="appTitle">
        {{ __('Media Library') }}
    </x-slot>

    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>
                {{ __('Media') }}
            </h1>
        </x-slot>

        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-primary float-right"
                                href="{{ route('cms.media.create') }}">{{ __('Add Media') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-cms::table>
                            <x-slot name="tableHeading">
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Action') }}</th>
                            </x-slot>
                            @forelse($mediaLib as $media)
                                <tr>
                                    <td>{{ optional($media)->file_name }}</td>
                                    <td>
                                        <x-cms::table-action-btn>
                                            <a class="dropdown-item text-default text-btn-space"
                                                href="{{ route('cms.media.edit', $media->id) }}">
                                                {{ __('Edit') }}
                                            </a>
                                            <a class="dropdown-item text-default text-btn-space" href="#" type="submit"
                                                role="button" onclick="event.preventDefault();
                                                            if(confirm('Are you sure!')){
                                                                $('#form-delete-{{ $media->id }}').submit();
                                                            }
                                                        ">
                                                {{ __('Delete') }}
                                            </a>
                                            <form style="display:none" id="form-delete-{{ $media->id }}"
                                                action="{{ route('cms.media.destroy',$media->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </x-cms::table-action-btn>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        {{ __('Data not available') }}
                                    </td>
                                </tr>
                            @endforelse
                        </x-cms::table>
                    </div>
                    <div class="card-footer">
                        {{ $mediaLib->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
