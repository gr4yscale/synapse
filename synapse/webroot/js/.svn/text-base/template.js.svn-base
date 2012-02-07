Ext.namespace('Ext.ux');

contactDetails = Ext.extend(Ext.Window, {

//classProperty

//----------------------------------------------------------------------
    initComponent: function() { 

        /** Objects and items to add
         *  var myEditorGrid = new Ext.ux.EditorGrid({config_properties});
			//this.propertyname
        /**


		//Default configs
       *Ext.ux.ExtendedClassName.prototype.propertyName **/
        var cfg = {
			title: 'Contact Details',
			id: 'contactDetailsWindow',  
			layout:'fit',
	        width:650,
	        height:525,
			modal: true,	        
	        resizable: false,
	        border: false,
			hidden: true
        };

        Ext.applyIf(this, cfg);
        Ext.applyIf(this.initialConfig, cfg);

        // call parent 
        contactDetails.Class.superclass.initComponent.apply(this, arguments);
        // this.setTitle(), etc...logic.

        Ext.apply(this, {
            //stuff to apply (events, etc.)
        });

        //add custom events (you must 'fire' them later, this just adds/documents them)
        //this.addEvents('assigned', 'dismissed');

/*        this.on({
            //listener configs
            render: this.initializeSomething,
            afterlayout: this.setSomething,
            scope: this
        });
*/

    }, // eo function initComponent 

    onRender: function (container, position) {
		//call parent
        contactDetails.Class.superclass.onRender.apply(this, arguments);
    },

    initEvents: function(){
		//call parent
        contactDetails.Class.superclass.initEvents.apply(this, arguments);
    }
    anNewMethod: function() { 
    }

    
}); // end of extend

Ext.ComponentMgr.registerType('contact-details-win', contactDetails);

// end of file 



