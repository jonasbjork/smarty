<br>Here starts test_inc2.tpl
<br>$foo in test_inc2 before changing = {$foo}
{assign var=foo value="bah"}
{time()}
<br>$foo in test_inc2 after changing = {$foo}
{assign var=foo2 value="bla" global=true}
