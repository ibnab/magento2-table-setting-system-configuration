<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ibnab\Table\Block\Adminhtml\Form\Field;

class CustomerGroup extends \Magento\Framework\View\Element\Html\Select {

    /**
     * methodList
     *
     * @var array
     */
    protected $groupfactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Braintree\Model\System\Config\Source\Country $countrySource
     * @param \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory
     * @param array $data
     */
    public function __construct(
    \Magento\Framework\View\Element\Context $context, \Magento\Customer\Model\GroupFactory $groupfactory, array $data = []
    ) {
        parent::__construct($context, $data);
        $this->groupfactory = $groupfactory;
    }

    /**
     * Returns countries array
     * 
     * @return array
     */

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml() {
        if (!$this->getOptions()) {
            $customerGroupCollection = $this->groupfactory->create()->getCollection();
            foreach ($customerGroupCollection as $customerGroup) {
                     $this->addOption($customerGroup->getCustomerGroupId(), $customerGroup->getCustomerGroupCode());
            }
        }
        return parent::_toHtml();
    }

    /**
     * Sets name for input element
     * 
     * @param string $value
     * @return $this
     */
    public function setInputName($value) {
        return $this->setName($value);
    }

}
