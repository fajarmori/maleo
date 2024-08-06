<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Delivery Note</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<style>@page { margin:0px; }</style>
    <body style="font-size:.75rem; margin:0px; overflow:hidden;">
        <header style="position:fixed; top:0; left:0; right:0;"><img src="{{asset('/storage/images/general/kop_surat_header_a4_portrait.png')}}" alt="kop_surat_header_a4_portrait" style="width:100%;"></header>
            <div style="padding-top:135px; padding-right:60px; padding-left:60px;">
                <div style="text-align:center; margin-bottom:10px;">
                    <div class="itemTableHeader" style="font-size:1rem;"><b><u>SURAT JALAN</u></b></div>
                    <div>{{ $deliverynote->letter }}</div>
                </div>
                <div style="text-align:right; margin-bottom:10px;">Tanggal pengiriman: {{ \Carbon\Carbon::parse($deliverynote->date)->locale('ID')->isoFormat('DD MMMM Y') }}</div>
                <table style="width:100%; margin-bottom:25px;">
                    <tbody style="vertical-align:top;">
                        <tr>
                            <td style="width:13%;">Pengirim</td>
                            <td style="width:1%;">:</td>
                            <td style="width:33%;"><b>{{ $deliverynote->sender->name }}</b></td>
                            <td style="width:4%;"></td>
                            <td style="width:13%;">Penerima</td>
                            <td style="width:1%;">:</td>
                            <td style="width:33%;"><b>{{ $deliverynote->recipient->name }}</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <div>{!! substr($deliverynote->sender->name,0,6) == 'DIVISI' ? '<b>PT MALEO RACHMA INDO ABADI</b>' : '' !!}</div>
                                <div style="text-align:justify;">{{ $deliverynote->sender->address }}</div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div>{!! substr($deliverynote->recipient->name,0,6) == 'DIVISI' ? '<b>PT MALEO RACHMA INDO ABADI</b>' : '' !!}</div>
                                <div style="text-align:justify;">{{ $deliverynote->recipient->address }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>UP</td>
                            <td>:</td>
                            <td style="text-transform:capitalize;"><b>{{ $deliverynote->name_sender }}</b></td>
                            <td></td>
                            <td>UP</td>
                            <td>:</td>
                            <td style="text-transform:capitalize;"><b>{{ $deliverynote->name_recipient }}</b></td>
                        </tr>
                        <tr>
                            <td>No Telpon</td>
                            <td>:</td>
                            <td>{{ $deliverynote->phone_sender }}</td>
                            <td></td>
                            <td>No Telpon</td>
                            <td>:</td>
                            <td>{{ $deliverynote->phone_recipient }}</td>
                        </tr>
                    </tbody>
                </table>
                <div>Dengan Hormat,</div>
                <div style="text-align:justify; margin-bottom:10px;">
                    Bersamaan dengan surat ini, kami sampaikan informasi barang yang dikirim. Berikut detail barang yang dilakukan pengiriman:
                </div>
                <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                    <tbody style="text-align:center; vertical-align:top; border:1px solid black;">
                        <tr style="border:1px solid black; background-color:lightblue;-webkit-print-color-adjust:exact;color-adjust:exact;">
                            <th style="width:1%; border:1px solid black;">No.</th>
                            <th style="width:32%; border:1px solid black;">Nama Barang</th>
                            <th style="width:5%; border:1px solid black;">Qty</th>
                            <th style="width:8%; border:1px solid black;">Satuan</th>
                            <th style="width:10%; border:1px solid black;">Packing</th>
                            <th style="width:30%; border:1px solid black;">Keterangan</th>
                            <th style="border:1px solid black;" colspan="2">Ceklis</th>
                            <th style="width:8%; border:1px solid black;">KBL</th>
                        </tr>
                        @foreach($deliverynote->items->sortBy('bale') as $item)
                        @if($loop->iteration <= 5)
                        <tr style="border:1px solid black;">
                            <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid black; text-align:left; padding-left:5px;">
                                <div>{{ $item->name }}</div>
                                <div style="font-size:8px; font-style:italic;">manage by: {{ $item->department->code }}</div>
                            </td>
                            <td style="border:1px solid black;">{{ $item->quantity }}</td>
                            <td style="border:1px solid black;">{{ $item->unit }}</td>
                            <td style="border:1px solid black;">{{ $item->bale }}</td>
                            <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->description }}</td>
                            <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 2px 4px 4px;"></div></td>
                            <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 4px 4px 2px;"></div></td>
                            <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->code }}</td>
                        </tr>
                        @endif
                        @if($loop->iteration == 6)
                            @if($loop->count > 6)
                                <tr style="border:1px solid black;">
                                    <td style="border:1px solid black;">
                                        <div style="witdh:10px; height:15px; margin:4px 4px 4px 2px; font-style:italic;">#</div>
                                    </td>
                                    <td style="border:1px solid black; text-align:left;" colspan="8">
                                        <div style="witdh:10px; height:15px; margin:4px 4px 4px 2px; font-style:italic;">Daftar barang berlanjut ke halaman berikutnya</div>
                                    </td>
                                </tr>
                            @else
                                <tr style="border:1px solid black;">
                                    <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                                    <td style="border:1px solid black; text-align:left; padding-left:5px;">
                                        <div>{{ $item->name }}</div>
                                        <div style="font-size:8px; font-style:italic;">manage by: {{ $item->department->code }}</div>
                                    </td>
                                    <td style="border:1px solid black;">{{ $item->quantity }}</td>
                                    <td style="border:1px solid black;">{{ $item->unit }}</td>
                                    <td style="border:1px solid black;">{{ $item->bale }}</td>
                                    <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->description }}</td>
                                    <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 2px 4px 4px;"></div></td>
                                    <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 4px 4px 2px;"></div></td>
                                    <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->code }}</td>
                                </tr>
                            @endif
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                    <tbody style="vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr>
                            <td style="width:50%;font-style:italic;">Catatan:</td>
                            <td style="width:50%; border:1px solid black; text-align:center; background-color:yellow;-webkit-print-color-adjust:exact;color-adjust:exact;"><b>PERHATIAN</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul style="list-style:disc;margin:0;padding:10px 25px;">
                                    <li>Estimasi berat: {{ $deliverynote->items->sum('weight') }} Kg</li>
                                    <li>Estimasi sampai: {{ $deliverynote->estimated_delivery }}</li>
                                    <li>Pengiriman melalui: {{ $deliverynote->via }}</li>
                                    <li>{{ $deliverynote->notes ?? 'Tidak ada catatan' }}</li>
                                </ul>
                            </td>
                            <td style="border:1px solid black; text-align:left;">
                                <ol style="text-align:justify; margin:15px 15px 15px 25px; padding:0px;">
                                    <li>Surat jalan dan kirimkan file dengan format PDF melalui google drive dan kirimkan file tersebut ke email scmmria@gmail.com dengan deskripsi nomor surat jalan.</li>
                                    <li>Surat jalan ini sebagai bukti dokumen pengiriman dan penerimaan barang internal perusahaan.</li>
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                    <tbody style="text-align:center; vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr>
                            <td style="width:33%; border-right:1px solid black;">Pengirim,</td>
                            <td style="width:33%; border-right:1px solid black;">Pembawa,</td>
                            <td style="width:33%;">Mengetahui,</td>
                        </tr>
                        <tr>
                            <td style="border-right:1px solid black;"><br/><br/><br/></td>
                            <td style="border-right:1px solid black;"></td>
                            <td></td>
                        </tr>
                        <tr style="font-weight:bold;">
                            <td style="border-right:1px solid black; text-transform:capitalize;">{{ $deliverynote->name_sender }}</td>
                            <td style="border-right:1px solid black;"></td>
                            <td>@switch($deliverynote->sender_id) @case(1) Ade Wahyudin @break @case(2) Wawang Rusmawan @break @case(3) Adang Sahroni @break @case(4) Herdis @break @default @endswitch</td>
                        </tr>
                        <tr>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black; margin:0px 10px; text-align:left; padding:3px 0;">Kontak: {{ $deliverynote->phone_sender }}</div>
                            </td>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black; margin:0px 10px; text-align:left; padding:3px 0;">Kontak:</div>
                            </td>
                            <td style="text-transform:capitalize;">
                                <div style="border-top:2px solid black; margin:0px 10px; text-align:center; text-transform:capitalize; padding:3px 0;">
                                @switch($deliverynote->sender_id) @case(1) Manager SCM @break @case(2) Manager HSE @break @case(3) Manager GAIT @break @case(4) Manager Workshop @break @default Site Koordinator {{ strtolower(substr($deliverynote->sender->name,5)) }} @endswitch
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                    <tbody style="text-align:center; vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr>
                            <td style="width:50%; border-right:1px solid black;">Penerima,</td>
                            <td style="width:50%;">Mengetahui,</td>
                        </tr>
                        <tr>
                            <td style="border-right:1px solid black;"><br/><br/><br/></td>
                            <td></td>
                        </tr>
                        <tr style="font-weight:bold;">
                            <td style="border-right:1px solid black; text-transform:capitalize;">{{ $deliverynote->name_recipient }}</td>
                            <td>@switch($deliverynote->recipient_id) @case(1) Ade Wahyudin @break @case(2) Wawang Rusmawan @break @case(3) Adang Sahroni @break @case(4) Herdis @break @default @endswitch</td>
                        </tr>
                        <tr>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black; margin:0px 10px; text-align:left;">
                                    <div style="padding:3px 0;">Kontak: {{ $deliverynote->phone_recipient }}</div>
                                    <div style="padding-bottom:3px;font-weight:bold;">Tanggal penerimaan: {{ $deliverynote->date_recipient??'' }}</div>
                                </div>
                            </td>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black; margin:0px 10px; padding:3px 0;">
                                @switch($deliverynote->recipient_id) @case(1) Manager SCM @break @case(2) Manager HSE @break @case(3) Manager GAIT @break @case(4) Manager Workshop @break @default Site Koordinator {{ strtolower(substr($deliverynote->recipient->name,5)) }} @endswitch
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <footer style="position:fixed; bottom:0; left:0; right:0;"><img src="{{asset('/storage/images/general/kop_surat_footer_a4_portrait.png')}}" alt="kop_surat_footer_a4_portrait" style="width:100%;"></footer>
        @if($deliverynote->items->count() > 6)
        <div style="padding-top:135px; padding-right:60px; padding-left:60px; page-break-after:always;">
            <div style="font-style:italic; font-weight:bold; margin-bottom:10px;">Daftar barang lanjutan Surat Jalan Nomor {{$deliverynote->letter}} | Lampiran 1</div>
            <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                <tbody style="text-align:center; vertical-align:top; border:1px solid black;">
                    @foreach($deliverynote->items->sortBy('bale') as $item)
                        @if($loop->iteration == 6)
                        <tr style="border:1px solid black; background-color:lightblue;-webkit-print-color-adjust:exact;color-adjust:exact;">
                            <th style="width:1%; border:1px solid black;">No.</th>
                            <th style="width:32%; border:1px solid black;">Nama Barang</th>
                            <th style="width:5%; border:1px solid black;">Qty</th>
                            <th style="width:8%; border:1px solid black;">Satuan</th>
                            <th style="width:10%; border:1px solid black;">Packing</th>
                            <th style="width:30%; border:1px solid black;">Keterangan</th>
                            <th style="border:1px solid black;" colspan="2">Ceklis</th>
                            <th style="width:8%; border:1px solid black;">KBL</th>
                        </tr>
                        @endif
                        @if ($loop->iteration > 5)
                            <tr style="border:1px solid black;">
                                <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">
                                    <div>{{ $item->name }}</div>
                                    <div style="font-size:8px; font-style:italic;">manage by: {{ $item->department->code }}</div>
                                </td>
                                <td style="border:1px solid black;">{{ $item->quantity }}</td>
                                <td style="border:1px solid black;">{{ $item->unit }}</td>
                                <td style="border:1px solid black;">{{ $item->bale }}</td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->description }}</td>
                                <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 2px 4px 4px;"></div></td>
                                <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 4px 4px 2px;"></div></td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->code }}</td>
                            </tr>
                        @endif
                        @if ($loop->iteration == 30)
                            @break
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if($deliverynote->items->count() > 31)
        <div style="padding-top:135px; padding-right:60px; padding-left:60px; page-break-after:always;">
            <div style="font-style:italic; font-weight:bold; margin-bottom:10px;">Daftar barang lanjutan Surat Jalan Nomor {{$deliverynote->letter}} | Lampiran 2</div>
            <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                <tbody style="text-align:center; vertical-align:top; border:1px solid black;">
                    @foreach($deliverynote->items->sortBy('bale') as $item)
                        @if($loop->iteration == 31)
                        <tr style="border:1px solid black; background-color:lightblue;-webkit-print-color-adjust:exact;color-adjust:exact;">
                            <th style="width:1%; border:1px solid black;">No.</th>
                            <th style="width:32%; border:1px solid black;">Nama Barang</th>
                            <th style="width:5%; border:1px solid black;">Qty</th>
                            <th style="width:8%; border:1px solid black;">Satuan</th>
                            <th style="width:10%; border:1px solid black;">Packing</th>
                            <th style="width:30%; border:1px solid black;">Keterangan</th>
                            <th style="border:1px solid black;" colspan="2">Ceklis</th>
                            <th style="width:8%; border:1px solid black;">KBL</th>
                        </tr>
                        @endif
                        @if ($loop->iteration > 30)
                            <tr style="border:1px solid black;">
                                <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">
                                    <div>{{ $item->name }}</div>
                                    <div style="font-size:8px; font-style:italic;">manage by: {{ $item->department->code }}</div>
                                </td>
                                <td style="border:1px solid black;">{{ $item->quantity }}</td>
                                <td style="border:1px solid black;">{{ $item->unit }}</td>
                                <td style="border:1px solid black;">{{ $item->bale }}</td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->description }}</td>
                                <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 2px 4px 4px;"></div></td>
                                <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 4px 4px 2px;"></div></td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->code }}</td>
                            </tr>
                        @endif
                        @if ($loop->iteration == 55)
                            @break
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if($deliverynote->items->count() > 56)
        <div style="padding-top:135px; padding-right:60px; padding-left:60px; page-break-after:always;">
            <div style="font-style:italic; font-weight:bold; margin-bottom:10px;">Daftar barang lanjutan Surat Jalan Nomor {{$deliverynote->letter}} | Lampiran 3</div>
            <table style="width:100%; margin-bottom:10px; border-collapse:collapse;">
                <tbody style="text-align:center; vertical-align:top; border:1px solid black;">
                    @foreach($deliverynote->items->sortBy('bale') as $item)
                        @if($loop->iteration == 56)
                        <tr style="border:1px solid black; background-color:lightblue;-webkit-print-color-adjust:exact;color-adjust:exact;">
                            <th style="width:1%; border:1px solid black;">No.</th>
                            <th style="width:32%; border:1px solid black;">Nama Barang</th>
                            <th style="width:5%; border:1px solid black;">Qty</th>
                            <th style="width:8%; border:1px solid black;">Satuan</th>
                            <th style="width:10%; border:1px solid black;">Packing</th>
                            <th style="width:30%; border:1px solid black;">Keterangan</th>
                            <th style="border:1px solid black;" colspan="2">Ceklis</th>
                            <th style="width:8%; border:1px solid black;">KBL</th>
                        </tr>
                        @endif
                        @if ($loop->iteration > 55)
                            <tr style="border:1px solid black;">
                                <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">
                                    <div>{{ $item->name }}</div>
                                    <div style="font-size:8px; font-style:italic;">manage by: {{ $item->department->code }}</div>
                                </td>
                                <td style="border:1px solid black;">{{ $item->quantity }}</td>
                                <td style="border:1px solid black;">{{ $item->unit }}</td>
                                <td style="border:1px solid black;">{{ $item->bale }}</td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->description }}</td>
                                <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 2px 4px 4px;"></div></td>
                                <td style="width:3%;"><div style="border:1px solid black; witdh:10px; height:15px; margin:4px 4px 4px 2px;"></div></td>
                                <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->code }}</td>
                            </tr>
                        @endif
                        @if ($loop->iteration == 80)
                            @break
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </body>
</html>