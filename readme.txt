Local Technical Signals
#######################

This simple plugins provides an easy mean to display service messages to all users without taking over
the moodle screen.

Messages can be distributed to a complete MNET enabled network array activating data_transfer service (See VMoodle).
this is optional for VMoodle administrators only.

Message colors available are : 

RED : Danger notice
ORANGE : Critical operations in progress
YELLOW : Non critical operation in progress
GREEN : Positive message
CYAN : Information notice

Versions
########

Original code reference is on 
http://github.com/vfremaux/moodle-local_technicalsignals

Branch : master for version 2.x > 2.2 (should work on 2.1)

No packaged version for 1.9

Install
#######
 
Installs in the "local" standard customisation directory
 
How to make it work locally:
############################

Open your main config file and add : 

$CFG->dirroot = '<your dir root>'; // this will be lately be redefined in your setup.php, but that might be a bit too late
require_once $CFG->dirroot.'/local/technicalsignals/lib.php';
$CFG->additionalhtmlhead = local_print_administrator_message(true);

AFTER CALL TO setup.php (or configuration keys out from DB will not be available)

Note that you will need to explictely add this configiuration definition to all customscripted
pages, as customscript deroutes the execution inside setup.php.

No more work in the theme from now on.
 
How to make it work in Moodle Network:
######################################

In a Moodle Network, the technicalsignal add-on can display a local message, or
display a broadcasted network advice for all nodes in the MNET network.

the message is configured on the VMoodle main host and fetched by all the remote
nodes before page is built. Note that this will increase the page load with a 
systematic XML-RPC call, and thus might add some load to the server.

this feature uses a MNET service provided by VMoodle implementation for exchanging
configuration information between Moodles.

you need : 

VMoodle block installed (for Data Exchange Mnet service)

$CFG->mainhostprefix being setup to a recognizable prefix of a mnet_host of your 
network with Data_Exchange services published.

You need (of course ;-) ) to subscribe to Data_Exchange service for this main peer. 
