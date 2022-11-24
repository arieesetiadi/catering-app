const categoryTitleSpan = document.querySelector("span#categoryTitle");

function changeCategory(event) {
    // Change title
    const el = event.target;
    const categoryTitle = el.textContent;
    categoryTitleSpan.textContent = categoryTitle;

    // Hide all product container
    const productContainers = document.querySelectorAll(".product-container");
    productContainers.forEach((pContainer) => {
        pContainer.classList.add("hidden");
    });

    // Show related product container
    const productContainer = document.getElementById(categoryTitle);
    productContainer.classList.remove("hidden");

    // Disable all active link
    const links = document.querySelectorAll(".link");
    links.forEach((link) => {
        link.classList.remove("link-active");
    });

    // Show related active link
    el.classList.add("link-active");
}
