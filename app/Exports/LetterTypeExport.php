<?php

namespace App\Exports;

use App\Models\LetterType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LetterTypeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LetterType::all();
    }

    public function headings(): array
    {
        return [
            "letter_code", "name_type", "surat_tertaut",
        ];
    }

    public function map($item): array
    {
        return [
            $item['letterType']->letter_code,
            $item['letterType']->name_type,
            $item['letterType']->surat_tertaut,
        ];
    }
}
