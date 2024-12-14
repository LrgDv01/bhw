@include('partials.__header')
<main class="custombg min-vh-100">
    @include('partials.__nav')
    <div class="d-flex flex-column justify-content-between" style="height:90vh">
        <div class="container py-3 d-flex justify-content-center align-items-center" style="height:90vh">
            <div class="card p-4" style="width: 400px; background: transparent; border:none;">
                <h4 class="text-center mb-4 text-white"><strong>Forgot Password</strong></h4>
                <div id="response-message"></div>
                <form id="forgot-password-form">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label text-white"><strong>Email</strong></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email here" required>
                    </div>
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                    <div class="d-grid d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Send me Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card p-4 align-self-start" style="background: transparent; border:none;">
            <a href="{{ url()->previous() }}" class="btn btn-light">
                <i class="bi bi-arrow-left w-4"></i> </a>
        </div>
    </div>
</main>
@include('partials.__footer')
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const email = document.querySelector('input[name="email"]').value;
        if (!email) {
            alert('Email is required!');
            event.preventDefault();
        }
    });
    
    $('#forgot-password-form').on('submit', function(e) {
            e.preventDefault();
            const email = $('#email').val();
            const csrfToken = $('input[name="_token"]').val();
            $.ajax({
                url: "/request/reset-link",
                method: "POST",
                data: {
                    _token: csrfToken,
                    email: email
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    showLoading();
                },
                success: function(response) {
                    if (response.success) {
                        hideLoading();
                        $('#response-message')
                            .html(`<div style="color: white;">${response.message}</div>`);
                    }else {
                        hideLoading();
                        $('#response-message')
                        .html(`<div style="color: red;">${response.message}</div>`);
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    for (const key in errors) {
                        errorMessages += `<p>${errors[key][0]}</p>`;
                    }
                    $('#response-message').html(`
                        <div style="
                            text-align:center;
                            border-radius: 25px;
                            color: red; 
                            background-color: rgba(255, 255, 255, 0.5);">
                            ${errorMessages}
                        </div>`);
                }
            });
        });
</script>
