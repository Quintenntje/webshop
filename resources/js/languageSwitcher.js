function initLanguageSwitcher() {
    const $switchers = document.querySelectorAll(".language-switcher");

    if (!$switchers.length) return;

    $switchers.forEach(($switcher) => {
        const $toggle = $switcher.querySelector(".language-switcher__button");
        const $dropdown = $switcher.querySelector(
            ".language-switcher__dropdown"
        );
        const $options = $switcher.querySelectorAll(
            ".language-switcher__option"
        );

        if (!$toggle || !$dropdown) return;

        function handleClickOutside(e) {
            if (!$switcher.contains(e.target)) {
                document
                    .querySelectorAll(".language-switcher__dropdown")
                    .forEach(($dd) => {
                        $dd.hidden = true;
                    });
                document.removeEventListener("click", handleClickOutside);
            }
        }

        $toggle.addEventListener("click", (e) => {
            e.stopPropagation();
            const isHidden = $dropdown.hidden;

            document
                .querySelectorAll(".language-switcher__dropdown")
                .forEach(($dd) => {
                    if ($dd !== $dropdown) {
                        $dd.hidden = true;
                    }
                });

            $dropdown.hidden = !isHidden;

            if (isHidden) {
                setTimeout(() => {
                    document.addEventListener("click", handleClickOutside);
                }, 0);
            } else {
                document.removeEventListener("click", handleClickOutside);
            }
        });

        $options.forEach(($option) => {
            $option.addEventListener("click", (e) => {
                // Let the link handle navigation naturally
                // The href is already set by LaravelLocalization
                $dropdown.hidden = true;
            });
        });
    });
}

export default initLanguageSwitcher;
