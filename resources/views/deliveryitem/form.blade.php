<x-app-layout>
    @slot('title',$page_meta['title'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $page_meta['title'] }}
        </h2>
    </x-slot>
    
    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $page_meta['url'] }}" method="post" class="[&>div]:mb-3" novalidate>
                    @method($page_meta['method'])
                    @csrf
                    <div>
                        <x-input-label for="code" :value="__('Code or KBL')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code',$deliveryitem->code)" autofocus/>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="name" :value="__('Name Item')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$deliveryitem->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="old('quantity',$deliveryitem->quantity)" autofocus />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="unit" :value="__('Unit')" />
                        <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit" :value="old('unit',$deliveryitem->unit)" autofocus />
                        <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="bale" :value="__('Bale')" />
                        <x-text-input id="bale" class="block mt-1 w-full" type="text" name="bale" :value="old('bale',$deliveryitem->bale)" autofocus />
                        <x-input-error :messages="$errors->get('bale')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price',$deliveryitem->price)" placeholder="Price per item" autofocus />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-text-input id="notes" class="block mt-1 w-full" type="text" name="notes" :value="old('notes',$deliveryitem->notes)" autofocus />
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="purchase_order" :value="__('Purchase Order/Receipt')" />
                        <x-text-input id="purchase_order" class="block mt-1 w-full" type="text" name="purchase_order" :value="old('purchase_order',$deliveryitem->purchase_order)" autofocus />
                        <x-input-error :messages="$errors->get('purchase_order')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date_request" :value="__('Date Request')" />
                        <x-text-input id="date_request" class="block mt-1 w-full" type="text" name="date_request" :value="old('date_request',$deliveryitem->date_request)" autofocus />
                        <x-input-error :messages="$errors->get('date_request')" class="mt-2" />
                    </div>

                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="route('deliverynotes.show',$page_meta['back']??$deliveryitem)" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#sender').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"{{ route('getdroppoint') }}",
            type:"GET",
            data:{'droppoint':query},
            success:function (data) { 
                $('#list-sender').html(data);
            }
        })
    });
    $('#list-sender').on('click', 'li', function(){
        var value = $(this).text();
        $('#sender').val(value);
        $('#list-sender').html("");
    });

    $('#recipient').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"{{ route('getdroppoint') }}",
            type:"GET",
            data:{'droppoint':query},
            success:function (data) { 
                $('#list-recipient').html(data);
            }
        })
    });
    $('#list-recipient').on('click', 'li', function(){
        var value = $(this).text();
        $('#recipient').val(value);
        $('#list-recipient').html("");
    });
})
</script>