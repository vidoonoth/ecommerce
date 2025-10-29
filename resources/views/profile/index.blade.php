<x-app-layout>
    <div class="py-2 px-2">
        <div class="bg-[#fffdfc] overflow-hidden shadow-sm sm:rounded-lg py-4 px-4">
            <div class="p-6 bg-[#fefbf9] border-b border-gray-200 rounded-lg shadow-sm">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                    {{ __('Profile Information') }}
                </h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Name:</p>
                        <p class="text-lg font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Email:</p>
                        <p class="text-lg font-medium text-gray-900">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#fcf7f1] border border-[#fee8d3] text-black font-semibold text-xs uppercase tracking-widest rounded-md hover:bg-[#e7e1db] focus:outline-none focus:ring-2 focus:ring-[#e7dfd6] focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Edit Profile') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
