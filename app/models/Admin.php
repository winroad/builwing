<?php
class Admin extends Eloquent{
 protected $table='users';
 protected $softDelete=true;
 protected $guarded=array('id');
}