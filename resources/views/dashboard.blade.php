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
                    <h2 class="mb-5">Lista di Birrifici</h2>

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th class="py-3 px-6 text-left text-gray-600 font-medium">Nome</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-medium">Tipo</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-medium">Città</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-medium">Stato</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-medium">Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-6">{{ $item['name'] }}</td>
                                    <td class="py-3 px-6">{{ $item['brewery_type'] }}</td>
                                    <td class="py-3 px-6">{{ $item['city'] }}</td>
                                    <td class="py-3 px-6">{{ $item['country'] }}</td>
                                    <td class="py-3 px-6">{{ $item['website_url'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>   

                    <div class="mt-5">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>