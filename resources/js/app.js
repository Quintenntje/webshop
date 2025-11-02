import "./bootstrap";
import '../css/app.css'; 
import initNav from "./nav";
import initShowPassword from "./showPassword";
import initLanguageSwitcher from "./languageSwitcher";

document.addEventListener("DOMContentLoaded", () => {
    initNav();
    initShowPassword();
    initLanguageSwitcher();
});
