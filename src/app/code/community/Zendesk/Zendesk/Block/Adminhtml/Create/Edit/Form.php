<?php
/**
 * Copyright 2012 Zendesk.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class Zendesk_Zendesk_Block_Adminhtml_Create_Edit_form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post'
        ]);

        $fieldset = $form->addFieldset('base', [
            'legend'=>Mage::helper('adminhtml')->__('New Ticket'),
            'class'=>'fieldset-wide'
        ]);

        $fieldset->addField('requester', 'text', [
            'name'     => 'requester',
            'label'    => Mage::helper('zendesk')->__('Requester Email'),
            'title'    => Mage::helper('zendesk')->__('Requester Email'),
            'required' => true,
            'class'    => 'requester'
        ]);

        $fieldset->addField('requester_name', 'text', [
            'name'     => 'requester_name',
            'label'    => Mage::helper('zendesk')->__('Requester Name'),
            'title'    => Mage::helper('zendesk')->__('Requester Name'),
            'required' => false,
            'class'    => 'requester'
        ]);

        if(Mage::getModel('customer/customer')->getSharingConfig()->isWebsiteScope()) {
            $fieldset->addField('website_id', 'select', [
                'name'      => 'website_id',
                'label'     => Mage::helper('zendesk')->__('Requester Website'),
                'title'     => Mage::helper('zendesk')->__('Requester Website'),
                'required'  => true,
                'values'    => Mage::getModel('adminhtml/system_config_source_website')->toOptionArray(),
            ]);
        }

        $fieldset->addField('subject', 'text', [
            'name'     => 'subject',
            'label'    => Mage::helper('zendesk')->__('Subject'),
            'title'    => Mage::helper('zendesk')->__('Subject'),
            'required' => true
        ]);

        $fieldset->addField('status', 'select', [
            'name'     => 'status',
            'label'    => Mage::helper('zendesk')->__('Status'),
            'title'    => Mage::helper('zendesk')->__('Status'),
            'required' => true,
            'values'   => [
                ['label' => 'New', 'value' => 'new'],
                ['label' => 'Open', 'value' => 'open'],
                ['label' => 'Pending', 'value' => 'pending'],
                ['label' => 'Solved', 'value' => 'solved'],
            ]
        ]);

        $fieldset->addField('type', 'select', [
            'name'     => 'type',
            'label'    => Mage::helper('zendesk')->__('Type'),
            'title'    => Mage::helper('zendesk')->__('Type'),
            'required' => false,
            'values'   => [
                ['label' => '-', 'value' => ''],
                ['label' => 'Problem', 'value' => 'problem'],
                ['label' => 'Incident', 'value' => 'incident'],
                ['label' => 'Question', 'value' => 'question'],
                ['label' => 'Task', 'value' => 'task'],
            ]
        ]);

        $fieldset->addField('priority', 'select', [
            'name'     => 'priority',
            'label'    => Mage::helper('zendesk')->__('Priority'),
            'title'    => Mage::helper('zendesk')->__('Priority'),
            'required' => false,
            'values'   => [
                ['label' => 'Low', 'value' => 'low'],
                ['label' => 'Normal', 'value' => 'normal'],
                ['label' => 'High', 'value' => 'high'],
                ['label' => 'Urgent', 'value' => 'urgent'],
            ]
        ]);

        $fieldset->addField('order', 'text', [
            'name'     => 'order',
            'label'    => Mage::helper('zendesk')->__('Order Number'),
            'title'    => Mage::helper('zendesk')->__('Order Number'),
            'required' => false
        ]);

        $fieldset->addField('description', 'textarea', [
            'name'     => 'description',
            'label'    => Mage::helper('zendesk')->__('Description'),
            'title'    => Mage::helper('zendesk')->__('Description'),
            'required' => true
        ]);

        if (Mage::registry('zendesk_create_data')) {
            $form->setValues(Mage::registry('zendesk_create_data'));
        }

        $form->setUseContainer(true);
        $form->setMethod('post');
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
