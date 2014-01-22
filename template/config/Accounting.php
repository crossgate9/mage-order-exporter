<?php 
$_columns = array(
    array('class'=>'Crossgate9_Order_Storeview', 'label'=>'Storeview', 'options'=>array('col-span'=>1)),

    // Increment Id
    array('class'=>'Crossgate9_Order_Increment', 'label'=>'OrderID', 'options'=>array('col-span'=>1)),
    array('class'=>'Crossgate9_Order_Status', 'label'=>'Status', 'options'=>array('col-span'=>1)),
    array('class'=>'Crossgate9_Order_Createdate', 'label'=>'Purchased on Date', 'options'=>array('col-span'=>1)),
    array('class'=>'Crossgate9_Order_Createtime', 'label'=>'Order Time', 'options'=>array('col-span'=>1, 'format'=>'H:i:s')),

    array('class'=>'Crossgate9_Order_Payment_Method', 'label'=>'Pay From', 'options'=>array('col-span'=>1)),
    array('class'=>'Crossgate9_Order_Payment_Transaction', 'label'=>'Transaction ID', 'options' => array('col-span'=>1,'format'=>'string')),
    array('class'=>'Crossgate9_Order_Currency', 'label'=>'Currency', 'options'=>array('col-span'=>1)),
    // array('type'=>'order', 'name'=>'Courier', 'label'=>'Courier', 'options'=>array('col-span'=>1,'full-name'=>true)),

    // // Shipping Info
    array('class'=>'Crossgate9_Order_Address_CustomerName', 'label'=>'Contact Name (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping')),
    array('class'=>'Crossgate9_Order_Address_Line', 'label'=>array('Address Line 1 (Shipping)', 'Address Line 2'), 'options'=>array('col-span'=>2,'type'=>'shipping')),
    array('class'=>'Crossgate9_Order_Address_City', 'label'=>'City (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping')),
    array('class'=>'Crossgate9_Order_Address_State', 'label'=>'State (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping')),
    array('class'=>'Crossgate9_Order_Address_Zip', 'name'=>'Zip', 'label'=>'Zip (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping')),
    array('class'=>'Crossgate9_Order_Address_Country', 'label'=>'Country (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping')),
    array('class'=>'Crossgate9_Order_Address_Phone', 'label'=>'Telephone (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping','format'=>'string')),
    array('class'=>'Crossgate9_Order_Address_Email', 'label'=>'Email (Shipping)', 'options'=>array('col-span'=>1,'type'=>'shipping')),

    // // Billing Info
    array('class'=>'Crossgate9_Order_Address_CustomerName', 'label'=>'Contact Name (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing')),
    array('class'=>'Crossgate9_Order_Address_Line', 'label'=>array('Address Line 1 (Billing)', 'Address Line 2'), 'options'=>array('col-span'=>2,'type'=>'billing')),
    array('class'=>'Crossgate9_Order_Address_City', 'label'=>'City (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing')),
    array('class'=>'Crossgate9_Order_Address_State', 'label'=>'State (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing')),
    array('class'=>'Crossgate9_Order_Address_Zip', 'label'=>'Zip (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing')),
    array('class'=>'Crossgate9_Order_Address_Country', 'label'=>'Country (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing')),
    array('class'=>'Crossgate9_Order_Address_Phone', 'label'=>'Telephone (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing','format'=>'string')),
    array('class'=>'Crossgate9_Order_Address_Email', 'label'=>'Email (Billing)', 'options'=>array('col-span'=>1,'type'=>'billing')),

    // // Item
    // array('type'=>'order', 'name'=>'Item', 'label'=>array('SKU', 'Description', 'EAN', 'Season', 'Season Number', 'Year', 'Quantity', 'Price (Ex. VAT)', 'VAT', 'Price (Incl. VAT)', 'Refunded'), 'options'=>array('col-span'=>9, 'delivery_fee'=>true)),
    
    // array('type'=>'order', 'name'=>'Discount', 'label'=>'Order Discount', 'options'=>array('col-span'=>1, 'show-once'=>true)),
    // array('type'=>'order', 'name'=>'Total', 'label'=>'Final Order Price', 'options'=>array('col-span'=>1, 'show-once'=>true)),
    // array('type'=>'order', 'name'=>'Refunded', 'label'=>'Total Refunded', 'options'=>array('col-span'=>1, 'show-once'=>true)),
); 
