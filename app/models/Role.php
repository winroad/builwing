<?php
use Toddish\Verify\Models\Role as VerifyRole;

class Role extends VerifyRole{
 protected $softDelete=true;
 protected $guarded=array('id');
 
 
}