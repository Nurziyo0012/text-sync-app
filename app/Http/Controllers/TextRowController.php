<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TextRow;
use Illuminate\Support\Str;
use App\Services\GoogleSheetService;

class TextRowController extends Controller
{
    public function index(Request $request)
{
    $rows = \App\Models\TextRow::all();
        $query = TextRow::query();

    if ($request->has('search')) {
        $query->where('text', 'like', '%' . $request->search . '%');
    }

    $textrows = $query->paginate(10);
    return view('textrows.index', compact('rows'));
}

public function create()
{
    return view('textrows.create');
}

public function store(Request $request)
{
    $request->validate([
        'text' => 'required|string',
        'status' => 'required|in:Allowed,Prohibited',
    ]);

    TextRow::create($request->all());
    return redirect()->route('textrows.index')->with('success', 'Row added!');
}

public function edit(TextRow $textrow)
{
    return view('textrows.edit', compact('textrow'));
}

public function update(Request $request, TextRow $textrow)
{
    $request->validate([
        'text' => 'required|string',
        'status' => 'required|in:Allowed,Prohibited',
    ]);

    $textrow->update($request->all());
    return redirect()->route('textrows.index')->with('success', 'Row updated!');
}

public function destroy(TextRow $textrow)
{
    $textrow->delete();
    return redirect()->route('textrows.index')->with('success', 'Row deleted!');
}

public function generate()
{
    $statuses = ['Allowed', 'Prohibited'];
    $rows = [];

    for ($i = 0; $i < 1000; $i++) {
        $rows[] = [
            'text' => 'Random text ' . Str::random(10),
            'status' => $statuses[$i % 2], // teng taqsimlangan
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    TextRow::insert($rows);

    return redirect()->back()->with('success', '1000 ta yozuv yaratildi!');
}

public function clear()
{
    TextRow::truncate();
    return redirect()->back()->with('success', 'Jadval tozalandi!');
}

public function import(Request $request)
{
    $request->validate([
        'sheet_url' => 'required|url'
    ]);

    // .env faylga yozish (yoki config faylga)
    file_put_contents(base_path('.env'), preg_replace(
        '/GOOGLE_SHEET_URL=.*/',
        'GOOGLE_SHEET_URL=' . $request->sheet_url,
        file_get_contents(base_path('.env'))
    ));

    return redirect()->back()->with('success', 'Google Sheet URL saqlandi!');
}




public function testSheet(GoogleSheetService $sheet)
{
    $sheet->write([
        ['ID', 'Text', 'Status'],
        [1, 'Salom', 'Allowed'],
        [2, 'Xayr', 'Prohibited'],
    ]);

    return 'Google Sheetga yozildi!';
}

public function syncToSheet(GoogleSheetService $sheet)
{
    $rows = TextRow::allowed()->get()->map(function ($item) {
        return [
            $item->id,
            $item->text,
            $item->status,
        ];
    })->toArray();

    $sheet->write($rows);

    return 'Sinxronizatsiya yakunlandi!';
}
}
