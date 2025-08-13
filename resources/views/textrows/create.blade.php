@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Yangi yozuv qo‘shish</h2>

    <form action="{{ route('textrows.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="text" class="form-label">Matn:</label>
            <input type="text" name="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" class="form-select" required>
                <option value="Allowed">Allowed</option>
                <option value="Prohibited">Prohibited</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">💾 Saqlash</button>
        <a href="{{ route('textrows.index') }}" class="btn btn-secondary">⬅️ Orqaga</a>
    </form>
</div>
@endsection