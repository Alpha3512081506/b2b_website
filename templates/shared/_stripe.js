
const stripe = Stripe("pk_test_51I0FHLBzJhxRixGxSeCNVbZPkxHsmRlt1KfVcp5fGq8d1jHadiIKeFvLmWeZ2kYifol06ibUaakjgHqzjCizx1bl00VRROozOK");.then(function (result) {.then(function (data) {
    const elements = stripe.elements();
    const card = elements.create("card", { style: style });
    // Stripe injects an iframe into the DOM
    card.mount("#card-element");
    card.on("change", function (event) { // Disable the Pay button if there are no card details in the Element
        document.querySelector("button").disabled = event.empty;
        document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
    });
    const form = document.getElementById("payment-form");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        // Complete payment when the submit button is clicked
        stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: card
            }
        }).then(function (result) {
            if (result.error) { // Show error to your customer
                showError(result.error.message);
            } else { // The payment succeeded!
                orderComplete(result.paymentIntent.id);
            }
        })
    });

