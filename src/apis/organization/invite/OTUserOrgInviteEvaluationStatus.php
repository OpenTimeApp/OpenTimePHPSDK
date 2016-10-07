<?php

/**
 * Created on a Mac. Probably won't work on Windows.
 * User: josh
 * Date: 5/11/16
 * Time: 7:39 PM
 */
class OTUserOrgInviteEvaluationStatus {

	const ALREADY_IN_ORG                    = 1;
	const ALREADY_INVITED                   = 2;
	const ACCEPTED                          = 3;
	const REJECTED                          = 4;
	const UNINVITED_AND_NOT_OPENTIME_USER   = 5;
	const UNINVITED_BUT_OPENTIME_USER       = 6;
	const INVALID_EMAIL                     = 7;
	const CANNOT_BE_INVITED                 = 9;

}