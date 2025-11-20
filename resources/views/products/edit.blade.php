<x-layout>
    <h1 class="mb-4">Rediģēt produktu</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nosaukums</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Apraksts</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Cena (€)</label>
            <input type="number" name="price" class="form-control"
                step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        {{-- TAGS --}}
<div class="mb-3" style="position:relative;">
    <label class="form-label">Birkas</label>

    <input type="text" id="tagInput" class="form-control" autocomplete="off" placeholder="Sāc rakstīt...">

    <div id="tagSuggestions" class="autocomplete-list"></div>

    <div id="tagContainer" class="tag-container" style="margin-top:10px;">
        @foreach ($product->tags as $tag)
            <span class="tag-chip" data-name="{{ $tag->name }}">
                {{ $tag->name }} <button class="remove-tag">x</button>
            </span>
        @endforeach
    </div>

    <input type="hidden" name="tags" id="tagsHidden">
</div>

<script src="{{ asset('js/app.js') }}"></script>

</x-layout>
