@extends('layouts.app')
@section('content')

    <form action="{{route('runfcm')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="Tiêu đề lashare" class="form-control" id="title" aria-describedby="title" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <input type="text" name="body" value="Body lashare" class="form-control" id="body" aria-describedby="body" placeholder="Body" required>
        </div>
        <div class="form-group">
            <label for="token">Token : mặc định token của bạn ,bạn có thể điền token khác</label>
            <input type="text" name="token" class="form-control" id="token" aria-describedby="token" placeholder="token" required>
        </div>
        <div class="form-group">
            <label for="token">Link ảnh</label>
            <input type="text" name="image" value="https://lashare.info/images/Firebase_Push.png" class="form-control" id="image" aria-describedby="image" placeholder="Ảnh Notification" required>
        </div>

        <div class="form-group">
            <label for="token">Link</label>
            <input type="text" name="link" value="https://lashare.info/" class="form-control" id="link" aria-describedby="link" placeholder="link" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
