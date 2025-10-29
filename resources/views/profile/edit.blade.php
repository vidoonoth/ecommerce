<x-app-layout>
    <div class="py-2 px-2">
        <div class="bg-[#fffdfc] overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 space-y-6">
            <div class="p-4 sm:p-8 bg-[#fefbf9] shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[#fefbf9] shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[#fefbf9] shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
