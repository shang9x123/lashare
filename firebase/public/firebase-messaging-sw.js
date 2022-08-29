// Give the service worker access to Firebase Messaging.
 // Note that you can only use Firebase Messaging here. Other Firebase libraries
 // are not available in the service worker.
 importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js');
 importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js');
 // Initialize the Firebase app in the service worker by passing in
 // your app's Firebase config object.
 // https://firebase.google.com/docs/web/setup#config-object

 firebase.initializeApp({
    apiKey: "AIzaSyAQ4fb_ySwo4f23UFK74ixxVkWHpK2o***",
    authDomain: "fir-lashare.firebaseapp.com",
    projectId: "fir-lashare",
    storageBucket: "fir-lashare.appspot.com",
    messagingSenderId: "837040725327",
    appId: "1:837040725327:web:550cbb427a758fa9ce393a",
    measurementId: "G-ZHMYEXK998"
});
 // Retrieve an instance of Firebase Messaging so that it can handle background
 // messages.
 const messaging = firebase.messaging();


// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// Keep in mind that FCM will still show notification messages automatically
// and you should use data messages for custom notifications.
// For more info see:
// https://firebase.google.com/docs/cloud-messaging/concept-options
messaging.onBackgroundMessage(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload.data);
    var notificationTitle = payload.data.title;
    var notificationOptions = {
        body: payload.data.body,
        icon: payload.data.icon,
        image: payload.data.image,
        action: payload.data.click_action
    };
    console.log("strated sending msg" + notificationOptions);
    return self.registration.showNotification(notificationTitle,notificationOptions);
});

self.addEventListener('notificationclick', function (event) {
    console.log('On notification click: ', event.notification);
    event.notification.close();
    var redirectUrl = null;
    if (event.notification.data) {
        if (event.notification.data.FCM_MSG) {
            redirectUrl = event.notification.data.FCM_MSG.data ? event.notification.data.FCM_MSG.data.click_action : null
        } else {
            redirectUrl = event.notification.data ? event.notification.data.click_action : null
        }
    }
    console.log("redirect url is : " + redirectUrl);

    if (redirectUrl) {
        event.waitUntil(async function () {
            var allClients = await clients.matchAll({
                includeUncontrolled: true
            });
            var chatClient;
            for (var i = 0; i < allClients.length; i++) {
                var client = allClients[i];
                if (client['url'].indexOf(redirectUrl) >= 0) {
                    client.focus();
                    chatClient = client;
                    break;
                }
            }
            if (chatClient == null || chatClient == 'undefined') {
                chatClient = clients.openWindow(redirectUrl);
                return chatClient;
            }
        }());
    }
});

self.addEventListener("notificationclose", function (event) {
    event.notification.close();
    console.log('user has clicked notification close');
});

