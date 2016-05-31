<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class ScoresModel extends RelationModel {
	protected $tablePrefix = '';
	protected $_link = array(
			"Users"	=> array(
							"mapping_type"	=> self::BELONGS_TO,
							"class_name" 	=> "Users",
							"foreign_key"	=> "student_id",
							"mapping_fields"=> "user_name,family_difficulties,support,loan,college_id",
							"as_fields"		=> "user_name,family_difficulties,support,loan,college_id"
					),
			"Colleges"=>array(
					"mapping_type"	=> self::BELONGS_TO,
					"class_name" 	=> "Colleges",
					"foreign_key"	=> "college_id",
					"mapping_fields"=> "college_name",
					"as_fields"		=> "college_name"
			)
			
	);
	
}