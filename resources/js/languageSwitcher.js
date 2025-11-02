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
                e.preventDefault();
                e.stopPropagation();
                const locale = $option.dataset.locale;
                const basePath = $dropdown.dataset.basePath;
                const queryString = $dropdown.dataset.queryString;

                if (locale) {
                    let newPath;
                    if (locale === "en") {
                        newPath = basePath === "/" ? "/" : basePath;
                    } else {
                        const pathPart =
                            basePath === "/" ? "" : basePath.replace(/^\//, "");
                        newPath = `/${locale}${pathPart ? "/" + pathPart : ""}`;
                    }

                    window.location.href = newPath + queryString;
                }
            });
        });
    });
}

export default initLanguageSwitcher;
