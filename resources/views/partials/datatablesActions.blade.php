@if (in_array('view', $parts))
    <a class="btn-sm btn-xs btn-primary" href="{{ route($crudRoutePart . '.show', $row->id) }}">
        View
    </a>
@endif
@if (in_array('edit', $parts))
    <a class="btn-sm btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . 's.edit', $row->id) }}">
        Edit
    </a>
@endif
@if (in_array('delete', $parts))
    <form action="{{ route('admin.' . $crudRoutePart . 's.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are You Sure?');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn-sm btn-xs btn-danger actions-buttons" value="Delete">
    </form>
@endif
