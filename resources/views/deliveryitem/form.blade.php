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
                        <div id="list-name" class="relative z-10"></div>
                    </div>
                    <div>
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity',$deliveryitem->quantity)" placeholder="Per unit" autofocus />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="unit" :value="__('Unit')" />
                        <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit" :value="old('unit',$deliveryitem->unit)" placeholder="Use smallest units" autofocus />
                        <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="bale" :value="__('Bale')" />
                        <x-text-input id="bale" class="block mt-1 w-full" type="text" name="bale" :value="old('bale',$deliveryitem->bale)" autofocus />
                        <x-input-error :messages="$errors->get('bale')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price',$deliveryitem->price)" placeholder="Price per item" autofocus />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="weight" :value="__('Weight')" />
                        <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight',$deliveryitem->weight)" placeholder="Per kilogram" autofocus />
                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-textarea id="notes" name="notes" rows="2" class="block mt-1 w-full">{{ old('notes',$deliveryitem->notes) }}</x-textarea>
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
                    <div>
                    <x-input-label for="department" :value="__('Department')" />
                        <select id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">No Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if(isset($deliveryitem->department_id)) {{ $department->id == $deliveryitem->department_id ? 'selected' : '' }} @endif> {{ $department->code }} - {{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div>
                    <div id="site-select" class="{{ isset($droppoint->site->id) ? '' : 'hidden' }}">
                        <x-input-label for="site" :value="__('Site')" />
                        <select id="site" name="site" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">No Site</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}" @if(isset($deliveryitem->site_id)) {{ $site->id == $deliveryitem->site_id ? 'selected' : '' }} @endif>{{ $site->code }} - {{ $site->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('site')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    
                    <x-danger-button as="a" href="{{ url()->previous() }}" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#department').change(function(){ var data = $(this).val(); if(data == 2){ $('#site-select').removeClass('hidden'); }else{ $('#site-select').addClass('hidden'); $('#site').prop('selectedIndex',0); } });
    $('#name').on('keyup',function() { var query = $(this).val(); $.ajax({ url:"{{ route('getdeliveryitem') }}", type:'GET', data:{'name':query}, success:function (data) { $('#list-name').html(data); } }) });
    $('#list-name').on('click', 'li', function(){ var name = $(this).data('name');var weight = $(this).data('weight'); $('#name').val(name); $('#weight').val(weight); $('#list-name').html(''); });
    $('input').on('focus',function() { $('#list-name').html(''); });
})
</script>