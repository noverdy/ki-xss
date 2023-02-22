<x-template>
    <x-navbar />

    <main class="container my-5">
        <h1 class="mb-5">Explore Notes</h1>

        <div class="text-center mb-4">
            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100">
                            <div class="card-header">
                                {{ $post->user->name }}
                            </div>
                            <div class="card-body">
                                <div class="h-100 d-flex flex-column justify-content-between">
                                    <div class="mb-4">
                                        <h5 class="card-title mb-3">{{ $post->title }}</h5>
                                        <div class="bg-body-secondary">
                                            <code class="text-dark">
                                                {{ mb_strimwidth($post->content, 0, 50, '...') }}
                                            </code>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ route('posts.show', $post) }}" class="btn btn-dark"><i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        {{ $posts->links() }}
    </main>
</x-template>
