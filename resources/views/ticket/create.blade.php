<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tickets.store') }}">
                    @csrf
                        <div>
                            <x-label for="type" value="類型" />
                            <select class="mt-1 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="type">
                                @foreach($ticketTypes as $type => $data)
                                    <option value="{{ $type }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-6">
                            <x-label for="title" value="標題" />

                            <x-input id="title"
                                     name="title" type="text" required autofocus
                                     class="w-full mt-1 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                        <div class="mt-4">
                            <x-label for="content" value="內容" class="mt-6" />

                            <x-input id="content"
                                     name="content" type="text" :value="old('content')"
                                     class="w-full mt-1 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-button>
                                送出
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
