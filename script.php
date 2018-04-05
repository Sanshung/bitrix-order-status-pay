<?
\Bitrix\Main\Loader::includeModule('sale');

$orderData = " 2018-04-04T19:00:46";
$orderCheck = "test 1232-".time();

$order = \Bitrix\Sale\Order::Load(112004);


$order->setField("STATUS_ID", "CL");
$order->setField('COMMENTS', 'Заказ был закрыт автоматически');


$paymentCollection = $order->getPaymentCollection();
foreach ($paymentCollection as $payment) {
    $payment->setFields(array(
        'PAY_VOUCHER_NUM' => $orderCheck,
        'PAY_VOUCHER_DATE' => \Bitrix\Main\Type\DateTime::createFromTimestamp(strtotime($orderData)),
    ));
    $p = $payment->setPaid('Y');
    $payment->save();
}
$order->save();
?>
