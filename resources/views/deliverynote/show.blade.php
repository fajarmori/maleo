<x-app-layout>
    @slot('title','Detail Delivery Note')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Delivery Note') }}
        </h2>
    </x-slot>
    
    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" href="{{ route('deliverynotes.index') }}">
                        {{ __('Back') }}
                    </x-danger-button>
                    @if(auth()->user()->department_id === 1 || auth()->user()->department_id === 2 || auth()->user()->department_id === 6)
                    <x-primary-button as="a" href="{{ route('deliverynotes.edit', $deliverynote->id)}}">
                        {{ __('Edit') }}
                    </x-primary-button>
                    <x-primary-button as="a" href="{{ route('generateDeliveryNote', $deliverynote->id)}}" target="_blank">
                        {{ __('Print') }}
                    </x-primary-button>
                    <x-primary-button as="a" href="{{ route('deliveryitems.create', $deliverynote->id)}}">
                        {{ __('Add Delivery Item') }}
                    </x-primary-button>
                    <form onsubmit="return confirm('Apakah anda yakin menghapus data Surat Jalan {{$deliverynote->letter}} ?');" action="{{ route('deliverynotes.destroy', $deliverynote->id) }}" method="POST" class="me-2">
                        @method('DELETE')
                        @csrf
                        <x-dark-button class="w-full">
                            {{ __('Delete') }}
                        </x-dark-button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="flow-root p-6 mb-6 bg-white shadow ring-1 ring-black ring-opacity-5">
            <img src="{{asset('/storage/images/general/kop_surat_header_a4_portrait.png')}}" alt="kop_surat_header_a4_portrait">
            <div style="padding:15px 75px;">
                <div style="text-align:center; margin-bottom:10px;">
                    <div style="font-size:1.25rem;"><b><u>SURAT JALAN</u></b></div>
                    <div>{{ $deliverynote->letter }}</div>
                </div>
                <div style="text-align:right; margin-bottom:10px;">Tanggal pengiriman: {{ \Carbon\Carbon::parse($deliverynote->date)->locale('ID')->isoFormat('DD MMMM Y') }}</div>
                <table style="width:100%; margin-bottom:25px;">
                    <tbody style="vertical-align:top;">
                        <tr>
                            <td style="width:100px;">Pengirim</td>
                            <td style="width:10px;">:</td>
                            <td style="width:250px;"><b>{{ $deliverynote->sender->name }}</b></td>
                            <td style="width:30px;"></td>
                            <td style="width:100px;">Penerima</td>
                            <td style="width:10px;">:</td>
                            <td style="width:250px;"><b>{{ $deliverynote->recipient->name }}</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <div>{!! substr($deliverynote->sender->name,0,6) == 'DIVISI' ? '<b>PT MALEO RACHMA INDO ABADI</b>' : '' !!}</div>
                                <div>{{ $deliverynote->sender->address }}</div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div>{!! substr($deliverynote->recipient->name,0,6) == 'DIVISI' ? '<b>PT MALEO RACHMA INDO ABADI</b>' : '' !!}</div>
                                <div>{{ $deliverynote->recipient->address }}</div>
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
                            <td><a href="https://wa.me/{{ $deliverynote->phone_sender }}?text=Hi {{ $deliverynote->name_sender.', '.str_replace('/','%2F',$deliverynote->letter) }} adalah nomor Surat Jalan PT MRIA anda buat" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $deliverynote->phone_sender }}</a></td>
                            <td></td>
                            <td>No Telpon</td>
                            <td>:</td>
                            <td><a href="https://wa.me/{{ $deliverynote->phone_recipient }}?text=Hi {{ $deliverynote->name_recipient.', '.str_replace('/','%2F',$deliverynote->letter) }} adalah nomor Surat Jalan PT MRIA untuk anda" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $deliverynote->phone_recipient }}</a></td>
                        </tr>
                    </tbody>
                </table>
                <div>Dengan Hormat,</div>
                <div style="text-align:justify; margin-bottom:10px;">
                    Bersamaan dengan surat ini, kami sampaikan informasi barang yang dikirim. Berikut detail barang yang dilakukan pengiriman:
                </div>
                <table style="width:100%; margin-bottom:10px;">
                    <tbody style="text-align:center; vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr style="border:1px solid black; background-color:lightblue;">
                            <th style="width:10px; border:1px solid black;">No.</th>
                            <th style="width:250px; border:1px solid black;">Nama Barang</th>
                            <th style="width:50px; border:1px solid black;">Qty</th>
                            <th style="width:60px; border:1px solid black;">Satuan</th>
                            <th style="width:60px; border:1px solid black;">Packing</th>
                            <th style="width:250px; border:1px solid black;">Keterangan</th>
                            <th style="border:1px solid black;" colspan="2">Ceklis</th>
                            <th style="width:60px; border:1px solid black;">KBL</th>
                        </tr>
                        @foreach($deliverynote->items as $item)
                        <tr style="border:1px solid black;">
                            <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid black; text-align:left !important; padding-left:5px;">
                                @if(auth()->user()->department_id === 1 || auth()->user()->department_id === 2 || auth()->user()->department_id === 6)
                                <div><a href="{{ route('deliveryitems.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $item->name }}</a></div>
                                @else
                                <div>{{ $item->name }}</div>
                                @endif 
                                <div style="font-size:12px; font-style:italic;">manage by: {{ $item->department->code }}</div>
                            </td>
                            <td style="border:1px solid black;">{{ $item->quantity }}</td>
                            <td style="border:1px solid black;">{{ $item->unit }}</td>
                            <td style="border:1px solid black;">{{ $item->bale }}</td>
                            <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->notes }}</td>
                            <td style="width:10px;"><div style="border:1px solid black; witdh:10px; height:15px; margin:5px;"></div></td>
                            <td style="width:10px;"><div style="border:1px solid black; witdh:10px; height:15px; margin:5px;"></div></td>
                            <td style="border:1px solid black; text-align:left; padding-left:5px;">{{ $item->code }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table style="width:100%; margin-bottom:10px;">
                    <tbody style="vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr>
                            <td style="width:50%;font-style:italic;">Catatan:</td>
                            <td style="width:50%; border:1px solid black; text-align:center; background-color:yellow;"><b>PERHATIAN</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul style="list-style:disc;margin:0;padding:10px 25px;">
                                    <li>Estimasi berat: {{ $deliverynote->items->sum('weight') }} Kg</li>
                                    <li>Estimasi sampai: {{ $deliverynote->estimated_delivery }}</li>
                                    <li>Pengiriman melalui: {{ $deliverynote->via }}</li>
                                    <li>{{ $deliverynote->notes }}</li>
                                </ul>
                            </td>
                            <td style="border:1px solid black; text-align:left; padding-left:5px;">
                                <ol style="list-style:auto; padding:10px 30px; text-align:justify;">
                                    <li>Surat jalan dan kirimkan file dengan format PDF melalui google drive dan kirimkan file tersebut ke email scmmria@gmail.com dengan deskripsi nomor surat jalan.</li>
                                    <li>Surat jalan ini sebagai bukti dokumen pengiriman dan penerimaan barang internal perusahaan.</li>
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%; margin-bottom:10px;">
                    <tbody style="text-align:center; vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr>
                            <td style="width:33%; border-right:1px solid black;">Pengirim,</td>
                            <td style="width:33%; border-right:1px solid black;">Pembawa,</td>
                            <td style="width:33%;">Mengetahui,</td>
                        </tr>
                        <tr style="height:60px;">
                            <td style="border-right:1px solid black;"></td>
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
                                <div style="border-top:2px solid black;margin:0px 10px;text-align:left;">Kontak: {{ $deliverynote->phone_sender }}</div>
                            </td>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black;margin:0px 10px;text-align:left;">Kontak:</div>
                            </td>
                            <td style="text-transform:capitalize;">
                                <div style="border-top:2px solid black;margin:0px 10px;text-align:center; text-transform:capitalize;">
                                @switch($deliverynote->sender_id) @case(1) Manager SCM @break @case(2) Manager HSE @break @case(3) Manager GAIT @break @case(4) Manager Workshop @break @default Site Koordinator {{ strtolower(substr($deliverynote->sender->name,5)) }} @endswitch
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%; margin-bottom:10px;">
                    <tbody style="text-align:center; vertical-align:top; border:1px solid black; border-collapse: collapse;">
                        <tr>
                            <td style="width:33%; border-right:1px solid black;">Penerima,</td>
                            <td style="width:33%;">Mengetahui,</td>
                        </tr>
                        <tr style="height:60px;">
                            <td style="border-right:1px solid black;"></td>
                            <td></td>
                        </tr>
                        <tr style="font-weight:bold;">
                            <td style="border-right:1px solid black; text-transform:capitalize;">{{ $deliverynote->name_recipient }}</td>
                            <td>@switch($deliverynote->recipient_id) @case(1) Ade Wahyudin @break @case(2) Wawang Rusmawan @break @case(3) Adang Sahroni @break @case(4) Herdis @break @default @endswitch</td>
                        </tr>
                        <tr>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black;margin:0px 10px;text-align:left;">
                                    <div>Kontak: {{ $deliverynote->phone_recipient }}</div>
                                    <div style="margin-top:-5px;font-weight:bold;">Tanggal penerimaan: {{ $deliverynote->date_recipient??'' }}</div>
                                </div>
                            </td>
                            <td style="border-right:1px solid black; text-transform:capitalize;">
                                <div style="border-top:2px solid black;margin:0px 10px;">
                                @switch($deliverynote->recipient_id) @case(1) Manager SCM @break @case(2) Manager HSE @break @case(3) Manager GAIT @break @case(4) Manager Workshop @break @default Site Koordinator {{ strtolower(substr($deliverynote->recipient->name,5)) }} @endswitch
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <img src="{{asset('/storage/images/general/kop_surat_footer_a4_portrait.png')}}" alt="kop_surat_footer_a4_portrait">
        </div>
    </x-container>
</x-app-layout>