<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("form").submit();
    }
</script>
<h3 style="text-align: center;text-transform: uppercase;">Demo Google reCaptcha của <a target="_blank" href="https://lashare.info"> LASHARE.info</a></h3>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-primary" role="alert" style="text-align: center;">
            {{$error}}
        </div>
    @endforeach
@endif
<div class="main">
    <div class="container">
        <form action="{{route('contact_post')}}" method="post" id="form">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example1">Email</label>
                <input name="email" type="email" id="form1Example1" class="form-control" />

            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example2">Nội dung</label>
                <input name="content" type="text" id="form1Example2" class="form-control" />

            </div>

            <!-- Submit button -->
            <button class="btn btn-primary btn-block g-recaptcha" data-sitekey="{{env('site_key')}}" data-callback="onSubmit" type="submit">Submit</button>
        </form>
    </div>
</div>

