function searchProducts() {

    const input =
        document.getElementById("searchInput");

    const search =
        input.value.toLowerCase();

    const products =
        document.querySelectorAll(".product");

    products.forEach(product => {

        const name =
            product
            .querySelector("h3")
            .textContent
            .toLowerCase();

        if (name.includes(search)) {

            product.style.display = "";

        } else {

            product.style.display = "none";

        }

    });

}