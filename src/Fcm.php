<?php

namespace MuhBayu;

use MuhBayu\Fcm\Exception\FcmException;

/**
 * @package laravel-firebase-cloud-messaging
 * @author MuhBayu <bnugraha00@gmail.com>
 * @link https://github.com/MuhBayu/laravel-firebase-cloud-messaging
 */

class Fcm implements \MuhBayu\Fcm\FcmInterface
{
	const FCM_BASEURL = 'https://fcm.googleapis.com/fcm/send';
	protected static $notification;
	protected static $extra_notification;
	protected $legacy_key;
	public static $topic;
	public static $fields = [];

   /**
   * Fcm instance.
   *
   * @return void
   */
	function __construct()
	{
		if (env('FCM_LEGACY_KEY')) $this->legacy_key = env('FCM_LEGACY_KEY');
	}
   /**
   * Message Recipient Token.
   *
   * @param $registration_id
   * @return void
   */
	public static function to($registration_id=null) {
		if (is_array($registration_id)) {
			Self::$fields['registration_ids'] = $registration_id;
		} elseif (is_string($registration_id)) {
			Self::$fields['to'] = $registration_id;
		} else {
			throw new FcmException("Error Processing Request", 1);
		}
		return new Self;
	}
   /**
   * Message Recipient Topic.
   *
   * @param string $topic
   * @return void
   */
	public static function topic(string $topic) {
		Self::$fields['to'] = $topic;
		Self::$topic = $topic;
		return new Self;
	}
   /**
   * Notification data.
   *
   * @param array $notification
   * @return void
   */
	public static function notification(array $notification) {
		Self::$fields['notification'] = $notification;
		Self::$notification = $notification;
		return new Self;
	}
   /**
   * Notification Extra data.
   *
   * @param array $data
   * @return void
   */
	public static function extra(array $data) {
		Self::$fields['data'] = $data;
		Self::$extra_notification = $data;
		return new Self;
	}
   /**
   * Send notification.
   *
   * @param array $notification
   * @param array $data
   * @return void
   */
	public function send(array $notification=null, array $data=null) {
		if (!is_null($notification)) {
			Self::$fields['notification'] = $notification;
		} elseif (!is_null($data)) {
			Self::$fields['data'] = $data;
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::FCM_BASEURL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: key=$this->legacy_key", 'Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(Self::$fields));
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		return $result;
	}
}