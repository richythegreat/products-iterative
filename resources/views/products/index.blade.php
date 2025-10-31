@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Produkti</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Pievienot jaunu produktu</a>

    @if($products->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nosaukums</th>
                <th>Cena</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }} €</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Skatīt</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Rediģēt</a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Vai tiešām dzēst?')">Dzēst</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nav pievienots neviens produkts.</p>
    @endif
</div>
@endsection