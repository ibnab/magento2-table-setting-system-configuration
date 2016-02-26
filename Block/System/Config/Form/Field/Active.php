<?php

namespace Ibnab\Table\Block\System\Config\Form\Field;

class Active extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray {

    /**
     * Grid columns
     *
     * @var array
     */
    protected $_columns = [];
    protected $_customerGroupRenderer;

    /**
     * Enable the "Add after" button or not
     *
     * @var bool
     */
    protected $_addAfter = true;

    /**
     * Label of add button
     *
     * @var string
     */
    protected $_addButtonLabel;

    /**
     * Check if columns are defined, set template
     *
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Returns renderer for country element
     * 
     * @return \Magento\Braintree\Block\Adminhtml\Form\Field\Countries
     */
    protected function getCustomerGroupRenderer() {
        if (!$this->_customerGroupRenderer) {
            $this->_customerGroupRenderer = $this->getLayout()->createBlock(
                    '\Ibnab\Table\Block\Adminhtml\Form\Field\CustomerGroup', '', ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->_customerGroupRenderer;
    }

    /**
     * Prepare to render
     *
     * @return void
     */
    protected function _prepareToRender() {
        $this->addColumn(
                'customer_group', [
            'label' => __('Customer Group'),
            'renderer' => $this->getCustomerGroupRenderer(),
                ]
        );
        $this->addColumn('active', array('label' => __('Active')));
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    protected function _prepareArrayRow(\Magento\Framework\DataObject $row) {
        $customerGroup = $row->getCustomerGroup();
        $options = [];
        if ($customerGroup) {
            $options['option_' . $this->getCustomerGroupRenderer()->calcOptionHash($customerGroup)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
        }
    /**
     * Render array cell for prototypeJS template
     *
     * @param string $columnName
     * @return string
     * @throws \Exception
     */
    public function renderCellTemplate($columnName)
    {
        if ($columnName == "active") {
            $this->_columns[$columnName]['class'] = 'input-text required-entry validate-number';
            $this->_columns[$columnName]['style'] = 'width:50px';
        }

        return parent::renderCellTemplate($columnName);
    }
}
