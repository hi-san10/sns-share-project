import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";

export default defineNuxtPlugin(nuxtApp => {
  const firebaseConfig = {
    apiKey: "AIzaSyCmKUVAtDNoP9eyTfX_DIxNuqY4Zlr8Vsk",
    authDomain: "share-authentication-9888f.firebaseapp.com",
    projectId: "share-authentication-9888f",
    storageBucket: "share-authentication-9888f.appspot.com",
    messagingSenderId: "1013360355560",
    appId: "1:1013360355560:web:f665ba8ea13f51bc04415d",
  };

  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);

  return {
    provide: {
      auth,
    },
  };
});
