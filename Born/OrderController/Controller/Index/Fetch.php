<?php
namespace Born\OrderController\Controller\Index;

class Fetch extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
    $id = $this->getRequest()->getParam('id');
    $orderId = $this->getRequest()->getParam('id');
    if(isset($id) && !empty($id)) { 
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $order = $this->_objectManager->create('Magento\Sales\Model\Order')->load($id);
    $orderItems = $order->getAllItems();

    $itemQty = array();

    $item_details = array();
    $itemSku = '';
  if(isset($orderItems) && !empty($orderItems)) {
     foreach($orderItems as $orderItems) {
         $itemQty['getStatus'] = $orderItems['state'];
         $itemQty['created_at'] = $orderItems['created_at'];
         $itemQty['grand_total'] = $orderItems['grand_total'];
         }
    $orderId = $this->_objectManager->create('Magento\Sales\Model\Order')->load($id);
    $items = $orderId->getAllItems();
    
    foreach ($items as $item) {
            $item_details['price'] = $item->getPrice();
            $item_details['sku'] = $item->getSku();
            $item_details['product_name'] = $item->getName();
    }
   
        $result = array (
        "order_id" => $id,
        "order_detail" => $itemQty,
        "product_detail" => $item_details,    
        "msg"=> "Guset Order Details",
        );
        
        echo json_encode($result, JSON_PRETTY_PRINT);
        
    }    else {
       $result = array (
         
        "msg"=> "invalid Request",
        );
        
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    }
	}
  
}
