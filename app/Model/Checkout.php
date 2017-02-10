<?php
class Checkout extends AppModel
{
    public $useTable = false;
    public function cartProduct($carts)
    {
        $products = array();
        $record_arr=array();
        if (null!=$carts)
        {
            $Package=ClassRegistry::init('Package');
            foreach ($carts as $productId => $count)
            {
              $product = $Package->findById($productId);
              $record_arr[]=array('name'=>$product['Package']['group_name'],'tax'=>0.00,'shipping'=>0.00,'description'=>'',
                                  'quantity'=>$count,'amount'=>$product['Package']['price'],'subtotal'=>$count*$product['Package']['price'],'billingFrequency'=>$product['Package']['day']);
            }
        }
        return $record_arr;
    }
}
?>