<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="windows-1252">
        <title>Receipt Email</title>
    </head>
    <body>
        <h1>Receipt Email</h1>
        <br>
        <div>
            <h2>Thank you for purchasing item "{{ $paymentInfo->transactions[0]->item_list->items[0]->name }}"</h2>
        </div>
    </body>
</html>
