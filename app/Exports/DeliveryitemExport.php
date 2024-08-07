<?php

namespace App\Exports;

use App\Models\Deliveryitem;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class DeliveryitemExport implements WithColumnFormatting, FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('deliverynotes AS dn')
        ->select('dn.letter', 'dn.date', 'sd.name AS SenderName', 'dn.name_sender', 'dn.phone_sender', 'rd.name AS RecipientName', 'dn.name_recipient', 'dn.phone_recipient', 'di.code', 'di.name AS DeliveryItemName', 'di.quantity', 'di.unit', 'di.bale', 'di.price', 'di.weight', 'di.description', 'di.purchase_order', 'di.date_request', 'dn.date_recipient', 'dn.via', 'dn.estimated_delivery', 'dn.notes')
        ->rightJoin('deliveryitems AS di', 'dn.id', '=', 'di.deliverynote_id')
        ->leftJoin('droppoints AS sd', 'dn.sender_id', '=', 'sd.id')
        ->leftJoin('droppoints AS rd', 'dn.recipient_id', '=', 'rd.id')
        ->whereNull('di.deleted_at')
        ->get();
    }

    public function headings(): array
    {
        return ['NO SURAT JALAN', 'TANGGAL', 'PENGIRIM', 'UP PENGIRIM', 'NO TELP PENGIRIM', 'PENERIMA', 'UP PENERIMA', 'NO TELP PENERIMA', 'KBL', 'NAMA BARANG', 'JUMLAH', 'UNIT', 'PACKING', 'HARGA TOTAL', 'BERAT TOTAL', 'KETERANGAN', 'NO NOTA ATAU PO', 'TANGGAL PENGAJUAN', 'TANGGAL TERIMA', 'DIKIRIM MELALUI', 'ESTIMASI SAMPAI', 'CATATAN SURAT JALAN'];
    }

    public function columnFormats(): array
    {
        return ['E' => NumberFormat::FORMAT_NUMBER, 'H' => NumberFormat::FORMAT_NUMBER];
    }
}