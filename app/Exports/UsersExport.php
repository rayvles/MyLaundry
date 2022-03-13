<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection , WithHeadings , WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $rowNumber = 0;
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            ['No', 'Outlet', 'Name', 'Email','Password', 'Role']
        ];
    }

    public function map($user): array
    {
        return [
            ++$this->rowNumber,
            $user->id_outlet,
            $user->name,
            $user->email,
            $user->password,
            $user->role,
        ];
        
    }

    public function registerEvents(): array
    {
        return [
        AfterSheet::class => function(AfterSheet $events) {
            $events->sheet->getColumnDimension('A')->setAutoSize(true);
            $events->sheet->getColumnDimension('B')->setAutoSize(true);
            $events->sheet->getColumnDimension('C')->setAutoSize(true);
            $events->sheet->getColumnDimension('D')->setAutoSize(true);
            $events->sheet->getColumnDimension('E')->setAutoSize(true);
            $events->sheet->getColumnDimension('F')->setAutoSize(true);
           

            $events->sheet->insertNewRowBefore(1, 2);
            $events->sheet->mergeCells('A1:F1');
            $events->sheet->setCellValue('A1', 'DATA USER LAUNDRY');
            $events->sheet->getStyle('A1')->getFont()->setBold(true);
            $events->sheet->getStyle('A1')->getAlignment()->setHorizontal
            (\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $events->sheet->getStyle('A3:F'. $events->sheet->getHighestRow())->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);
        }

        
    ];
    }
    
    
}
