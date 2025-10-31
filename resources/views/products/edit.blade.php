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
            <label for="name" class="form-label">Nosaukums</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Apraksts</label>
            <textarea name="description" id="description" rows="3"
                class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Cena (€)</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01"
                value="{{ old('price', $product->price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atjaunināt</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Atpakaļ</a>
    </form>
</x-layout>