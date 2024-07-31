<tr>
    {{-- <th scope="row">
            <div class="form-check">
                <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
            </div>
        </th> --}}
    <td>{{ $catalogue->id }}</td>
    <td>{{ $indent }}<a href="#!">{{ $catalogue->name }}</a></td>
    <td>{{ $catalogue->created_at }}</td>
    <td>{{ $catalogue->updated_at }}</td>
    <td>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-warning">Sửa</a>
            <form action="{{ route('admin.catalogues.destroy', ['id' => $catalogue->id]) }}" method="POST"
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Xóa
                </button>
            </form>
        </div>

        {{-- <div class="dropdown d-inline-block">
                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="{{ route('admin.catalogues.edit', ['id' => $catalogue->id]) }}" class="dropdown-item edit-item-btn">
                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('admin.catalogues.destroy', ['id' => $catalogue->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item remove-item-btn" style="background: none; border: none; padding: 0; color: inherit;">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div> --}}
    </td>
</tr>
@if ($catalogue->children)
    @php($indent .= '-')
    @foreach ($catalogue->children as $child)
        @include('admin.catalogue.catalogue_row', ['catalogue' => $child])
    @endforeach
@endif
