<option {{ $product->catalogue_id == $catalog->id ? 'selected' : '' }} value="{{ $catalog->id }}">
    {{ $indent }}{{ $catalog->name }}</option>

@if ($catalog->children)
    @php($indent .= '- ')
    @foreach ($catalog->children as $child)
        @include('admin.product.catalogue_edit', ['catalog' => $child])
    @endforeach
@endif
