<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Paket;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TransaksiExport implements FromQuery, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

    private $rowNumber = 0;

    public function whereOutlet(int $id_outlet)
    {
        $this->outlet = Outlet::find($id_outlet);
        $this->id_outlet = $id_outlet;
        return $this;
    }

    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
        return $this;
    }

    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Transaksi::query()->with(['details'])->where('id_outlet', $this->id_outlet)->whereBetween('tgl', [$this->dateStart, $this->dateEnd]);
    }

    public function headings(): array
    {
        return ["No", "Kode Invoice", "Jumlah Cucian", "Tgl Pemberian", "Estimasi Selesai", "Status Cucian", "Status Pembayaran", "Total Biaya"];
    }

    public function map($transaksi): array
    {
        switch ($transaksi->status) {
            case 'baru':
                $transaksi->status = 'Baru';
                break;
            case 'proses':
                $transaksi->status = 'Diproses';
                break;
            case 'selesai':
                $transaksi->status = 'Selesai';
                break;
            case 'diambil':
                $transaksi->status = 'Diambil';
                break;
            default:
                $transaksi->status = '';
                break;
        }

        switch ($transaksi->status_pembayaran) {
            case 'dibayar':
                $transaksi->status_pembayaran = 'Dibayar';
                break;
            default:
                $transaksi->status_pembayaran = 'Belum Dibayar';
                break;
        }

        return [
            ++$this->rowNumber,
            $transaksi->kode_invoice,
            $transaksi->details()->count(),
            date('d/m/Y', strtotime($transaksi->tgl)),
            date('d/m/Y', strtotime($transaksi->deadline)),
            $transaksi->status,
            $transaksi->status_pembayaran,
            $transaksi->getTotalPayment(),
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
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);

                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:H1');
                $event->sheet->mergeCells('A2:B2');
                $event->sheet->mergeCells('G2:H2');
                $event->sheet->setCellValue('A1', 'Riwayat Transaksi Laundry');
                $event->sheet->setCellValue('A2', 'Outlet : ' . $this->outlet->nama);
                $event->sheet->setCellValue('G2', 'Tgl : ' . date('d/m/Y', strtotime($this->dateStart)) . ' - ' . date('d/m/Y', strtotime($this->dateEnd)));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A3:H3')->getFont()->setBold(true);
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
