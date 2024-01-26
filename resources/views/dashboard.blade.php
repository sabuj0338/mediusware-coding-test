<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    User Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Current Balance
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Transaction Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fee (%)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allTransactions as $item)
                                <tr class="bg-white border-b">
                                    <th class="px-6 py-4">
                                        {{ $item->date }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item->user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->user->balance }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->transaction_type }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->amount }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->fee }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
