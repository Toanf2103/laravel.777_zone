const headerElm = document.getElementsByTagName("header")[0];
const headerLogo = headerElm.querySelector(".header-logo");
const headerMenu = headerElm.querySelector(".header-menu");
const headerSearch_cart = headerElm.querySelector(".header-search_cart");

const headerFormElm = headerElm.querySelector(".header-form-search");
const bgOverlay = document.getElementById("bg-overlay");

function showSearchForm() {
    headerLogo.classList.add("none");
    headerMenu.classList.add("none");
    headerSearch_cart.classList.add("none");

    headerFormElm.classList.remove("none");
    bgOverlay.classList.remove("none");

    bgOverlay.onclick = () => {
        hiddenSearchForm();
    };
}

function hiddenSearchForm() {
    headerLogo.classList.remove("none");
    headerMenu.classList.remove("none");
    headerSearch_cart.classList.remove("none");

    headerFormElm.classList.add("none");
    bgOverlay.classList.add("none");
}

