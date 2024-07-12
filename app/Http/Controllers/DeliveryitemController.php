<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Deliveryitem;
use App\Models\Deliverynote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DeliveryitemRequest;

class DeliveryitemController extends Controller
{
    public function index()
    {
        $deliveryitem = new Deliveryitem();
        Gate::authorize('listDeliveryitem', $deliveryitem);

        $deliveryitems = Deliveryitem::query()->latest('id')->get();
        return view('deliveryitem.index',['deliveryitems' => $deliveryitems]);
    }

    public function create($deliverynote_id)
    {
        $deliveryitem = new Deliveryitem();
        Gate::authorize('crudDeliveryitem', $deliveryitem);

        $deliverynote = Deliverynote::select('id','letter')->where('id',$deliverynote_id)->first();
        return view('deliveryitem.form',[
            'deliveryitem' => $deliveryitem,
            'page_meta' => collect([
                'title' => 'Create Item at '.$deliverynote->letter,
                'method' => 'post',
                'back' => $deliverynote_id,
                'url' => route('deliveryitems.store', $deliverynote_id),
            ]),
        ]);
    }

    public function store(DeliveryitemRequest $request, $deliverynote_id)
    {
        $deliveryitem = new Deliveryitem();
        Gate::authorize('crudDeliveryitem', $deliveryitem);

        $deliveryitem = Deliveryitem::create([
            'deliverynote_id' => $deliverynote_id,
            'code' => $request->code,
            'name' => $request->validated('name'),
            'quantity' => $request->validated('quantity'),
            'unit' => $request->unit,
            'bale' => $request->bale,
            'price' => $request->price,
            'notes' => $request->notes,
            'purchase_order' => $request->purchase_order,
            'date_request' => $request->date_request,
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created deliveryitem_id - '.$deliveryitem->id]);
        return to_route('deliverynotes.show', $deliverynote_id);
    }

    // public function show(Deliveryitem $deliveryitem)
    // {
    //     //
    // }

    public function edit(Deliveryitem $deliveryitem)
    {
        Gate::authorize('crudDeliveryitem', $deliveryitem);

        $deliverynote = Deliverynote::select('id','letter')->where('id',$deliveryitem->deliverynote_id)->first();

        return view('deliveryitem.form',[
            'deliveryitem' => $deliveryitem,
            'page_meta' => collect([
                'title' => 'Edit Item at '.$deliverynote->letter,
                'method' => 'put',
                'back' => NULL,
                'url' => route('deliveryitems.update', $deliveryitem),
            ]),
        ]);
    }

    public function update(DeliveryitemRequest $request, Deliveryitem $deliveryitem)
    {
        Gate::authorize('crudDeliveryitem', $deliveryitem);

        $deliveryitem->update([
            'code' => $request->code,
            'name' => $request->validated('name'),
            'quantity' => $request->validated('quantity'),
            'unit' => $request->unit,
            'bale' => $request->bale,
            'price' => $request->price,
            'notes' => $request->notes,
            'purchase_order' => $request->purchase_order,
            'date_request' => $request->date_request,
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'update deliveryitem_id - '.$deliveryitem->id]);
        return to_route('deliverynotes.show', $deliveryitem->deliverynote_id);
    }

    public function destroy(Deliveryitem $deliveryitem)
    {
        Gate::authorize('crudDeliveryitem', $deliveryitem);

        Deliveryitem::query()->where('id', $deliveryitem->id)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted deliveryitem_id - '.$deliveryitem->id]);
        return to_route('deliveryitems.index');
    }
}
