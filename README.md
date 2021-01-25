## Club Registion Manager for Joomla 3.0
The Club Registration Component is an extension for Joomla 3. It can be used to manage social or sporting clubs or groups which are made up of members such as (players,swimmers or association members) and Officials (team leaders, coaches or association officials). Members can be assigned to groups and sub groups. 
Officials can add notes to members, add emergency contact details, add simple payment details, upload files , keep a log of all items (assets given to players)


### Websites
* [Website for Clubreg](http://app.deltastateonline.com/).
* [Demo](http://demo3.deltastateonline.com/).
* [Forum](http://app.deltastateonline.com/forum/).

#### Reminders
```bash
Clubreg Component for joomla 3.0

All descriptions constants for the joomla configuaration are stored in en-GB.com_clubreg.sys.ini

* For list items, ignore_request must be false,
* The application must get the state from post or get variables
* JModelLegacy::getInstance('eois', 'ClubregModel', array('ignore_request' => false));

* To use ajax, you must execute app->close() before the display is called
```

##Working with Tags
```
Options for tags can be loaded from : libraries/cms/html/tag.php
The field is constructed and rendered by this : libraries/src/Form/field/Tagfield.php
```

###
Form data can be accessed from
```
libraries/src/Form/Form.php
$this->emergencyForm = $currentModel->getForm();			
$dataRegistry = $this->emergencyForm->getData();
libraries/vendor/joomla/registry/src/Registry.php
```

### Create views
* if output is csv or raw output , create or add logic to view.raw.php
* create a method as follows {layout}_{view}
* create a new file in the tpl folder with filename {layout}.php