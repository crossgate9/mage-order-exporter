<?php
class EcomInfinity_OrderExporter_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/orderexporter?id=15 
    	 *  or
    	 * http://site.com/orderexporter/id/15 	
    	 */
    	/* 
		$orderexporter_id = $this->getRequest()->getParam('id');

  		if($orderexporter_id != null && $orderexporter_id != '')	{
			$orderexporter = Mage::getModel('orderexporter/orderexporter')->load($orderexporter_id)->getData();
		} else {
			$orderexporter = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($orderexporter == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$orderexporterTable = $resource->getTableName('orderexporter');
			
			$select = $read->select()
			   ->from($orderexporterTable,array('orderexporter_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$orderexporter = $read->fetchRow($select);
		}
		Mage::register('orderexporter', $orderexporter);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}