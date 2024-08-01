<tr>
    <td>{{ $catalogue->id }}</td>
    <td>{{ $each }}<a href="#!">{{ $catalogue->name }}</a></td>
    <td>{{ $catalogue->created_at }}</td>
    <td>{{ $catalogue->updated_at }}</td>
    <td>
        <div class="d-flex gap-2">
            <a href="{{route('admin.catalogues.edit', $catalogue->id)}}" class="btn btn-warning">Sửa</a>
            <form action="{{ route('admin.catalogues.destroy', ['id' => $catalogue->id]) }}" method="POST"
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Xóa
                </button>
            </form>
        </div>
    </td>
</tr>
@if($catalogue->children)

    @php($each .= "- ")

    @foreach($catalogue->children as $child)

        @include('admin.catalogue.catalogue_row', ['catalogue' => $child])

    @endforeach

@endif
