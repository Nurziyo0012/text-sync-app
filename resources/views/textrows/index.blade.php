@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Yozuvlar ro‘yxati</h2>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ route('textrows.create') }}" class="btn btn-primary">➕ Yangi qo‘shish</a>

     <form action="{{ route('generate') }}" method="POST">@csrf
    <button type="submit">1000 ta yozuv yaratish</button>
</form>

<form action="{{ route('clear') }}" method="POST">@csrf
    <button type="submit">Jadvalni tozalash</button>
</form>

<form action="{{ route('import') }}" method="POST">@csrf
    <input type="url" name="sheet_url" placeholder="Google Sheet URL">
    <button type="submit">Import qilish</button>
</form>

        <form method="GET" action="{{ route('textrows.index') }}">
    <input type="text" name="search" placeholder="Qidiruv..." class="form-control">
</form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Matn</th>
                <th>Status</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->text }}</td>
                    <td>
                        <span class="badge {{ $row->status === 'Allowed' ? 'bg-success' : 'bg-danger' }}">
                            {{ $row->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('textrows.edit', $row->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('textrows.destroy', $row->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
