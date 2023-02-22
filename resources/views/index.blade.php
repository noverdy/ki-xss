<x-template>
    <x-navbar />
    <div class="container text-center" style="margin-top: 6rem">
        <div>
            <img src="{{ asset('logo.png') }}" alt="Logo" height=300>
        </div>
        <h2 class="mt-3 mb-4 fs-1">Welcome to Notes App</h2>
        @auth
            <p>
                You can <a href="{{ route('posts.create') }}" class="text-dark">create your note</a>
                or <a href="{{ route('posts.index') }}" class="text-dark">explore other people's notes</a>!
            </p>
        @endauth
        @guest
            <p>
                <a href="{{ route('login') }}" class="text-dark">Login</a>
                to create your note or explore other people's notes!
            </p>
        @endguest
        <p style="font-size: 0.6rem" class="text-body-tertiary">(definitely not me that's lazy to make a homepage)</p>
    </div>
</x-template>
