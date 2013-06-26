Club Registion Manager for Joomla 3.0
==============

Clubreg Component for joomla 3.0

All descriptions constants are stored in 
en-GB.com_clubreg.sys.ini


For list items, ignore_request must be false,
the application must get the state from post or get variables
JModelLegacy::getInstance('eois', 'ClubregModel', array('ignore_request' => false));

To use ajax, you must execute app->close() before the display is called

