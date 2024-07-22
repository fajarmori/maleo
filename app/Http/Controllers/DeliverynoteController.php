<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Droppoint;
use App\Models\Deliverynote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\DeliverynoteRequest;

class DeliverynoteController extends Controller
{
    public function index()
    {
        $deliverynotes = Deliverynote::orWhereHas('items', function (Builder $query) {
            $departmentID = auth()->user()->department_id;
            if($departmentID != 2){
                $query->where('department_id', 'like', $departmentID === 1 || $departmentID === 6 ? '%' : $departmentID);
            } else {
                $query->where('site_id', 'like', auth()->user()->site->id);
            }
        })->orWhereHas('sender', function (Builder $query) {
            $departmentID = auth()->user()->department_id;
            if($departmentID != 2){
                $query->where('department_id', 'like', $departmentID === 1 || $departmentID === 6 ? '%' : $departmentID);
            } else {
                $query->where('site_id', 'like', auth()->user()->site->id);
            }
        })->orWhereHas('recipient', function (Builder $query) {
            $departmentID = auth()->user()->department_id;
            if($departmentID != 2){
                $query->where('department_id', 'like', $departmentID === 1 || $departmentID === 6 ? '%' : $departmentID);
            } else {
                $query->where('site_id', 'like', auth()->user()->site->id);
            }
        })->latest('id')->get();
        return view('deliverynote.index',['deliverynotes' => $deliverynotes]);
    }

    public function create()
    {
        $deliverynote = new Deliverynote();
        Gate::authorize('createDeliverynote', $deliverynote);

        $deliverynote = Deliverynote::latest('id')->first();
        $deliverynote ? $number = $deliverynote->id : $number = 0;
        $code = auth()->user()->department_id === 2 ? auth()->user()->site->code : auth()->user()->department->code;
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
        Gate::authorize('createDeliverynote', $deliverynote);

        $sender = Droppoint::query()->where('name', $request->sender)->first();
        $recipient = Droppoint::query()->where('name', $request->recipient)->first();
        
        $deliverynote = Deliverynote::create([
            'letter' => $request->letter,
            'date' => Carbon::now()->isoFormat('Y-MM-DD'),
            'sender_id' => $sender->id,
            'name_sender' => str()->title($request->validated('nameSender')),
            'phone_sender' => substr($request->validated('phoneSender'),0,1) === '0' ? '62'.substr($request->validated('phoneSender'),1) : $request->validated('phoneSender'),
            'recipient_id' => $recipient->id,
            'name_recipient' => str()->title($request->validated('nameRecipient')),
            'phone_recipient' => substr($request->validated('phoneRecipient'),0,1) === '0' ? '62'.substr($request->validated('phoneRecipient'),1) : $request->validated('phoneRecipient'),
            'via' => str()->title($request->validated('via')),
            'user_id' => auth()->user()->id,
            'date_recipient' => $request->dateRecipient,
            'estimated_delivery' => str()->lower($request->estimated),
            'notes' => str()->ucfirst(str()->lower($request->notes)),
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
        Gate::authorize('updateDeliverynote', $deliverynote);

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
        Gate::authorize('updateDeliverynote', $deliverynote);

        $sender = Droppoint::query()->where('name', $request->sender)->first();
        $recipient = Droppoint::query()->where('name', $request->recipient)->first();
        
        $deliverynote->update([
            'sender_id' => $sender->id,
            'name_sender' => str()->title($request->validated('nameSender')),
            'phone_sender' => substr($request->validated('phoneSender'),0,1) === '0' ? '62'.substr($request->validated('phoneSender'),1) : $request->validated('phoneSender'),
            'recipient_id' => $recipient->id,
            'name_recipient' => str()->title($request->validated('nameRecipient')),
            'phone_recipient' => substr($request->validated('phoneRecipient'),0,1) === '0' ? '62'.substr($request->validated('phoneRecipient'),1) : $request->validated('phoneRecipient'),
            'via' => str()->title($request->validated('via')),
            'date_recipient' => $request->dateRecipient,
            'estimated_delivery' => str()->lower($request->estimated),
            'notes' => str()->ucfirst($request->notes),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'update deliverynote_id - '.$deliverynote->id]);
        return to_route('deliverynotes.show',['deliverynote' => $deliverynote]);
    }

    public function destroy(Deliverynote $deliverynote)
    {
        Gate::authorize('deleteDeliverynote', $deliverynote);
        
        Deliverynote::query()->where('id', $deliverynote->id)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted deliverynote_id - '.$deliverynote->id]);
        return to_route('deliverynotes.index');
    }

    //Generate PDF
    public function generateDeliveryNote($id)
    {
        $deliverynote = Deliverynote::query()->where('id',$id)->first();
        Gate::authorize('createDeliverynote', $deliverynote);
        
        return view('deliverynote.pdf',['deliverynote' => $deliverynote]);

        // $pdf = Pdf::loadView('deliverynote.pdf', ['deliverynote' => $deliverynote]);
        // $pdf->setPaper('A4', 'portrait');
        // $fileName = str_replace('/','_',$deliverynote->letter)."_".Carbon::now()->format('YmdHis').".pdf";
        // return $pdf->download($fileName);
    }
}