<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery;

/**
 * @magentoAppArea adminhtml
 */
class ContentTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUploader()
    {
        /** @var $layout \Magento\Framework\View\Layout */
        $layout = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->get(
            'Magento\Framework\View\LayoutInterface'
        );
        /** @var $block \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery\Content */
        $block = $layout->createBlock('Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery\Content', 'block');

        $this->assertInstanceOf('Magento\Backend\Block\Media\Uploader', $block->getUploader());
    }
}
