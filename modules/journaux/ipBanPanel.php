<?php
require ('modules/journaux/objects/TemplateFireWall.php');
$firewall = new TemplateFireWall ();
$firewall->addIPBan ($idNav);
$firewall->displayAllBanIP ($idNav);

