<?php
function years() {
 $firstYear = 2009;
 $currentYearString = date('Y');
 $currentYear = intval($currentYearString);
 if($currentyear == $firstYear) {
  echo $firstYear;
 } else {
  echo $firstYear.' - '.$currentYear;
 }
}
?>