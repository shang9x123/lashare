<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<div class="container">

    <h3 style="text-align: center">DEMO CONNECT MONGODB VÀ LARAVEL 9 TẠI <a href="https://lashare.info" target="_blank">LASHARE.INFO </a></h3>
    <form method="post" action="{{route('post.store')}}">
        @csrf
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Content</label>
            <input type="text" class="form-control" id="content" name="content" placeholder="Content">
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
    <h3 style="text-align: center">đã nhập</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>

        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$item)
        <tr>
            <th scope="row">{{$key}}</th>
            <td>{{$item->title}}</td>
            <td>{{$item->content}}</td>


        </tr>
        @endforeach

        </tbody>
    </table>
</div>
