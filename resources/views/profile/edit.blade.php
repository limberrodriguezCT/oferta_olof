<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        <div class="bg-white p-8 shadow-xl sm:rounded-2xl border-t-8 border-[#003876]">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white p-8 shadow-xl sm:rounded-2xl border-t-8 border-[#8cc63f]">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white p-8 shadow-xl sm:rounded-2xl border-t-8 border-red-500">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        
    </div>
</x-app-layout>