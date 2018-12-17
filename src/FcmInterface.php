<?php

namespace MuhBayu\Fcm;

/**
 *
 */
interface FcmInterface
{
	public static function to($registration_id=null);
	public static function topic(string $topic);
	public static function notification(array $notification);
	public static function extra(array $data);
	public function send(array $notification=null, array $data=null);
}

?>
