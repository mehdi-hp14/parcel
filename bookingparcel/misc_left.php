<?
include_once "session.php";
include_once "configure.php";
include_once "language.php";
?>
<div class="colL"> 
<img src="<?=$domain_url?>/images/leftmenu_top.gif" />
<div class="menu menuSkinA">
<ul>
<h3><? echo "$Misc" ?></h3>
<ul>
<li>
<? if($_GET["subfile"]=="Suggest" || $_GET["subfile"]==""){?>
<h4> <a href="Misc.html?file=Misc&subfile=Suggest" ><? echo "$Suggest_A_Link" ?></a></h4>
<? }else{?>
<a href="Misc.html?file=Misc&subfile=Suggest" ><? echo "$Suggest_A_Link" ?></a>
<? }?>
</li>
<li>
<? if($_GET["subfile"]=="Favorite_Categories_"){?>
<h4> <a href="Misc_favorite_categories.html?file=Misc&subfile=Favorite_Categories_" ><? echo "$Favorite_Categories_" ?></a></h4>
<? }else{?>
<a href="Misc_favorite_categories.html?file=Misc&subfile=Favorite_Categories_" ><? echo "$Favorite_Categories_" ?></a>
<? }?>
</li>
<li>
<? if($_GET["subfile"]=="Search_Results_"){?>
<h4> <a href="Misc_search_results.html?file=Misc&subfile=Search_Results_" ><? echo "$Search_Results_" ?></a></h4>
<? }else{?>
<a href="Misc_search_results.html?file=Misc&subfile=Search_Results_" ><? echo "$Search_Results_" ?></a>
<? }?>
</li>
<li>
<? if($_GET["subfile"]=="Favorite_List__"){?>
<h4> <a href="Misc_favorite_list.html?file=Misc&subfile=Favorite_List__" ><? echo "$Favorite_List__" ?></a></h4>
<? }else{?>
<a href="Misc_favorite_list.html?file=Misc&subfile=Favorite_List__" ><? echo "$Favorite_List__" ?></a>
<? }?>
</li>
</li>
<li>
<? if($_GET["subfile"]=="View_Story"){?>
<h4> <a href="manage_story.html?file=Misc&subfile=View_Story" ><? echo "$View_Story" ?></a></h4>
<? }else{?>
<a href="manage_story.html?file=Misc&subfile=View_Story" ><? echo "$View_Story" ?></a>
<? }?>
</li>
<li>
<? if($_GET["subfile"]=="Post_Story"){?>
<h4> <a href="Misc_post_success_story.html?file=Misc&subfile=Post_Story" ><? echo "$Post_Story" ?></a></h4>
<? }else{?>

<a href="Misc_post_success_story.html?file=Misc&subfile=Post_Story" ><? echo "$Post_Story" ?></a>
<? }?>

<li>
<? if($_GET["subfile"]=="View_Your_Trade_Show"){?>
<h4> <a href="manage_trade.html?file=Misc&subfile=View_Your_Trade_Show" ><? echo "$View_Your_Trade_Show" ?></a></h4>
<? }else{?>

<a href="manage_trade.html?file=Misc&subfile=View_Your_Trade_Show" ><? echo "$View_Your_Trade_Show" ?></a>
<? }?>
</li>
<li>
<? if($_GET["subfile"]=="Submit_Your_Trade_Show"){?>
<h4> <a href="Misc_submit_your_trade_show.html?file=Misc&subfile=Submit_Your_Trade_Show" ><? echo "$Submit_Your_Trade_Show" ?></a></h4>
<? }else{?>

<a href="Misc_submit_your_trade_show.html?file=Misc&subfile=Submit_Your_Trade_Show" ><? echo "$Submit_Your_Trade_Show" ?></a>
<? }?>
</li>

<li>
<? if($_GET["subfile"]=="CurrencyConverter"){?>
<h4> <a href="CurrencyConverter.html?file=Misc&subfile=CurrencyConverter" ><? echo "$CurrencyConverter" ?></a></h4>
<? }else{?>

<a href="CurrencyConverter.html?file=Misc&subfile=CurrencyConverter" ><? echo "$CurrencyConverter" ?></a>
<? }?>
</li>
</ul>
</ul>
<div style="margin-top: 20px;" align="center"> </div>
</div>
</div>