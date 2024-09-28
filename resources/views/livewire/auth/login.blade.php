<section>
    <x-slot name="title">
        login
    </x-slot>

    <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl">Login Form</h1>
    <div class="w-1/2 mt-2 mx-auto">
        @if (session()->has('success'))
            <div class="text-white py-2 px-5  text-center bg-green-500">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="text-white py-2 px-5  text-center bg-red-500">{{ session()->get('error') }}</div>
        @endif

        <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="login">

            <div>
                <x-form-label star="true" label_for="email" input_label="Email" />
                <x-form-input id="email" input_label="Email" wire:model.live="email" placeholder="name@company.com"
                    type="email" />
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="relative">
                <x-form-label label_for="password" star="true" input_label="Password" />
                <div class="relative">
                    <input type="{{ $passwordType }}" wire:model="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <button type="button" class="absolute -translate-y-1/2 top-1/2 right-[20px]"
                        wire:click="typeToggle">
                        <span id="eyeIcon" class="block">{{ $passwordType == 'password' ? '👁️' : '🙈 ' }}</span>
                        <!-- Eye icon for toggle -->
                    </button>
                </div>
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <x-form-button button_text="Create an account" button_type="submit" target="login" />

            {{-- <button type="submit"
                class="w-full flex justify-center items-center gap-2 text-white bg-black hover:opacity-90 transition-all focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">

                <span class="" wire:loading.remove wire:target="login">Login</span>
                <div wire:loading wire:target="login" role="status">
                    <span class="">Loading...</span>
                    <svg aria-hidden="true"
                        class="inline w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-500"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
            </button> --}}

            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Don't have an account? <a wire:navigate href="{{ route('register') }}"
                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register here</a>
            </p>
        </form>

    </div>
</section>
{{-- 
<script>
    // Get the password input and toggle button elements
    var passwordInput = document.getElementById("password");
    var togglePassword = document.getElementById("togglePassword");
    var eyeIcon = document.getElementById("eyeIcon");

    // Add event listener to toggle button
    togglePassword.addEventListener('click', function() {
        // Check the current type of the password input field
        if (passwordInput.type === 'password') {
            // Change the input type to text to show the password
            passwordInput.type = 'text';
            // Change the icon to indicate password is visible (open eye)
            eyeIcon.textContent = '🙈'; // Change icon to indicate visibility
        } else {
            // Change the input type back to password to hide the password
            passwordInput.type = 'password';
            // Change the icon back to indicate password is hidden (closed eye)
            eyeIcon.textContent = '👁️'; // Change icon back to hidden
        }
    });
</script> --}}
