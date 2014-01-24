<?php
class EcomInfinity_OrderExporter_Block_OrderExporter extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getOrderExporter()     
     { 
        if (!$this->hasData('orderexporter')) {
            $this->setData('orderexporter', Mage::registry('orderexporter'));
        }
        return $this->getData('orderexporter');
        
    }
}