<ul class="file-grid">
    @if (!$currentGallery->isRoot())
        <li class="col-md-1 col-sm-2 col-xs-4">
            <a href="{{ route('lara-mvcms.content-management.galleries.index', ['parent_id' => $currentGallery->parent_id, 'size' => request('size') ?: 25, 'grid' => 1]) }}" title="Parent">
                <span class="fa fa-folder"></span>
                <span class="file-title">..</span>
            </a>
        </li>
    @endif
    @foreach ($galleries as $gallery)
        <li class="col-md-2 col-sm-4 col-xs-8">
            <a href="{{ $gallery->is_directory ? route('lara-mvcms.content-management.galleries.index', ['parent_id' => $gallery->id, 'size' => request('size') ?: 25, 'grid' => 1]) : $gallery->image->publicUrl('200x200b') }}" title="{{ $gallery->title }}">
                @if ($gallery->is_directory)
                    <span class="fa {{ $gallery->is_directory ? "fa-folder" : iconByMime($gallery->image->file_type) }}"></span>
                    <span class="file-title">{{ $gallery->title }}</span>
                @else
                    <img src="{{ $gallery->image->publicUrl('200x200b') }}" alt="{{ $gallery->title }}">
                    <span class="file-title">{{ $gallery->title }}</span>
                @endif
            </a>
        </li>
    @endforeach
</ul>
