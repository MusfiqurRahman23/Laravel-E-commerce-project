<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order PDF</title>
</head>
<body>
    <h1>Order Details </h1>
    <h3>Customer name: {{$order->name}}</h3>
    <h3 class="td_deg">Customer e-mail: {{$order->email}}</h3>
    <h3 class="td_deg">Customer phone: {{$order->phone}}</h3>
    <h3 class="td_deg">Customer address: {{$order->address}}</h3>
    <h3 class="td_deg">Customer Id: {{$order->user_id}}</h3>

    <h3 class="td_deg">Product title: {{$order->product_title}}</h3>
    <h3 class="td_deg">Product price: {{$order->price}}</h3>
    <h3 class="td_deg">Product quantity: {{$order->quantity}}</h3>
    <h3 class="td_deg">Payment ststus: {{$order->Payment_status}}</h3>
    <h3 class="td_deg">Deliverey status: {{$order->delivery_status}}</h3>
    <br><br>
    <img height="250" width="450" src="/product/{{$order->image}}" alt="img">

</body>  
</html>