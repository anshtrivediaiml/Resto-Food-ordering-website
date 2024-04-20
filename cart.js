document.addEventListener("DOMContentLoaded", () => {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");
  const cartItemcount = document.querySelector(".cart-icon span");
  const cartItemslist = document.querySelector(".cart-items");
  const cartTotal = document.querySelector(".cart-total");
  const cartIcon = document.querySelector(".cart-icon");
  const sidebar = document.querySelector(".sidebar");
  const checkoutButton = document.querySelector("#checkout-btn"); // Selecting the checkout button

  let cartItems = [];
  let totalAmount = 0;

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault();

      let price = parseFloat(button.dataset.itemPrice);
      const item = {
        name: button.dataset.itemName,
        price: price,
        quantity: 1,
      };

      const existingItem = cartItems.find(
        (cartItem) => cartItem.name === item.name
      );

      if (existingItem) {
        existingItem.quantity++;
      } else {
        cartItems.push(item);
      }

      totalAmount += price; // Ensure price is a number
      updateCartUI();
    });
  });

  function updateCartUI() {
    updateCartItemCount(cartItems.length);
    updateCartItemList();
    updateCartTotal();
  }

  function updateCartItemCount(count) {
    cartItemcount.textContent = count;
  }

  function updateCartItemList() {
    cartItemslist.innerHTML = "";
    cartItems.forEach((item, index) => {
      const cartItem = document.createElement("div");
      cartItem.classList.add("cart-item", "individual-cart-item");
      cartItem.innerHTML = `<span>(${item.quantity}x) ${item.name}</span>
              <span class="cart-item-price">$${(
                item.price * item.quantity
              ).toFixed(2)}
              <button class='remove-btn' data-index="${index}"><i class="fa-solid fa-times"> </i></button>
              </span>`;

      cartItemslist.append(cartItem);
    });

    document.querySelectorAll(".remove-btn").forEach((button) => {
      button.addEventListener("click", (event) => {
        const index = parseInt(event.target.dataset.index);
        removeItemsFromCart(index);
      });
    });
  }

  function removeItemsFromCart(index) {
    const removedItem = cartItems.splice(index, 1)[0];
    totalAmount -= removedItem.price * removedItem.quantity; // Ensure price is a number
    updateCartUI();
  }

  function updateCartTotal() {
    cartTotal.innerHTML = `$${totalAmount.toFixed(2)}`;
  }

  cartIcon.addEventListener("click", (e) => {
    e.preventDefault();
    sidebar.classList.toggle("open");
  });

  const closeButton = document.querySelector(".sidebar-close");
  closeButton.addEventListener("click", () => {
    sidebar.classList.remove("open");
  });

  // Checkout functionality
  checkoutButton.addEventListener("click", handleCheckout);

  function handleCheckout() {
    // Serialize and send cart data to server
    fetch("store_order.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ cartItems, totalAmount }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(
            "Your Order Booking is Successful. Click OK to go ahead with user information form."
          );
          window.location.href = `userinfo_form.php?orderNumber=${data.orderNumber}&totalAmount=${totalAmount}`;
        }
      })
      .catch((error) => console.error("Error:", error));
  }
});
