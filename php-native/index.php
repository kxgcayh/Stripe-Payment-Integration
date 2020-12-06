<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Stripe Payment</title>
   <!-- Stripe JavaScript library -->
   <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
   <!-- Display errors returned by checkout session -->
   <div id="paymentResponse"></div>

   <!-- Product details -->
   <h2 id="productName">
      <!--  -->
   </h2>
   <img src="stripe-php/images/product-image.png" />
   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
   <p>Price: <b id="productPrice">$<?php echo $productPrice . ' ' . strtoupper($currency); ?></b></p>

   <!-- Buy button -->
   <div id="buynow">
      <button class="stripe-button" id="payButton">Buy Now</button>
   </div>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

   <script>
      $(document).ready(function() {
         getPackageData();
      });
      var buyBtn = document.getElementById('payButton');
      var responseContainer = document.getElementById('paymentResponse');

      // Create a Checkout Session with the selected product
      var createCheckoutSession = function(stripe) {
         return fetch("stripe_charge.php", {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify({
               checkoutSession: 1,
            }),
         }).then(function(result) {
            return result.json();
         });
      };

      // Handle any errors returned from Checkout
      var handleResult = function(result) {
         if (result.error) {
            responseContainer.innerHTML = '<p>' + result.error.message + '</p>';
         }
         buyBtn.disabled = false;
         buyBtn.textContent = 'Buy Now';
      };

      // Specify Stripe publishable key to initialize Stripe.js
      var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

      buyBtn.addEventListener("click", function(evt) {
         buyBtn.disabled = true;
         buyBtn.textContent = 'Please wait...';

         createCheckoutSession().then(function(data) {
            if (data.sessionId) {
               stripe.redirectToCheckout({
                  sessionId: data.sessionId,
               }).then(handleResult);
            } else {
               handleResult(data);
            }
         });
      });

      function getPackageData() {
         const currency = "<?php echo strtoupper($currency); ?>";
         const productName = document.getElementById('productName').innerHTML = 'Example Product';
         const productPrice = document.getElementById('productPrice').innerHTML = `$25 ${currency}`;
      }
   </script>
</body>

</html>
