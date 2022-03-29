<?php

namespace App\Exports;

use App\Models\Outlet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OutletExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{

    use Exportable;
    private $rowNumber = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Outlet::all();
    }

      /**
    * Membuat Function Penambahan Heading pada Saat Export Excel
    *
    *
    */
    public function headings(): array
    {
        return ["No", "Nama", "Alamat", "Telepon"];
    }

    /**
    * Membuat Function Export pada saat data dimasukan kedalam excel
    *
    * @param $outlet
    *
    */
    public function map($outlet): array
    {

        return [
            ++$this->rowNumber,
            $outlet->nama,
            $outlet->alamat,
            $outlet->telepon,

        ];
    }

     /**
    * Membuat Function Untuk Merapihkan table Pada saat Export
    *
    *
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);




                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:B2');
                $event->sheet->mergeCells('C2:D2');
                $event->sheet->setCellValue('A1', 'Data Outlet');
                $event->sheet->setCellValue('A2', 'Tgl : ' . date('d/m/Y'));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A3:F3')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A3:D' . $event->sheet->getHighestRow())->applyFromArray([
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
