<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ticket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div>
                            <x-label for="title" value="類型" />
                            <div class="mt-1 py-2 px-3 sm:text-sm">
                                {{ \App\Enums\TicketTypeEnum::MAP[$ticket->type]['name'] }}
                            </div>
                        </div>
                        <div class="mt-6">
                            <x-label for="title" value="標題" />

                            <x-input id="title" name="title" type="text" :value="$ticket->title" required autofocus
                                     class="w-full mt-1 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                        <div class="mt-6">
                            <x-label for="content" value="內容" />

                            <x-input id="content"
                                     name="content"
                                     type="text"
                                     :value="$ticket->content"
                                     class="w-full mt-1 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            @if($canEdit)
                                <x-button>
                                    送出
                                </x-button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
