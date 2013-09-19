<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function patient_phone(){
	return '<div class="control-group">
	                <label class="control-label" for="phone">Phone</label>
	                <div class="controls">
	                    <input name="txt_patPhone[]" value="" type="number"  minlength="10" id="phone" placeholder="(855)">
	                    <span class="icon-trash" style="cursor: pointer;" name="remove_phone"></span>
	                    <span class="help-inline"></span>
	                </div>
	            </div>';
}
?>