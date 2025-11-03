import "./bootstrap";
import '../css/app.css'; 
import initNav from "./nav";
import initShowPassword from "./showPassword";
import initLanguageSwitcher from "./languageSwitcher";
import initShippingAddress from "./shippingAddress";

document.addEventListener("DOMContentLoaded", () => {
    initNav();
    initShowPassword();
    initLanguageSwitcher();
    initShippingAddress();
});
