<?php
function getRowValue($row, $column) 
{
  return strip_tags($row[$column]);
}

function getRowValueOr($row, $column, $or = "") 
{
  if (isset($row[$column])) 
    return strip_tags($row[$column]);
  else 
    return $or;
}

function getValue($value) 
{
  return strip_tags($value);
}

function getValueOr($value, $or = "") 
{
  if (isset($value)) 
    return strip_tags($value);
  else
    return $or;
}

?>