@extends('layouts.user')

@section('content')
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="max-w-md mx-auto bg-white shadow-sm rounded-lg p-4 sm:p-8">
            <h1 class="text-2xl font-bold text-center mb-8">Ganti Password</h1>
            <form class="space-y-6" method="POST" action="{{ route('profile.change-password.post') }}">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                    <div class="relative">
                        <input type="password" name="old_password"
                            class="block w-full pl-4 pr-10 py-3 border border-gray-300 !rounded-button focus:ring-custom focus:border-custom"
                            required="" />
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-custom"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="block w-full pl-4 pr-10 py-3 border border-gray-300 !rounded-button focus:ring-custom focus:border-custom"
                            required="" />
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-custom"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation"
                            class="block w-full pl-4 pr-10 py-3 border border-gray-300 !rounded-button focus:ring-custom focus:border-custom"
                            required="" />
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-custom"></i>
                        </button>
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-custom text-white py-3 !rounded-button hover:bg-custom/90 transition-colors">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.querySelectorAll(".fa-eye").forEach((icon) => {
            icon.addEventListener("click", function() {
                const input = this.parentElement.previousElementSibling;
                if (input.type === "password") {
                    input.type = "text";
                    this.classList.remove("fa-eye");
                    this.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    this.classList.remove("fa-eye-slash");
                    this.classList.add("fa-eye");
                }
            });
        });
    </script>
@endsection
