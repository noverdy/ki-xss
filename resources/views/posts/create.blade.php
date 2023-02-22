<x-template>
    <x-navbar />

    <main class="container my-5">
        <h1 class="mb-4">Create Note</h1>
        <div>
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="titleInput" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" id="titleInput" placeholder="Title"
                        value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="contentTextarea" class="form-label">Content</label>
                    <textarea name="content" class="form-control font-monospace" id="contentTextarea" rows="8" placeholder="Content"
                        required>{{ old('content') }}</textarea>
                </div>
                <div class="mb-3">
                    <div>
                        <label for="visibilityToggle" class="form-label me-3">Visibility</label>
                    </div>
                    <div class="btn-group" id="visibilityToggle">
                        <input type="radio" class="btn-check" name="visibility" id="public" value="0"
                            checked />
                        <label class="btn btn-dark" for="public">Public</label>

                        <input type="radio" class="btn-check" name="visibility" id="unlisted" value="1" />
                        <label class="btn btn-dark" for="unlisted">Unlisted</label>

                        <input type="radio" class="btn-check" name="visibility" id="private" value="2" />
                        <label class="btn btn-dark" for="private">Private</label>
                    </div>
                </div>
                <button class="btn btn-dark" type="submit">Save</button>
            </form>
        </div>
    </main>
</x-template>
