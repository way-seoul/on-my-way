//Google provider setup
var config = {
    apiKey: googleLoginAPIKey,
    authDomain: "wc-students-access.firebaseapp.com",
};
firebase.initializeApp(config);

// Initialize the FirebaseUI Widget using Firebase.
var ui = new firebaseui.auth.AuthUI(firebase.auth());

var uiConfig = {
    callbacks: {
      signInSuccessWithAuthResult: function(authResult, redirectUrl) {
        // User successfully signed in.
        return true;
      },
    },
    // Will use popup for Indentity Providers sign-in flow instead of the default, redirect.
    signInFlow: 'popup',
    signInSuccessUrl: redirectURL,
    signInOptions: [
      // Leave the lines as is for the providers you want to offer your users.
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,
    ]
};

// The start method will wait until the DOM is loaded.
ui.start('#firebaseui-auth-container', uiConfig);

//Manage users
firebase.auth().onAuthStateChanged((user) => {
  if (user) {
    // User is signed in, get user info with property "user"
    var username = user.displayName;
    var email = user.email;
    var date = Date('Y-m-d H:i:s');

    //use AJAX to send google user data into our browser
    let formData = new FormData();
    formData.append('username', username);
    formData.append('password', '');
    formData.append('first_name', '');
    formData.append('last_name', '');
    formData.append('email', email);
    formData.append('created_date', date);
    formData.append('admin', '0');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=admin');
    xhr.send(formData);

  } else {
    // User is signed out
  }
});