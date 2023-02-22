<x-template>
    <x-navbar />

    <main class="container my-5">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <h1 class="mb-5">My Notes</h1>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Visibility</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <a class="d-block text-reset" href="{{ route('posts.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>
                            <a class="d-block text-reset text-decoration-none" href="{{ route('posts.show', $post) }}">
                                {{ $post->created_at }}
                            </a>
                        </td>
                        <td>
                            <a class="d-block text-reset text-decoration-none" href="{{ route('posts.show', $post) }}">
                                {{ $post->visibility() }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4">You don't have any notes yet. Start by <a class="text-dark"
                                href="{{ route('posts.create') }}">creating one</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</x-template>
