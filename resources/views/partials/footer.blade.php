<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Contact Info -->
            <div>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Contact</h3>
                <div class="mt-4 text-gray-500">
                    <p>Emergency: 911</p>
                    <p>Campus Security: {{-- TODO: Add campus security number --}}</p>
                    <p>Email: contact@campussafeline.edu</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Quick Links</h3>
                <div class="mt-4 space-y-2">
                    <p><a href="#" class="text-gray-500 hover:text-gray-900">Privacy Policy</a></p>
                    <p><a href="#" class="text-gray-500 hover:text-gray-900">Terms of Service</a></p>
                    <p><a href="{{ route('faqs') }}" class="text-gray-500 hover:text-gray-900">FAQs</a></p>
                </div>
            </div>

            <!-- Copyright -->
            <div>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">About</h3>
                <p class="mt-4 text-gray-500">
                    CampusSafeLine is dedicated to maintaining a safe and secure campus environment.
                </p>
                <p class="mt-4 text-sm text-gray-500">
                    &copy; {{ date('Y') }} CampusSafeLine. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
