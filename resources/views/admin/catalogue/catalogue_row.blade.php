<!-- catalogue_row.blade.php -->

<tr>
    <td>{{ $catalogue->id }}</td>
    <td>{{ $each }}<a href="#!">{{ $catalogue->name }}</a></td>
    <td>{{ $catalogue->created_at }}</td>
    <td>{{ $catalogue->updated_at }}</td>
    <td>
        <div class="d-flex gap-2">
            <a href="{{route('admin.catalogues.edit', $catalogue->id)}}" class="btn btn-warning">Sửa</a>
            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $catalogue->id }}">Xóa</button>
        </div>
    </td>
</tr>
@if($catalogue->children)

    @php($each .= "- ")

    @foreach($catalogue->children as $child)

        @include('admin.catalogue.catalogue_row', ['catalogue' => $child])

    @endforeach

@endif
