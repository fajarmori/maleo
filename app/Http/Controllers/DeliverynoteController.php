<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Droppoint;
use App\Models\Deliverynote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DeliverynoteRequest;

class DeliverynoteController extends Controller
{
    public function index()
    {
        $deliverynotes = Deliverynote::query()->latest()->get();
        return view('deliverynote.index',['deliverynotes' => $deliverynotes]);
    }

    public function create()
    {
        $deliverynote = new Deliverynote();
        Gate::authorize('crudDeliverynote', $deliverynote);

        $deliverynote = Deliverynote::latest('id')->first();
        $deliverynote ? $number = $deliverynote->id : $number = 0;
        $code = auth()->user()->detail->occupation->department->code ?? auth()->user()->site->code ?? 'ADMIN';
        switch (Carbon::now()->isoFormat('M')) {case 1: $roman = 'I'; break; case 2: $roman = 'II'; break; case 3: $roman = 'III'; break; case 4: $roman = 'IV'; break; case 5: $roman = 'V'; break; case 6: $roman = 'VI'; break; case 7: $roman = 'VII'; break; case 8: $roman = 'VIII'; break; case 9: $roman = 'IX'; break; case 10: $roman = 'X'; break; case 11: $roman = 'XI'; break; default: $roman = 'XII'; break;};

        return view('deliverynote.form',[
            'deliverynote' => new Deliverynote(),
            'page_meta' => collect([
                'title' => 'Create Delivery Note',
                'number' => substr((1000+$number)+1, -3).'/SJ-'.$code.'/'.$roman.'/'.Carbon::now()->isoFormat('Y'),
                'method' => 'post',
                'url' => route('deliverynotes.store'),
            ]),
        ]);
    }

    public function store(DeliverynoteRequest $request)
    {
        $deliverynote = new Deliverynote();
        Gate::authorize('crudDeliverynote', $deliverynote);

        $sender = Droppoint::query()->where('name', $request->sender)->first();
        $recipient = Droppoint::query()->where('name', $request->recipient)->first();
        
        $deliverynote = Deliverynote::create([
            'letter' => $request->letter,
            'date' => Carbon::now()->isoFormat('Y-MM-DD'),
            'sender_id' => $sender->id,
            'name_sender' => ucwords(strtolower($request->validated('nameSender'))),
            'phone_sender' => $request->validated('phoneSender'),
            'recipient_id' => $recipient->id,
            'name_recipient' => ucwords(strtolower($request->validated('nameRecipient'))),
            'phone_recipient' => $request->validated('phoneRecipient'),
            'via' => ucfirst(strtolower($request->validated('via'))),
            'date_recipient' => $request->dateRecipient,
            'estimated_delivery' => strtolower($request->estimated),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created deliverynote_id - '.$deliverynote->id]);
        return to_route('deliverynotes.index');
    }

    public function show(Deliverynote $deliverynote)
    {
        $deliverynote = Deliverynote::query()->where('id',$deliverynote->id)->first();
        return view('deliverynote.show',['deliverynote' => $deliverynote]);
    }

    public function edit(Deliverynote $deliverynote)
    {
        Gate::authorize('crudDeliverynote', $deliverynote);

        return view('deliverynote.form',[
            'deliverynote' => $deliverynote,
            'page_meta' => collect([
                'title' => 'Edit Delivery Note '.$deliverynote->letter,
                'method' => 'put',
                'url' => route('deliverynotes.update', $deliverynote),
            ]),
        ]);
    }

    public function update(DeliverynoteRequest $request, Deliverynote $deliverynote)
    {
        Gate::authorize('crudDeliverynote', $deliverynote);

        $sender = Droppoint::query()->where('name', $request->sender)->first();
        $recipient = Droppoint::query()->where('name', $request->recipient)->first();
        
        $deliverynote->update([
            'sender_id' => $sender->id,
            'name_sender' => ucwords(strtolower($request->validated('nameSender'))),
            'phone_sender' => $request->validated('phoneSender'),
            'recipient_id' => $recipient->id,
            'name_recipient' => ucwords(strtolower($request->validated('nameRecipient'))),
            'phone_recipient' => $request->validated('phoneRecipient'),
            'via' => ucfirst(strtolower($request->validated('via'))),
            'date_recipient' => $request->dateRecipient,
            'estimated_delivery' => strtolower($request->estimated),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'update deliverynote_id - '.$deliverynote->id]);
        return to_route('deliverynotes.show',['deliverynote' => $deliverynote]);
    }

    public function destroy(Deliverynote $deliverynote)
    {
        Gate::authorize('crudDeliverynote', $deliverynote);
        
        Deliverynote::query()->where('id', $deliverynote->id)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted deliverynote_id - '.$deliverynote->id]);
        return to_route('deliverynotes.index');
    }

    //Generate PDF
    public function generateDeliveryNote($id)
    {
        $deliverynote = Deliverynote::query()->where('id',$id)->first();
        Gate::authorize('crudDeliverynote', $deliverynote);
        
        return view('deliverynote.pdf',['deliverynote' => $deliverynote]);

        // $pdf = Pdf::loadView('deliverynote.pdf', ['deliverynote' => $deliverynote]);
        // $pdf->setPaper('A4', 'portrait');
        // $fileName = str_replace('/','_',$deliverynote->letter)."_".Carbon::now()->format('YmdHis').".pdf";
        // return $pdf->download($fileName);
    }
}
