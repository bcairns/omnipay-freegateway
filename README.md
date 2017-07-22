# Omnipay Free Gateway

## Description

This is an implementation of an [Omnipay](https://github.com/thephpleague/omnipay) payment gateway that allows for free orders.

Additional files (and instructions below) are included for integration with SilverStripe's [SilverShop](https://github.com/silvershop/silvershop-core) e-commerce platform, however the core gateway files `FreeGateway.php`, `FreeRequest.php`, and `FreeResponse.php` are not SilverStripe-specific and should (in theory) be usable with any Omnipay installation.

This is just a straight copy of code files from an existing project, it was not originally written as a re-usable module.  As such there are hard-coded strings in places and it requires a bit of manual setup.  Please modify to your needs.

## SilverStripe / SilverShop instructions

1. Download the code and place it somewhere in your `mysite` folder (eg, in a FreeGateway folder).
2. Ensure your `Product` or `Buyable` implementation allows for zero-price in its `canPurchase()` method (otherwise you will not be able to add them to the shopping cart).
3. In `config.yml`, specify `CheckoutStep_PaymentMethod_Custom` as the `paymentmethod` step, eg:
```
# The other steps will depend on your specific setup
CheckoutPage:
  steps:
    contactdetails: 'CheckoutStep_ContactDetails'
    discount: 'CheckoutStep_Discount'
    paymentmethod: 'CheckoutStep_PaymentMethod_Custom'
    summary: 'CheckoutStep_Summary'
```
4. In `config.yml`, add `allow_zero_order_total: true` under `Order:`
```
Order:
     allow_zero_order_total: true
```
5. (optional) In `config.yml` you may add `CheckoutPage_Controller_Extension` as an extension for `CheckoutPage_Controller`.  This will change the button text on the confirmation page to "Complete Your Free Order!" (instead of "Proceed to Payment"), provided the order total is zero of course.
```
CheckoutPage_Controller:
  extensions:
    - CheckoutPage_Controller_Extension
```
6. In `payment.yml`, add FreeGateway as an allowed gateway:
```
Payment:
  allowed_gateways:
    - 'FreeGateway'
```

7. In `payment.yml`, you must set FreeGateway's `is_manual` flag under `GatewayInfo:`
```
GatewayInfo:
  FreeGateway:
    # don't collect payment info for this gateway, as we are handling that "manually"
    is_manual: true
```

## Additional Notes

The FreeGateway itself is just a bare "null implementation" of an Omnipay gateway that simply returns true for `isSuccessful()`, as there is no payment to verify.

The critical (and SilverShop-specific) integration logic takes place in `PaymentCheckoutComponent_Custom`, which does two important things:

1. It modifies the Payment Options form according to the order's Grand Total; the Free option will be the only available option if the total is zero, and vice-versa (it will be disabled if the total is not zero).
2. It adds a validation step to ensure the user cannot select an invalid payment option.
 
If you are using the FreeGateway on a platform other than SilverShop, you will need to find a way to implement the above logic on the platform you are using.

## Other Modules

* This works well with SilverShop's [Discounts](https://github.com/silvershop/silvershop-discounts) module; if a discount or coupon reduces the order total to zero then the free payment option will be enabled during checkout.