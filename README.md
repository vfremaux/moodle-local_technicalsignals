Local Technical Signals
=======================

This simple plugins provides an easy mean to display service messages to all users without taking over
the moodle screen.

Messages can be distributed to a complete MNET enabled network array activating data_transfer service (See VMoodle).

Message colors available are : 

RED : Danger notice

ORANGE : Critical operations in progress

YELLOW : Non critical operation in progress

GREEN : Positive message

CYAN : Information notice

Versions
==========

Original code reference is on 
http://github.com/vfremaux/moodle-local_technicalsignals

Branch : master for version 2.x > 2.2 (should work on 2.1)

No packaged version for 1.9

Install
=========
 
Installs in the "local" standard customisation directory
 
How to make it work locally:
==============================

you just need to have in your curent theme an inclusion to

<moodleroot>/local/technicalsignals/lib.php

and make a call to : 

local_print_administrator_message();

Just after the "<BODY>" tag of your layout. 
 
How to make it work in Moodle Network:
======================================

you need : 

VMoodle block installed (for Data Exchange Mnet service)

$CFG->mainhostprefix being setup to a recognizable prefix of a mnet_host of your 
network with Data_Exchange services published.

You need (of course ;-) ) to subscribe to Data_Exchange service for this main peer. 

Hook Sample :

<?php 
include_once $CFG->dirroot.'/local/technicalsignals/lib.php';
local_print_administrator_message()
?>
