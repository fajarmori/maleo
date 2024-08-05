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
                        <x-input-label for="sender" :value="__('Origin*')" />
                        <x-text-input id="sender" class="block mt-1 w-full" type="text" name="sender" :value="old('sender',$deliverynote->sender->name??'')" autofocus />
                        <x-input-error :messages="$errors->get('sender')" class="mt-2" />
                        <div id="list-sender" class="relative z-10"></div>
                    </div>
                    <div>
                        <x-input-label for="nameSender" :value="__('Name Sender*')" />
                        <x-text-input id="nameSender" class="block mt-1 w-full" type="text" name="nameSender" :value="old('nameSender',$deliverynote->name_sender)" autofocus />
                        <x-input-error :messages="$errors->get('nameSender')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phoneSender" :value="__('Whatsapp/Phone Sender*')" />
                        <x-text-input id="phoneSender" class="block mt-1 w-full" type="number" name="phoneSender" :value="old('phoneSender',$deliverynote->phone_sender)" placeholder="Starting from country code (62)" autofocus />
                        <x-input-error :messages="$errors->get('phoneSender')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="recipient" :value="__('Destination*')" />
                        <x-text-input id="recipient" class="block mt-1 w-full" type="text" name="recipient" :value="old('recipient',$deliverynote->recipient->name??'')" autofocus />
                        <x-input-error :messages="$errors->get('recipient')" class="mt-2" />
                        <div id="list-recipient" class="relative z-10"></div>
                    </div>
                    <div>
                        <x-input-label for="nameRecipient" :value="__('Name Recipient*')" />
                        <x-text-input id="nameRecipient" class="block mt-1 w-full" type="text" name="nameRecipient" :value="old('nameRecipient',$deliverynote->name_recipient)" autofocus />
                        <x-input-error :messages="$errors->get('nameRecipient')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phoneRecipient" :value="__('Whatsapp/Phone Recipient*')" />
                        <x-text-input id="phoneRecipient" class="block mt-1 w-full" type="number" name="phoneRecipient" :value="old('phoneRecipient',$deliverynote->phone_recipient)" placeholder="Starting from country code (62)" autofocus />
                        <x-input-error :messages="$errors->get('phoneRecipient')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="via" :value="__('Via*')" />
                        <x-text-input id="via" class="block mt-1 w-full" type="text" name="via" :value="old('via',$deliverynote->via)" autofocus />
                        <x-input-error :messages="$errors->get('via')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="estimated" :value="__('Estimated Delivery')" />
                        <x-text-input id="estimated" class="block mt-1 w-full" type="text" name="estimated" :value="old('estimated',$deliverynote->estimated_delivery)" autofocus />
                        <x-input-error :messages="$errors->get('estimated')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-textarea id="notes" name="notes" rows="2" class="block mt-1 w-full">{{ old('notes',$deliverynote->notes) }}</x-textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="$page_meta['method'] == 'put' ? route('deliverynotes.show', $deliverynote->id) : route('deliverynotes.index')" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
                <div class="mt-2 italic text-xs">*Required input</div>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#sender').on('keyup',function() { var querySender = $(this).val(); $.ajax({ url:"{{ route('getdroppoint') }}", type:'GET', data:{'droppoint':querySender}, success:function (data) { $('#list-sender').html(data); } }) });
    $('#recipient').on('keyup',function() { var queryRecipient = $(this).val(); $.ajax({ url:"{{ route('getdroppoint') }}", type:'GET', data:{'droppoint':queryRecipient}, success:function (data) { $('#list-recipient').html(data); } }) });
    $('#list-sender').on('click', 'li', function(){ var sender = $(this).data('name'); $('#sender').val(sender); $('#list-sender').html(''); });
    $('#list-recipient').on('click', 'li', function(){ var recipient = $(this).data('name'); $('#recipient').val(recipient); $('#list-recipient').html(''); });
    $('input').on('focus',function() { $('#list-sender').html(''); $('#list-recipient').html(''); });
})
</script>