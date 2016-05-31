<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UsersModel extends RelationModel {
	protected $tablePrefix = '';
	protected $_link = array(
			"Colleges"=>array(
					"mapping_type"	=> self::BELONGS_TO,
					"class_name" 	=> "Colleges",
					"foreign_key"	=> "college_id",
					"mapping_fields"=> "college_name",
					"as_fields"		=> "college_name"
			)
			
	);
	
}