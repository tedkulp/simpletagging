<?php
if (!isset($gCms)) exit;

	/*---------------------------------------------------------
	   Upgrade()
	   If your module version number does not match the version
	   number of the installed module, the CMS Admin will give
	   you a chance to upgrade the module. This is the function
	   that actually handles the upgrade.
	   Ideally, this function should handle upgrades incrementally,
	   so you could upgrade from version 0.0.1 to 10.5.7 with
	   a single call. For a great example of this, see the News
	   module in the standard CMS install.
	  ---------------------------------------------------------*/
	$current_version = $oldversion;
	switch($current_version)
	{
		case "0.2.1":
		{
			$db = $this->GetDb();

			$dict = NewDataDictionary($db);
			$sqlarray = $dict->AddColumnSQL(cms_db_prefix()."module_simpletagging", "module C(64) DEFAULT 'Core'");
			$dict->ExecuteSQLArray( $sqlarray );

			$db->Execute("UPDATE " . cms_db_prefix() . "module_simpletagging SET module = 'Core'");
		}
	}

	// put mention into the admin log
	$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('upgraded',$this->GetVersion()));
