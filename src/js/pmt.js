function pmt() {
    if (typeof(paypal) === "object") {
        const paypalButtonsComponent = paypal.Buttons({
            // optional styling for buttons
            // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
            style: {
                color: "gold",
                shape: "rect",
                layout: "vertical"
            },

            // set up the transaction
            createOrder: (data, actions) => {
                // pass in any options from the v2 orders create call:
                // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                var amount = 5;

                const createOrderPayload = {
                    purchase_units: [{
                        amount: {
                            value: amount
                        }
                    }]
                };

                return actions.order.create(createOrderPayload);
            },

            // finalize the transaction
            onApprove: (data, actions) => {
                const captureOrderHandler = (details) => {
                    const payerName = details.payer.name.given_name;
                    console.log('Transaction completed', payerName);
                };

                return actions.order.capture().then(captureOrderHandler);
            },

            // handle unrecoverable errors
            onError: (err) => {
                console.error('An error prevented the buyer from checking out with PayPal');
            },

            onCancel: (err) => {
                console.log("Cancelado");
            }
        });

        paypalButtonsComponent
            .render("#paypal-button-container")
            .catch((err) => {
                console.error('PayPal Buttons failed to render');
            });
    }
}