    <meta name="google-signin-client_id" content="{{env('GOOGLE_CLIENT_ID')}}">
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

    <script>
        function onLoad() {
            gapi.load('auth2', function() {
                gapi.auth2.init();
            });
        }

        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log('User signed out.');
            });
        }

        setTimeout(function () {
            signOut()
            window.location.href = '/';
        }, 1000)

</script>
