{{-- resources/views/layouts/partials/catalogue_item.blade.php --}}
<li>
    <span><a href="#">{{ $catalogue->name }}</a></span>
    @if ($catalogue->childrenRecursive->isNotEmpty())
        <ul>
            @foreach ($catalogue->childrenRecursive as $child)
                @include('Component.user.catalogue_row', ['catalogue' => $child])
            @endforeach
        </ul>
    @endif
</li>
