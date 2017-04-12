<?php

//added by helu-萝卜
$first = 1;
$prev = $page-1;
$next = $page+1;
$last = $pages;
if($page > 1)
{
    echo "<a href='".$dstHref."&page=".$first."'>  首页   </a>";
    echo "<a href='".$dstHref."&page=".$prev."'>  上一页  </a>";
}
if($page < $pages)
{
    echo "<a href=".$dstHref."&page=".$next."'>  下一页  </a>";
    echo "<a href=".$dstHref."&page=".$last."'>  末页  </a>";
}
echo "<div align = 'center'>共有" .$pages. "页(" .$page. "/" .$pages.")";
for($i=1; $i<$page; $i++)
    echo "<a href='".$dstHref."&page=".$i."'>[".$i."]</a>";
echo "[" .$page. "]";
for($i=$page+1; $i<=$pages;$i++)
    echo "<a href='".$dstHref."&page=".$i."'>[".$i."]</a>";
echo"</div>";

?>