<x-layout>
    <h1 class="mb-4">Pievienot jaunu produktu</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nosaukums</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Apraksts</label>
            <textarea name="description" id="description" rows="3"
                class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Cena (€)</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}"
                required>
        </div>

        <button type="submit" class="btn btn-success">Saglabāt</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Atpakaļ</a>
    </form>
</x-layout>