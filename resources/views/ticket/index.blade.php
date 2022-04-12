<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($canCreate)
                        <a href="{{ route('tickets.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            新建一筆
                        </a>
                    @endif
                    <table class="mt-1" width="100%">
                        <thead>
                        <tr>
                            <th class="py-4">建立日期</th>
                            <th class="py-4">結案日期</th>
                            <th class="py-4">類型</th>
                            <th class="py-4">標題</th>
                            <th class="py-4">狀態</th>
                            <th class="py-4">操作</th>
                        </tr>

                        </thead>
                        @foreach ($tickets as $idx => $ticket)
                                @if ($loop->even)
                                    <tr>
                                @else
                                    <tr class="bg-gray-100">
                                @endif
                                <td class="px-4 py-1 text-center">{{ $ticket->created_at }}</td>
                                <td class="px-4 py-1 text-center">{{ $ticket->resolved_at }}</td>
                                <td class="px-4 py-1 text-center">{{ \App\Enums\TicketTypeEnum::MAP[$ticket->type]['name'] }}</td>
                                <td class="px-4 py-1 w-48">{{ $ticket->title }}</td>
                                <td class="px-4 py-1 text-center w-20 text-indigo-700">{{ $ticket->isResolved() ? "已結案" : "" }}</td>
                                <td class="px-4 py-1" id="id-text-{{ $idx }}">
                                    <x-nav-link class="ml-1"
                                                :href="route('tickets.edit', $ticket->id)"
                                                :active="request()->routeIs('tickets.edit', $ticket->id)">
                                        編輯
                                    </x-nav-link>
                                    @if($ticket->canBeResolved && !($ticket->resolved_at || $ticket->resolver_id))
                                        <form class="inline-flex ml-1"
                                              method="POST" action="{{ route('tickets.resolve', $ticket->id) }}"
                                              id="from{{$ticket->id}}">
                                            <input type="hidden" name="_method" value="PUT">
                                            @csrf
                                            <x-nav-link
                                                role="button"
                                                onclick="document.getElementById('from{{$ticket->id}}').submit();">
                                                結案
                                            </x-nav-link>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
