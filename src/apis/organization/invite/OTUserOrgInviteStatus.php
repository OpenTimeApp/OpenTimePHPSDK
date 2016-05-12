<?php
/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 5/11/16
 * Time: 7:39 PM
 */

class OTUserOrgInviteStatus {

	const ALREADY_IN_ORG                  = 1;
	const ALREADY_INVITED                 = 2;
	const DECLINED                        = 3;
	const UNINVITED_AND_NOT_OPENTIME_USER = 4;
	const UNINVITED_BUT_OPENTIME_USER     = 5;
	const INVALID_EMAIL                   = 6;

}