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
                        <x-input-label for="dateRecipient" :value="__('Date Recipient')" />
                        <x-text-input id="dateRecipient" class="block mt-1 w-full" type="date" name="dateRecipient" :value="old('dateRecipient',$deliverynote->date_recipient)" autofocus />
                        <x-input-error :messages="$errors->get('dateRecipient')" class="mt-2" />
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