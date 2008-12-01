<?php
/**
* Smarty PHPunit tests compilation of {if} tag
* 
* @package PHPunit
* @author Uwe Tews 
*/

require_once '../libs/Smarty.class.php';

/**
* class for {if} tag tests
*/
class CompileIfTests extends PHPUnit_Framework_TestCase {
    public function setUp()
    {
        $this->smarty = new Smarty();
        $this->smarty->plugins_dir = array('..' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR);
        $this->smarty->enableSecurity();
        $this->smarty->force_compile = true;
    } 

    public function tearDown()
    {
        unset($this->smarty);
        Smarty::$template_objects = null;
    } 

    /**
    * test {if} tag
    */
    public function testIf1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0<1}yes{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIf2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 2<1}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIf3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 2<1}yes{elseif 4<5}yes1{else}no{/if}');
        $this->assertEquals("yes1", $this->smarty->fetch($tpl));
    } 
    public function testIf4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 2<1}yes{elseif 6<5}yes1{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfTrue()
    {
        $tpl = $this->smarty->createTemplate('string:{if true}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfFalse()
    {
        $tpl = $this->smarty->createTemplate('string:{if false}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfNot1()
    {
        $tpl = $this->smarty->createTemplate('string:{if !(1<2)}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfNot2()
    {
        $tpl = $this->smarty->createTemplate('string:{if not (true)}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfEQ1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 == 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfEQ2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1==1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfEQ3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 EQ 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfEQ4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 eq 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfGT1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfGT2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0>1}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfGT3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 GT 0}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfGT4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 gt 1}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfGE1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 >= 0}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfGE2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1>=1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfGE3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 GE 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfGE4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 ge 1}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfLT1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 < 0}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfLT2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0<1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfLT3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 LT 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfLT4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 lt 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfLE1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 <= 0}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfLE2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0<=1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfLE3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 LE 0}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfLE4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 0 le 1}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfNE1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 != 1}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfNE2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1!=2}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfNE3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 NE 1}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfNE4()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 ne 2}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfIdent1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 === "1"}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfIdent2()
    {
        $tpl = $this->smarty->createTemplate('string:{if "1" === "1"}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfAnd1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0 && 5 < 6}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfAnd2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0&&5 < 6}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfAnd3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0 AND 5 > 6}}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfAnd4()
    {
        $tpl = $this->smarty->createTemplate('string:{if (1 > 0) and (5 < 6)}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfOr1()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0 || 7 < 6}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfOr2()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0||5 < 6}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfOr3()
    {
        $tpl = $this->smarty->createTemplate('string:{if 1 > 0 OR 5 > 6}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfOr4()
    {
        $tpl = $this->smarty->createTemplate('string:{if (0 > 0) or (9 < 6)}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfAndOR4()
    {
        $tpl = $this->smarty->createTemplate('string:{if ((7>8)||(1 > 0)) and (5 < 6)}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfFunc1()
    {
        $this->smarty->security_policy->php_functions = array('strlen');
        $tpl = $this->smarty->createTemplate('string:{if strlen("hello world") ==  11}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfFunc2()
    {
        $this->smarty->security_policy->php_functions = array('strlen');
        $tpl = $this->smarty->createTemplate('string:{if 3 ge strlen("foo")}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));
    } 
    public function testIfFunc3()
    {
        $this->smarty->security_policy->php_functions = array('isset');
        $tpl = $this->smarty->createTemplate('string:{if isset($foo)}yes{else}no{/if}');
        $this->assertEquals("no", $this->smarty->fetch($tpl));
    } 
    public function testIfFunc4()
    {
        $this->smarty->security_policy->php_functions = array('isset');
        $tpl = $this->smarty->createTemplate('string:{assign var=foo value=1}{if isset($foo)}yes{else}no{/if}');
        $this->assertEquals("yes", $this->smarty->fetch($tpl));    
    } 
} 

?>
