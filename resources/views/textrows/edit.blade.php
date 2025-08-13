@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">✏️ Yozuvni tahrirlash</h2>

    <form action="{{ route('textrows.update', $textrow->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="text" class="form-label">Matn:</label>
            <input type="text" name="text" class="form-control" value="{{ $textrow->text }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" class="form-select" required>
                <option value="Allowed" {{ $textrow->status === 'Allowed' ? 'selected' : '' }}>Allowed</option>
                <option value="Prohibited" {{ $textrow->status === 'Prohibited' ? 'selected' : '' }}>Prohibited</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">💾 Yangilash</button>
        <a href="{{ route('textrows.index') }}" class="btn btn-secondary">⬅️ Orqaga</a>
    </form>
</div>
@endsection