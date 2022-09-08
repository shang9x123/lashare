// Import the functions you need from the SDKs you need
    importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
    importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
    apiKey: "AIzaSyASTRjhKK9E7pdL0oiBz5a1AfpsxRmm37s",
    authDomain: "lashare-359718.firebaseapp.com",
    projectId: "lashare-359718",
    storageBucket: "lashare-359718.appspot.com",
    messagingSenderId: "900336455644",
    appId: "1:900336455644:web:b62fea74b407cd1f618919",
    measurementId: "G-86T4T81YNR"
};
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
