<?php
	namespace App\Helpers;
	use App\User;

	class GenerateNickName
	{
		
		public static function nickName($firstname)
		{
			$nickname = substr(str_replace(' ','',$firstname), 0, 30).rand(5,99999);

			$user = User::where('nickname',$nickname)->first();
			if($user){
				$this.nickName($firstname);
			}else{
				return $nickname;
			}
		}
	}