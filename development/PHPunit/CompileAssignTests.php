<?php
/**
* Smarty PHPunit tests compilation of assign tags
* 
* @package PHPunit
* @author Uwe Tews 
*/

require_once SMARTY_DIR . 'Smarty.class.php';

/**
* class for assign tags tests
*/
class CompileAssignTests extends PHPUnit_Framework_TestCase {
    public function setUp()
    {
        $this->smarty = new Smarty();
        $this->smarty->error_reporting = E_ALL;
        $this->smarty->enableSecurity();
        $this->smarty->force_compile = true;
        $this->old_error_level = error_reporting();
    } 

    public function tearDown()
    {
        error_reporting($this->old_error_level);
        unset($this->smarty);
        Smarty::$template_objects = null;
    } 

    /**
    * test old style of assign tag
    */
    public function testAssignRequiredAttributeVar()
    {
        try {
            $this->smarty->fetch('string:{assign value=1}');
        } 
        catch (Exception $e) {
            $this->assertContains('missing "var" attribute', $e->getMessage());
            return;
        } 
        $this->fail('Exception for required attribute "var" has not been raised.');
    } 

    public function testAssignOld1()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=1}{$foo}');
        $this->assertEquals("1", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld2()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var=\'foo\' value=1}{$foo}');
        $this->assertEquals("1", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld3()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var="foo" value=1}{$foo}');
        $this->assertEquals("1", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld4()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=bar}{$foo}');
        $this->assertEquals("bar", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld5()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=1+2}{$foo}');
        $this->assertEquals("3", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld6()
    {
        $this->smarty->security_policy->php_functions = array('strlen');
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=strlen(\'bar\')}{$foo}');
        $this->assertEquals("3", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld7()
    {
        $this->smarty->security_policy->modifiers = array('strlen');
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=\'bar\'|strlen}{$foo}');
        $this->assertEquals("3", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld8()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=[9,8,7,6]}{foreach $foo as $x}{$x}{/foreach}');
        $this->assertEquals("9876", $this->smarty->fetch($tpl));
    } 
    public function testAssignOld9()
    {
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=[\'a\'=>9,\'b\'=>8,\'c\'=>7,\'d\'=>6]}{foreach $foo as $x}{$x@key}{$x}{/foreach}');
        $this->assertEquals("a9b8c7d6", $this->smarty->fetch($tpl));
    } 
    /**
    * test new style of assign tag
    */
    public function testAssignNew1()
    {
        $tpl = $this->smarty->createTemplate('string:{$foo=1}{$foo}');
        $this->assertEquals("1", $this->smarty->fetch($tpl));
    } 
    public function testAssignNew2()
    {
        $tpl = $this->smarty->createTemplate('string:{$foo=bar}{$foo}');
        $this->assertEquals("bar", $this->smarty->fetch($tpl));
    } 
    public function testAssignNew3()
    {
        $tpl = $this->smarty->createTemplate('string:{$foo=1+2}{$foo}');
        $this->assertEquals("3", $this->smarty->fetch($tpl));
    } 
    public function testAssignNew4()
    {
        $this->smarty->security_policy->php_functions = array('strlen');
        $tpl = $this->smarty->createTemplate('string:{$foo=strlen(\'bar\')}{$foo}');
        $this->assertEquals("3", $this->smarty->fetch($tpl));
    } 
    public function testAssignNew5()
    {
        $this->smarty->security_policy->modifiers = array('strlen');
        $tpl = $this->smarty->createTemplate("string:{\$foo='bar'|strlen}{\$foo}");
        $this->assertEquals("3", $this->smarty->fetch($tpl));
    } 
    public function testAssignNew6()
    {
        $tpl = $this->smarty->createTemplate("string:{\$foo=[9,8,7,6]}{foreach \$foo as \$x}{\$x}{/foreach}");
        $this->assertEquals("9876", $this->smarty->fetch($tpl));
    } 
    public function testAssignNew7()
    {
        $tpl = $this->smarty->createTemplate("string:{\$foo=['a'=>9,'b'=>8,'c'=>7,'d'=>6]}{foreach \$foo as \$x}{\$x@key}{\$x}{/foreach}");
        $this->assertEquals("a9b8c7d6", $this->smarty->fetch($tpl));
    } 
    public function testAssignArrayAppend()
    {
        $tpl = $this->smarty->createTemplate("string:{\$foo=1}{\$foo[]=2}{foreach \$foo as \$x}{\$x@key}{\$x}{/foreach}");
        $this->assertEquals("0112", $this->smarty->fetch($tpl));
    } 
    public function testAssignArrayAppend2()
    {
        $this->smarty->assign('foo',1);
        $tpl = $this->smarty->createTemplate("string:{\$foo[]=2}{foreach \$foo as \$x}{\$x@key}{\$x}{/foreach}",$this->smarty);
        $this->assertEquals("0112", $this->smarty->fetch($tpl));
        $tpl2 = $this->smarty->createTemplate("string:{\$foo}",$this->smarty);
        $this->assertEquals("1", $this->smarty->fetch($tpl2));
    } 
    public function testAssignArrayAppend3()
    {
        $this->smarty->assign('foo',1);
        $tpl = $this->smarty->createTemplate("string:{\$foo[]=2 scope=root}{foreach \$foo as \$x}{\$x@key}{\$x}{/foreach}",$this->smarty);
        $this->assertEquals("0112", $this->smarty->fetch($tpl));
        $tpl2 = $this->smarty->createTemplate("string:{foreach \$foo as \$x}{\$x@key}{\$x}{/foreach}",$this->smarty);
        $this->assertEquals("0112", $this->smarty->fetch($tpl2));
    } 
    public function testAssignNestedArray()
    {
        $tpl = $this->smarty->createTemplate("string:{\$foo['a'][4]=1}{\$foo['a'][4]}");
        $this->assertEquals("1", $this->smarty->fetch($tpl));
    } 
} 

?>
