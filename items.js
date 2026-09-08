const products = [

    {
        id: 1,
        name: "Wireless Headphones",
        category: "electronics",
        price: 1999,
        oldPrice: 2999,
        icon: "🎧",
        rating: "★★★★★"
    },

    {
        id: 2,
        name: "Smart Watch",
        category: "electronics",
        price: 2499,
        oldPrice: 3999,
        icon: "⌚",
        rating: "★★★★☆"
    },

    {
        id: 3,
        name: "Premium Sneakers",
        category: "fashion",
        price: 1799,
        oldPrice: 2499,
        icon: "👟",
        rating: "★★★★★"
    },

    {
        id: 4,
        name: "Classic Backpack",
        category: "fashion",
        price: 999,
        oldPrice: 1499,
        icon: "🎒",
        rating: "★★★★☆"
    },

    {
        id: 5,
        name: "Table Lamp",
        category: "home",
        price: 799,
        oldPrice: 1199,
        icon: "💡",
        rating: "★★★★★"
    },

    {
        id: 6,
        name: "Coffee Maker",
        category: "home",
        price: 2999,
        oldPrice: 4499,
        icon: "☕",
        rating: "★★★★☆"
    },

    {
        id: 7,
        name: "Beauty Care Kit",
        category: "beauty",
        price: 1299,
        oldPrice: 1899,
        icon: "💄",
        rating: "★★★★★"
    },

    {
        id: 8,
        name: "Fitness Ball",
        category: "sports",
        price: 699,
        oldPrice: 999,
        icon: "⚽",
        rating: "★★★★☆"
    }

];


let cart = [];
let wishlist = [];


/* Display Products */

function displayProducts(list = products) {

    const container = document.getElementById("productContainer");

    container.innerHTML = "";

    if (list.length === 0) {

        container.innerHTML = `
            <p style="grid-column:1/-1;text-align:center;">
                No products found.
            </p>
        `;

        return;
    }

    list.forEach(product => {

        const item = document.createElement("div");

        item.className = "product";

        item.innerHTML = `

            <button class="wishlist"
                onclick="addWishlist(${product.id})">
                ♡
            </button>

            <div class="product-image">
                ${product.icon}
            </div>

            <div class="product-info">

                <h3>${product.name}</h3>

                <div class="rating">
                    ${product.rating}
                </div>

                <div class="price">
                    ₹${product.price}
                    <span class="old-price">
                        ₹${product.oldPrice}
                    </span>
                </div>

                <button class="add-cart"
                    onclick="addToCart(${product.id})">
                    Add to Cart
                </button>

            </div>
        `;

        container.appendChild(item);

    });

}


/* Filter */

function filterProducts(category) {

    let result;

    if (category === "all") {

        result = products;

    } else {

        result = products.filter(
            product => product.category === category
        );

    }

    displayProducts(result);

    document.getElementById("products")
        .scrollIntoView({
            behavior: "smooth"
        });
}


/* Search */

function searchProducts() {

    const search =
        document.getElementById("searchInput")
        .value
        .toLowerCase()
        .trim();

    const result = products.filter(product =>
        product.name.toLowerCase().includes(search)
    );

    displayProducts(result);

    document.getElementById("products")
        .scrollIntoView({
            behavior: "smooth"
        });
}


/* Enter key search */

document.getElementById("searchInput")
    .addEventListener("keypress", function(event) {

        if (event.key === "Enter") {
            searchProducts();
        }

    });


/* Cart */

function addToCart(id) {

    const product =
        products.find(p => p.id === id);

    cart.push(product);

    updateCart();

    showMessage(
        product.name + " added to cart!"
    );
}


function updateCart() {

    document.getElementById("cartCount")
        .textContent = cart.length;

    const container =
        document.getElementById("cartItems");

    container.innerHTML = "";

    let total = 0;

    cart.forEach((product, index) => {

        total += product.price;

        container.innerHTML += `

            <div class="cart-product">

                <span>
                    ${product.icon}
                    ${product.name}
                </span>

                <strong>
                    ₹${product.price}
                </strong>

                <button
                    onclick="removeFromCart(${index})">
                    ❌
                </button>

            </div>
        `;

    });

    document.getElementById("cartTotal")
        .textContent = total;

}


function removeFromCart(index) {

    cart.splice(index, 1);

    updateCart();
}


function openCart() {

    document.getElementById("cartModal")
        .style.display = "flex";

    updateCart();
}


function closeCart() {

    document.getElementById("cartModal")
        .style.display = "none";
}


/* Wishlist */

function addWishlist(id) {

    const product =
        products.find(p => p.id === id);

    if (!wishlist.includes(product.id)) {

        wishlist.push(product.id);

        showMessage(
            product.name + " added to wishlist!"
        );

    } else {

        showMessage(
            product.name + " is already in wishlist."
        );

    }

}


function showWishlist() {

    if (wishlist.length === 0) {

        alert("Your wishlist is empty.");

        return;
    }

    const names = wishlist.map(id => {

        const product =
            products.find(p => p.id === id);

        return product.name;

    });

    alert(
        "❤️ Wishlist:\n\n" +
        names.join("\n")
    );
}


/* Newsletter */

function subscribe() {

    const email =
        document.getElementById("email").value;

    if (email === "") {

        alert("Please enter your email.");

        return;
    }

    alert(
        "Thank you for subscribing to NovaShop!"
    );

    document.getElementById("email").value = "";

}


/* Checkout */

function checkout() {

    if (cart.length === 0) {

        alert("Your cart is empty.");

        return;
    }

    alert(
        "Checkout successful! 🎉\n\n" +
        "This is a demo website."
    );

}


/* Messages */

function showMessage(message) {

    alert(message);

}


/* Scroll */

function scrollToProducts() {

    document.getElementById("products")
        .scrollIntoView({
            behavior: "smooth"
        });

}


/* Initial Load */

displayProducts();