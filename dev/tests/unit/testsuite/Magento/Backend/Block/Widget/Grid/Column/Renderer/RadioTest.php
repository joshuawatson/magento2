<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Backend\Block\Widget\Grid\Column\Renderer;

class RadioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Radio
     */
    protected $_object;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_converter;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_column;

    protected function setUp()
    {
        $context = $this->getMock('\Magento\Backend\Block\Context', [], [], '', false);
        $this->_converter = $this->getMock(
            '\Magento\Backend\Block\Widget\Grid\Column\Renderer\Options\Converter',
            ['toFlatArray'],
            [],
            '',
            false
        );
        $this->_column = $this->getMock(
            'Magento\Backend\Block\Widget\Grid\Column',
            ['getValues', 'getIndex', 'getHtmlName'],
            [],
            '',
            false
        );
        $this->_object = new Radio($context, $this->_converter);
        $this->_object->setColumn($this->_column);
    }

    /**
     * @param array $rowData
     * @param string $expectedResult
     * @dataProvider renderDataProvider
     */
    public function testRender(array $rowData, $expectedResult)
    {
        $selectedTreeArray = [['value' => 1, 'label' => 'One']];
        $selectedFlatArray = [1 => 'One'];
        $this->_column->expects($this->once())->method('getValues')->will($this->returnValue($selectedTreeArray));
        $this->_column->expects($this->once())->method('getIndex')->will($this->returnValue('label'));
        $this->_column->expects($this->once())->method('getHtmlName')->will($this->returnValue('test[]'));
        $this->_converter->expects(
            $this->once()
        )->method(
            'toFlatArray'
        )->with(
            $selectedTreeArray
        )->will(
            $this->returnValue($selectedFlatArray)
        );
        $this->assertEquals($expectedResult, $this->_object->render(new \Magento\Framework\Object($rowData)));
    }

    public function renderDataProvider()
    {
        return [
            'checked' => [
                ['id' => 1, 'label' => 'One'],
                '<input type="radio" name="test[]" value="1" class="radio" checked="checked"/>',
            ],
            'not checked' => [
                ['id' => 2, 'label' => 'Two'],
                '<input type="radio" name="test[]" value="2" class="radio"/>',
            ]
        ];
    }
}
