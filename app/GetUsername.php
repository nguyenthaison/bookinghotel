<?php

namespace App;

trait GetUsername {

	// public function getAvailUser ($value) {

	// 	/**
	//      * Get User by username
	//      *
	//      * @return username
	//      */
	// 	$sellers = User::where('email', '=', $value)
	// 					->get(['email']);

	// 	return $sellers;
	// }

	// public function getAvailEmail ($value) {

	// 	/**
	//      * Get all users email
	//      *
	//      * @return user email
	//      */
	// 	$sellers = User::where('email', '=', $value)
	// 					->get(['email']);

	// 	return $sellers;

	// }

	/**
     * Get image profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getImageProfile($id)
    {
        //
        $image = User::where('id', '=', $id)
                        ->get(['photo', 'email'])->toArray();
        
        if (count($image[0]['photo'])) {
            $path = url('assets/images/' . env('IMAGE_PATH'));
            $imageProfile = $path . '/' . $image[0]['photo'];

        } else {
            $imageProfile = $this->getGravatar($image[0]['email']);
        }
        return $imageProfile;
    }

    /**
     * Gravatar profile.
     *
     * @param  string  $email
     * @return url of gravatar
     */
    function getGravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

}