<?php
	namespace App\Helpers;
	use App\Models\Admin\Logs;

	class CreateLogs
	{
		
		public static function createLog($request)
		{
            Logs::create($request);
		}
	}