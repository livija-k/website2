<?php
function echoRowValue($row, $column) 
{
  echo strip_tags($row[$column]);
}

function echoRowValueOr($row, $column, $or = "") 
{
  if (isset($row[$column])) 
    echo strip_tags($row[$column]);
  else if (isset($or))
    echo $or;
}

function echoValue($value) 
{
  echo strip_tags($value);
}

function echoValueOr($value, $or = "") 
{
  if (isset($value)) 
    return strip_tags($value);
  else
    return $or;
}

?>