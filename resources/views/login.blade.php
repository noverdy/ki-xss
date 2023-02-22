<x-template>
    <main class="d-flex align-items-center justify-content-center vh-100 bg-body-secondary">
        <div class="container">
            <div class="mx-auto shadow rounded p-4 text-center bg-body" style="max-width: 400px">
                <h1 class="fs-2">Login</h1>
                <p>Login using SIAM account</p>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <hr class="mb-4">

                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="nim" type="text" class="form-control" id="nim" placeholder="NIM"
                            value="{{ old('nim') }}" required>
                        <label for="nim">NIM</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input name="password" type="password" class="form-control" id="floatingPassword"
                            placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button type="submit" class="btn btn-dark text-white w-100 py-2 rounded-pill mb-3">Login</button>
                </form>
                <span class="text-body-tertiary" style="font-size: 0.85em">
                    Copyright &copy;{{ now()->year }} AcRtf
                </span>
            </div>
        </div>
    </main>
</x-template>
