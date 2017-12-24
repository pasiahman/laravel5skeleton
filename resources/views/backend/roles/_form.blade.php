@if ($role->id)
    <form action="{{ route('backend.roles.update', $role->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $role->id }}" />
@else
    <form action="{{ route('backend.roles.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="form-group">
                <label>@lang('validation.attributes.name') (*)</label>
                <input class="form-control" name="name" required type="text" value="{{ request()->old('name', $role->name) }}" />
                <i class="text-danger">{{ $errors->first('name') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.guard_name') (*)</label>
                <input class="form-control" name="guard_name" readonly required type="text" value="{{ request()->old('guard_name', $role->guard_name) }}" />
                <i class="text-danger">{{ $errors->first('guard_name') }}</i>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">@lang('cms.permissions')</div>
                <div class="panel-body" style="max-height: 300px; overflow: auto;">
                    @forelse ($permissions as $i => $permission)
                        <div class="checkbox">
                            <label>
                                <input
                                    @if (is_array(request()->old('permissions')))
                                        {{ in_array($permission->name, request()->old('permissions')) ? 'checked' : '' }}
                                    @else
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                    @endif
                                    name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                />
                                {{ $permission->name }}
                            </label>
                        </div>
                    @empty
                        @lang('cms.no_data')
                    @endforelse
                </div>
            </div>
        </div>
        <div class="box-footer">
            <input class="btn btn-default" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
