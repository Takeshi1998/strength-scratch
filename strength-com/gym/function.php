<?php

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


function day($str){
  $week=date('m月d日 H時i分 ',strtotime($str));
  $day=date('w',strtotime($str));
  $j=array("日","月","火","水","木","金","土");
  return $week.$j[$day]."曜日";
  }