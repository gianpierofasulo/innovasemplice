<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="breweriesSection">

                                @if(isset($items) && count($items) > 0)
                                <h2>Lista di Birrifici</h2>
                                <table id="breweryTable">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Città</th>
                                            <th>Stato</th>
                                            <th>Website</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach ($items as $item)
                                <tr>
                                        <th>{{ $item['name'] }}</th>
                                        <th>{{ $item['brewery_type'] }}</th>
                                        <th>{{ $item['city'] }}</th>
                                        <th>{{ $item['country'] }}</th>
                                        <th>{{ $item['website_url'] }}</th>
                                    </tr>
                                @endforeach
                                @else
                                    <a href="{{ route('dashboard') }}">Carica Birrifici</a>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if(isset($items) && count($items) > 0)
                    {{ $items->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


