// checkout.js

// Function to change the product image
function changeProductImage(imageSrc) {
    document.getElementById("productImage").src = imageSrc;
}

// Example: Adding event listeners to product thumbnails to change the image
document.getElementById("product1").addEventListener("click", function() {
    changeProductImage("product1_image.jpg");
});

document.getElementById("product2").addEventListener("click", function() {
    changeProductImage("product2_image.jpg");
});

// Add similar event listeners for other products
