<!-- pay.html -->
<html>
<head>
<title>Pay</title>
</head>
<body>

<form id=pay name=pay method="POST" action="https://merchant.wmtransfer.com/lmi/payment.asp">

<p>model payment via Merchant WebMoney Transfer</p>
<p>pay 1 WMZ...</p>

<p>
    <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="1.0">
    <input type="hidden" name="LMI_PAYMENT_DESC" value="test payment">
    <input type="hidden" name="LMI_PAYMENT_NO" value="1">
    <input type="hidden" name="LMI_PAYEE_PURSE" value="Z145179295679">
    <input type="hidden" name="LMI_SIM_MODE" value="0">
</p>
<p>    
    <input type="submit" value="submit">
</p>
</form>

</body>
</html>