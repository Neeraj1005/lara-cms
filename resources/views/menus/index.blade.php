<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>
                {{ __('Menus') }}
            </h1>
        </x-slot>

        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-primary float-right"
                                href="{{ route('cms.menus.create') }}">{{ __('New Menu') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-cms::table>
                            <x-slot name="tableHeading">
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Url') }}</th>
                                <th>{{ __('Action') }}</th>
                            </x-slot>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name }}</td>

                                    <td>{{ $menu->url }}</td>

                                    <td>
                                        <x-cms::table-action-btn>
                                            <a class="dropdown-item text-default text-btn-space"
                                                href="{{ route('cms.menus.edit', $menu->slug) }}">
                                                {{ __('Edit') }}
                                            </a>
                                            <a class="dropdown-item text-default text-btn-space" href="#" type="submit"
                                                role="button" onclick="event.preventDefault();
                                                        if(confirm('Are you sure!')){
                                                            $('#form-delete-{{ $menu->slug }}').submit();
                                                        }
                                                    ">
                                                {{ __('Delete') }}
                                            </a>
                                            <form style="display:none" id="form-delete-{{ $menu->slug }}"
                                                action="{{ route('cms.menus.destroy',$menu->slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </x-cms::table-action-btn>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('Data not available') }}</td>
                                </tr>
                            @endforelse
                        </x-cms::table>
                    </div>
                    <div class="card-footer">
                        {{ $menus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
