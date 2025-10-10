function initNav() {
    const $menuOpen = document.getElementById("menu-open");
    const $menuClose = document.getElementById("menu-close");
    const $menu = document.getElementById("mobile-menu");
    const $overlay = document.getElementById("menu-overlay");

    if (!$menu || !$overlay || !$menuOpen || !$menuClose) return;

    const open = () => {
        $menu.setAttribute("aria-hidden", "false");
        $overlay.hidden = false;
        document.body.style.overflow = "hidden";
    };

    const close = () => {
        $menu.setAttribute("aria-hidden", "true");
        $overlay.hidden = true;
        document.body.style.overflow = "";
    };

    $menuOpen.addEventListener("click", open);
    $menuClose.addEventListener("click", close);
    $overlay.addEventListener("click", close);
}

export default initNav;
