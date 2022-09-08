<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@if($errors->any())
    <div class="alert alert-success" role="alert">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif
<div class="main">
    <form action="{{route('form.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
