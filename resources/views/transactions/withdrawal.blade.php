<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Withdrawal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex flex-wrap gap-3">
                <div class="flex-auto bg-white shadow-sm sm:rounded-lg p-5">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('withdrawal') }}">
                        @csrf

                        <!-- User ID -->
                        <div>
                            <x-input-label for="user_id" :value="__('User ID')" />
                            <x-text-input id="user_id" class="block mt-1 w-full" type="number" min="0"
                                name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" />
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Withdrawal Amount -->
                        <div class="mt-4">
                            <x-input-label for="amount" :value="__('Withdrawal Amount')" />
                            <x-text-input id="amount" class="block mt-1 w-full" type="number" min="0"
                                name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
                <div class="flex-auto bg-white shadow-sm sm:rounded-lg">
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
                                        Withdrawal Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fee (%)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdrawalList as $item)
                                    <tr class="bg-white border-b">
                                        <th class="px-6 py-4">
                                            {{ $item->date }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
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
    </div>
</x-app-layout>