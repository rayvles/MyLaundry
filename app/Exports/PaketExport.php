<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Paket;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class PaketExport implements FromQuery, WithMapping, WithHeadings, WithEvents
{
     use Exportable;

    private $rowNumber = 0;

    public function whereOutlet(int $id_outlet)
    {
        $this->id_outlet = $id_outlet;
        return $this;
    }

    public function query()
    {
        return Paket::query()->with(['outlet'])->where('id_outlet', $this->id_outlet);
    }

    public function headings(): array
    {
        return ["No", "Outlet", "Nama Paket", "Jenis", "Harga", "Tgl Ditambahkan"];
    }

    public function map($paket): array
    {
        return [
            ++$this->rowNumber,
            $paket->outlet->nama,
            $paket->nama_paket,
            $paket->jenis,
            $paket->harga,
            $paket->created_at,
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('F')->setAutoSize(true);


                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->mergeCells('A2:B2');
                $event->sheet->setCellValue('A1', 'Data Layanan Laundry');
                $event->sheet->setCellValue('A2', 'Tgl : ' . date('d/m/Y'));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A3:G3')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A3:F' . $event->sheet->getHighestRow())->applyFromArray([
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
