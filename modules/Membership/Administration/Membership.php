<?php
require ('modules/Membership/objects/templateMembership.php');
$membership = new templateMembership();
$membership->displayMember($idNav, 4);