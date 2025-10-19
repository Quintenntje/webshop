import "./bootstrap";
import '../css/app.css'; 
import initNav from "./nav";
import initShowPassword from "./showPassword";

document.addEventListener("DOMContentLoaded", () => {
    initNav();
    initShowPassword();
});
