<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BarangExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    use Exportable;
    private $rowNumber = 0;

    /**
    * Membuat Function Mengambil Semua data Barang
    *
    *
    */
    public function collection()
    {
        return Barang::all();
    }

    /**
    * Membuat Function Penambahan Heading pada Saat Export Excel
    *
    *
    */
    public function headings(): array
    {
        return ["No", "Nama Barang", "Qty", "Harga",  "Waktu Beli", "Supplier", "Status Barang", "Waktu Updated Status"];
    }

    /**
    * Membuat Function Export pada saat data dimasukan kedalam excel
    *
    * @param $barang
    *
    */
    public function map($barang): array
    {
        $status_barang = '';
        switch ($barang->status_barang) {
            case 'diajukan_beli':
                $status_barang = 'Diajukan Beli';
                break;
            case 'habis':
                $status_barang = 'habis';
                break;
            case 'tersedia':
                $status_barang = 'tersedia';
                break;
            default:
                $status_barang = '-';
        }

        return [
            ++$this->rowNumber,
            $barang->nama_barang,
            $barang->qty,
            $barang->harga,
            $barang->waktu_beli,
            $barang->supplier,
            $barang->waktu_updated_status,
            $status_barang,
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
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);


                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:B2');
                $event->sheet->mergeCells('C2:D2');
                $event->sheet->setCellValue('A1', 'Data Barang');
                $event->sheet->setCellValue('A2', 'Tgl : ' . date('d/m/Y'));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A3:F3')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A3:H' . $event->sheet->getHighestRow())->applyFromArray([
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
