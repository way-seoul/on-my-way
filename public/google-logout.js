//Google provider setup
var config = {
    apiKey: googleLoginAPIKey,
    authDomain: "wc-students-access.firebaseapp.com",
};
firebase.initializeApp(config);

// Initialize the FirebaseUI Widget using Firebase.
var ui = new firebaseui.auth.AuthUI(firebase.auth());

//sign out user and re-direct
firebase.auth().signOut().then(() => {
// Sign-out successful.
}).catch((error) => {
// An error happened.
});
  
//re-direct to the preview page
window.location.replace(redirectURL);