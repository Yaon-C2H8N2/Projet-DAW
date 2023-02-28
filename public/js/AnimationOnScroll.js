const observateur_from_right = new IntersectionObserver((entrees) => {
    entrees.forEach((entree) => {
        if (entree.isIntersecting) {
            entree.target.classList.add("show_element_from_view");
        } else {
            entree.target.classList.remove("show_element_from_view");
        }
    });
});

const hiddenElmts = document.querySelectorAll('.hidden_element_from_vue');
hiddenElmts.forEach((elmtn) => observateur_from_right.observe(elmtn));


