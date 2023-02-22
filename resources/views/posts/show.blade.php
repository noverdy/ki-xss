<x-template>
    <x-navbar />

    <main class="container my-5">
        <div class="mb-4">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <h1 class="mb-3 fs-2">{{ $post->title }}</h1>
            <div class="mb-3">
                <span class="me-3">
                    <i class="fa-solid fa-user"></i> <span class="ms-1">{{ $post->user->name }}</span>
                </span>
                <span class="me-3">
                    <i class="fa-solid fa-id-badge"></i> <span class="ms-1">{{ $post->user->nim }}</span>
                </span>
                <span class="me-3">
                    <i class="fa-solid fa-calendar"></i> <span class="ms-1">{{ $post->created_at }}</span>
                </span>
                @if ($post->user->id === auth()->user()->id)
                    <span class="me-3">
                        <i class="fa-solid fa-eye"></i> <span class="ms-1">{{ $post->visibility() }}</span>
                    </span>
                @endif
            </div>
            <div>
                @if ($post->user->id === auth()->user()->id)
                    <a class="btn btn-warning" href="{{ route('posts.edit', $post) }}">Edit</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete
                    </button>
                @endif
            </div>
        </div>

        <div class="bg-body-secondary">
            <div class="p-3">
                <code class="text-dark">{!! nl2br($post->content) !!}</code>
            </div>
        </div>
    </main>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Heads up!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this note? Once deleted, you can't retrieve it back.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE') @csrf
                        <button type="submit" class="btn btn-danger">I'm sure</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-template>
