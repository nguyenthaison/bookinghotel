<?php

namespace App;

use Response;
/**************************************************
			miscellaneous functions
**************************************************/

trait Miscellaneous {

	/**
     * Get IP Address of users.
     *
     * 
     * @return \Illuminate\Http\Response
     */
	function getIpAddress () {

		if ( function_exists( 'apache_request_headers' ) ) {

			$headers = apache_request_headers();

		} else {

			$headers = $_SERVER;

		}

		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

			$ipAddress = $headers['X-Forwarded-For'];

		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {

			$ipAddress = $headers['HTTP_X_FORWARDED_FOR'];

		} else {
			
			$ipAddress = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );

		}

		return $ipAddress;

	}

}