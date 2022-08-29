<!DOCTYPE html>
<html>
<head>
    <title>Demo FCM</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script>
        // tự động gọi hàm khi load trang
        window.onload = function (){
            initFirebaseMessagingRegistration()
        };
        var firebaseConfig = {
            apiKey: "AIzaSyAQ4fb_ySwo4f23UFK74ixxVkWHpK2o***",
            authDomain: "fir-lashare.firebaseapp.com",
            projectId: "fir-lashare",
            storageBucket: "fir-lashare.appspot.com",
            messagingSenderId: "837040725327",
            appId: "1:837040725327:web:550cbb427a758fa9ce393a",
            measurementId: "G-ZHMYEXK998"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        function initFirebaseMessagingRegistration() {
            //thêm jquery nếu ko sẽ ko chạy
            messaging.requestPermission().then(
                function () {
                    return messaging.getToken()
                })
                .then(function (token) {
                    console.log(token)
                    navigator.serviceWorker.regi
                    if(document.getElementById("token_id"))
                    {
                        document.getElementById("token_id").innerHTML = token +''
                    }
                    if(document.getElementById("token"))
                    {
                        document.getElementById("token").value = token
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                }).catch(function (err) {
                console.log('User Chat Token Error' + err);
            });
        }

        // hiển thị khi đang trong trang web . nếu không ở trên trang web thì mới sử dụng server worok firebase-mesaging-sw
        messaging.onMessage((payload) => {
            console.log('Message received. ', payload.data);
            // ở đây chúng ta cần xử lý hàm data .Mọi thông tin truyền đi đều sử dụng data
            var message = payload.data;
            const Title = message.title;
            const content = {
                body: message.body ,
                icon: message.image,
                image: message.image,
            };
            //Click Event khi click vào notification
            var notificationUrl = message.url;
            var notificationObj = new Notification(Title,content);
            notificationObj.onclick = function () {
                notificationObj.close();
                window.open(notificationUrl);

            };
        });
    </script>
</head>
<body>

<div class="container">
    <!-- div to display messages received by this app. -->
    <div id="messages"></div>
    <!--
    <p id="token" style="word-break: break-all;"></p>
    -->
    @yield('content')
</div>
</body>
</html>
