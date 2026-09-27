import { initializeApp } from "firebase/app";
import { getAuth, signInWithEmailAndPassword } from "firebase/auth";

const firebaseConfig = {
  apiKey: "AIzaSyBRxHSryD3-DWUp1FmrI618hA8yZ7PFUPk",
  authDomain: "mimi-padel-app.firebaseapp.com",
  projectId: "mimi-padel-app",
  storageBucket: "mimi-padel-app.firebasestorage.app",
  messagingSenderId: "245806687867",
  appId: "1:245806687867:web:2183cd130c6043dba464de"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

document.getElementById('login-button')?.addEventListener('click', async () => {

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const userCredential = await signInWithEmailAndPassword(
            auth,
            email,
            password
        );

        const idToken = await userCredential.user.getIdToken();

        const response = await fetch('/login/firebase', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                token: idToken,
            }),
        });

        const data = await response.json();

        if (response.ok) {
            window.location.href = data.redirect;
        }
    } catch (error) {
        document.getElementById('login-error').textContent = error.message;
    }
});
