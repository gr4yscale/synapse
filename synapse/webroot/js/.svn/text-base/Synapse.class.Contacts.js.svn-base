Synapse.Contacts = function(){
	

	return {
        init : function() {
	
			Ext.namespace('Ext.ux');

			Ext.ux.contactDetails = Ext.extend(Ext.Window, {

			//----------------------------------------------------------------------
			    initComponent: function() { 

			        /** Objects and items to add
			         *  var myEditorGrid = new Ext.ux.EditorGrid({config_properties});
						//this.propertyname
			        */
					var contact_id = 0;
					
					//Default configs
			       //Ext.ux.ExtendedClassName.prototype.propertyName 

			        var cfg = {
						title: 'Contact Details',
						id: 'contactDetailsWindow',  
						layout:'fit',
				        width:650,
				        height:450,
						modal: true,
						closable: true,
						closeAction:'hide',	        
				        resizable: false,
				        border: false,
						hidden: true
			        };

			        Ext.apply(this, cfg);
			        Ext.apply(this.initialConfig, cfg);

					var contactSummaryRead = new Ext.Panel({
						id: 'contactSummaryRead',
						xtype: 'panel',
						layout: 'absolute',
						width: 650,
						height: 450,
						border: false,
						items: [{
							id: 'lbl_fullname',
							xtype: 'label',
							html: "<span style='font-size: 22px'></span>",
							x: 24, y: 16
						},{
							id: 'lbl_vendor_name',
							xtype: 'label',
							html: "<span style='font-size: 15px'>Northern Tool and Equipment</span>",
							cls: 'contactDetailsLabel',
							x: 24, y: 44
						},{
						    xtype: 'box',
						    id: 'contact_pic_read',
						    width: 120, height: 120,
							x: 509, y: 20,
						    autoEl: {
								tag: 'img',
								src: 'http://' + host + '/img/contact_no_picture.png'
						    },
							style: 'border: 1px solid #858585;'
						},{
							id: 'lbl_workph',
							xtype: 'label',
							html: "work phone",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 80, width: 126
						},{
							id: 'lbl_workext',
							xtype: 'label',
							html: "work extension",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 108, width: 126
						},{
							id: 'lbl_cellph',
							xtype: 'label',
							html: "cell phone",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 136, width: 126
						},{
							id: 'lbl_fax',
							xtype: 'label',
							html: "fax",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 164, width: 126
						},{
							id: 'lbl_homeph',
							xtype: 'label',
							html: "home phone",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 192, width: 126
						},{
							id: 'lbl_primaryemail',
							xtype: 'label',
							html: "primary email",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 220, width: 126
						},{
							id: 'lbl_secondaryemail',
							xtype: 'label',
							html: "secondary email",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 248, width: 126
						},{
							id: 'lbl_birthday',
							xtype: 'label',
							html: "birthday",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 276, width: 126
						},{
							id: 'lbl_notes',
							xtype: 'label',
							html: "notes",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 304, width: 126
						},{
							id: 'lbl_workph_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 80, width: 126
						},{
							id: 'lbl_workext_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 108, width: 126
						},{
							id: 'lbl_cellph_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 136, width: 126
						},{
							id: 'lbl_fax_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 164, width: 126
						},{
							id: 'lbl_homeph_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 192, width: 126
						},{
							id: 'lbl_primaryemail_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 220, width: 126
						},{
							id: 'lbl_secondaryemail_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 248, width: 126
						},{
							id: 'lbl_birthday_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 276, width: 126
						},{
							id: 'lbl_notes_value',
							xtype: 'label',
							html: "",
							cls: 'contactDetailsLabelVal',
							x: 148, y: 304, width: 470
						},{
							id: 'btnEditContactDetails',
							xtype: 'button',
							text: 'Edit Details',
							style: 'left: 545px; top:380px;',	
						},{
							id: 'btnDeletContact',
							xtype: 'button',
							text: 'Delete Contact',
							style: 'left: 432px; top:380px;',	
						}]
					});
					
					var contactSummaryEdit = new Ext.Panel({
						id: 'contactSummaryEdit',
						layout: 'absolute',
						width: 650,
						height: 450,
						border: false,
						items: [{
							id: 'lbl_firstname_value_edit',
							name: 'data[Contacts][first_name]',
							xtype: 'textfield',
							style: 'font-size: 20px; padding: 0px; padding-left: 2px;',
							x: 24, y: 12, grow: true, height: 30,
							listeners:{
								autosize: function(){
									var fnameSizeObj = Ext.getCmp('lbl_firstname_value_edit').getSize();	
									Ext.getCmp('lbl_lastname_value_edit').setPosition(fnameSizeObj.width + 34);
								}
							}
						},{
							id: 'lbl_lastname_value_edit',
							name: 'data[Contacts][last_name]',
							xtype: 'textfield',
							style: 'font-size: 20px; padding: 0px; padding-left: 2px;',
							x: 150, y: 12, grow: true, height: 30
						},{
							id: 'lbl_vendor_name',
							xtype: 'label',
							html: "<span style='font-size: 15px'>Northern Tool and Equipment</span>",
							cls: 'contactDetailsLabel',
							x: 24, y: 44
						},{
						    xtype: 'box',
						    id: 'contact_pic_edit',
						    width: 120, height: 120,
							x: 509, y: 20,
						    autoEl: {
								tag: 'img',
								src: 'http://' + host + '/img/contact_no_picture.png'
						    },
							style: 'border: 1px solid #858585;'
						},{
							id: 'lbl_workph',
							xtype: 'label',
							html: "work phone",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 80, width: 126
						},{
							id: 'lbl_workext',
							xtype: 'label',
							html: "work extension",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 108, width: 126
						},{
							id: 'lbl_cellph',
							xtype: 'label',
							html: "cell phone",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 136, width: 126
						},{
							id: 'lbl_fax',
							xtype: 'label',
							html: "fax",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 164, width: 126
						},{
							id: 'lbl_homeph',
							xtype: 'label',
							html: "home phone",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 192, width: 126
						},{
							id: 'lbl_primaryemail',
							xtype: 'label',
							html: "primary email",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 220, width: 126
						},{
							id: 'lbl_secondaryemail',
							xtype: 'label',
							html: "secondary email",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 248, width: 126
						},{
							id: 'lbl_birthday',
							xtype: 'label',
							html: "birthday",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 276, width: 126
						},{
							id: 'lbl_notes',
							xtype: 'label',
							html: "notes",
							cls: 'contactDetailsLabel',
							style: 'text-align: right;',
							x: 14, y: 304, width: 126
						},{
							id: 'lbl_workph_value_edit',
							name: 'data[Contacts][workph]',
							xtype: 'textfield',
							x: 148, y: 80, width: 126, grow: true
						},{
							id: 'lbl_workext_value_edit',
							name: 'data[Contacts][workext]',
							xtype: 'textfield',
							x: 148, y: 108, width: 65, grow: true
						},{
							id: 'lbl_cellph_value_edit',
							name: 'data[Contacts][cellph]',
							xtype: 'textfield',
							x: 148, y: 136, width: 126, grow: true
						},{
							id: 'lbl_fax_value_edit',
							name: 'data[Contacts][fax]',
							xtype: 'textfield',
							x: 148, y: 164, width: 126, grow: true
						},{
							id: 'lbl_homeph_value_edit',
							name: 'data[Contacts][homeph]',
							xtype: 'textfield',
							x: 148, y: 192, width: 126, grow: true
						},{
							id: 'lbl_primaryemail_value_edit',
							name: 'data[Contacts][email_primary]',
							xtype: 'textfield',
							x: 148, y: 220, width: 250, grow: true, growMin: 200
						},{
							id: 'lbl_secondaryemail_value_edit',
							name: 'data[Contacts][email_secondary]',
							xtype: 'textfield',
							x: 148, y: 248, width: 250, grow: true, growMin: 200
						},{
							id: 'lbl_birthday_value_edit',
							name: 'data[Contacts][contact_birthday]',
							xtype: 'datefieldplus',
							width: 100,
							x: 148, y: 276,
							showWeekNumber: false
						},{
							id: 'lbl_notes_value_edit',
							name: 'data[Contacts][notes]',
							xtype: 'textfield',
							html: "",
							x: 148, y: 304, width: 470
						},{
							id: 'btnDoneContactDetails',
							xtype: 'button',
							text: 'Done',
							style: 'left: 577px; top:380px;',	
						}]
					});					
					
					var contactDetailsCardPanel = new Ext.Panel({
						id: 'contactDetailsCard',
						xtype: 'panel',
						layout: 'card',
						activeItem: 0,
						width: 650,
						height: 450,
						border: false,
						items: [contactSummaryRead, contactSummaryEdit]
					});
					
					var contactDetailsForm = new Ext.FormPanel({
						id: 'contactDetailsForm',
						xtype: 'form',
						width: 650,
						height: 450,
						border: false
					});
					contactDetailsForm.add(contactDetailsCardPanel);
					
			        // call parent 
			        Ext.ux.contactDetails.superclass.initComponent.apply(this, arguments);
					//this.constructor.prototype.initComponent.apply(this, arguments)
			        // this.setTitle(), etc...logic.

					this.add(contactDetailsForm);

			        //add custom events (you must 'fire' them later, this just adds/documents them)
			        //this.addEvents('assigned', 'dismissed');

					/* this.on({
			            //listener configs
			            render: this.initializeSomething,
			            afterlayout: this.setSomething,
			            scope: this
			        });*/
			
					Ext.getCmp('btnDoneContactDetails').purgeListeners();
					Ext.getCmp('btnDoneContactDetails').on('click', function(){							
						Ext.Ajax.request({
							url: 'http://' + host + '/contacts/update/' + this.contact_id,
							method: 'POST',
							params: {
								'data[Contacts][id]': this.contact_id,
								'data[Contacts][first_name]': Ext.getCmp('lbl_firstname_value_edit').getValue(),
								'data[Contacts][last_name]': Ext.getCmp('lbl_lastname_value_edit').getValue(),
								'data[Contacts][cellph]': Ext.getCmp('lbl_cellph_value_edit').getValue(),
								'data[Contacts][workph]': Ext.getCmp('lbl_workph_value_edit').getValue(),
								'data[Contacts][workext]': Ext.getCmp('lbl_workext_value_edit').getValue(),
								'data[Contacts][fax]': Ext.getCmp('lbl_fax_value_edit').getValue(),
								'data[Contacts][homeph]': Ext.getCmp('lbl_homeph_value_edit').getValue(),
								'data[Contacts][email_primary]': Ext.getCmp('lbl_primaryemail_value_edit').getValue(),
								'data[Contacts][email_secondary]': Ext.getCmp('lbl_secondaryemail_value_edit').getValue(),
								'data[Contacts][contact_birthday]': Ext.getCmp('lbl_birthday_value_edit').getValue().format('Y-m-d'),
								'data[Contacts][notes]': Ext.getCmp('lbl_notes_value_edit').getValue()	
							},
							success:function() {
								this.showContact(this.contact_id);
							},
							failure: function() {},
							scope: this
						});
					}, this);

			    }, // eo function initComponent 

			    onRender: function (container, position) {
					//call parent
			        Ext.ux.contactDetails.superclass.onRender.apply(this, arguments);
			    },

			    initEvents: function(){
					//call parent
			        Ext.ux.contactDetails.superclass.initEvents.apply(this, arguments);
			    },
					
			    showContact : function(contact_id) {
					this.show();
					this.cascade(function(){this.reset;});
					
					this.contact_id = contact_id;
											
					Ext.Ajax.request({
						url: 'http://' + host + '/contacts/getContact/' + contact_id,
						method: 'POST',
						success: function(response,options) {
							var data = Ext.decode(response.responseText);

							Ext.getCmp('btnEditContactDetails').purgeListeners();
							Ext.getCmp('btnEditContactDetails').on('click', function(){
								this.editContact(contact_id);
							}, this);
							
							Ext.getCmp('contactDetailsCard').layout.setActiveItem(0);
							Ext.getCmp('lbl_fullname').setText("<span style='font-size: 22px'>" + data.contacts[0].first_name + " " + data.contacts[0].last_name + "</span>", false);
						//	Ext.getCmp('lbl_vendor_name').setText("<span style='font-size: 15px'>" + data.contacts[0].vendor_name + "</span>", false);
							Ext.getCmp('lbl_workph_value').setText(data.contacts[0].workph);
							if(data.contacts[0].workext)
								Ext.getCmp('lbl_workext_value').setText(data.contacts[0].workext);
								else
									Ext.getCmp('lbl_workext_value').setText("");	
							Ext.getCmp('lbl_cellph_value').setText(data.contacts[0].cellph);
							Ext.getCmp('lbl_fax_value').setText(data.contacts[0].fax);
							Ext.getCmp('lbl_homeph_value').setText(data.contacts[0].homeph);
							Ext.getCmp('lbl_primaryemail_value').setText("<a href='#'>" + data.contacts[0].email_primary + "</a>", false);
							if(data.contacts[0].email_secondary)
								Ext.getCmp('lbl_secondaryemail_value').setText("<a href='#'>" + data.contacts[0].email_secondary + "</a>", false);
							else
								Ext.getCmp('lbl_secondaryemail_value').setText("");						
							Ext.getCmp('lbl_notes_value').setText(data.contacts[0].notes);
							
							if(data.contacts[0].contact_birthday){
								var bday = new Date();
								bday = Date.parseDate(data.contacts[0].contact_birthday, "Y-m-d");
								Ext.getCmp('lbl_birthday_value').setText(bday.format('m/d/Y'));
							}
							else{
								Ext.getCmp('lbl_birthday_value').setText("");
							}
							if(data.contacts[0].contact_thumblocation){
								Ext.getCmp('contact_pic_read').getEl().dom.src = wwwroot + data.contacts[0].contact_thumblocation;
							}
							else{
								Ext.getCmp('contact_pic_read').getEl().dom.src = 'http://' + host + '/img/contact_no_picture.png';
							}
						},
						failure: function() {},
						scope: this
					});	
				},
					
				addContact : function(vendor_id) {
					Ext.Ajax.request({
						url: 'http://' + host + '/contacts/update/',
						method: 'POST',
						params: {
							'data[Contacts][id]': "",
							'data[Contacts][first_name]': "FirstName",
							'data[Contacts][last_name]': "LastName",
							'data[Contacts][cellph]': "",
							'data[Contacts][workph]': "",
							'data[Contacts][workext]': "",
							'data[Contacts][fax]': "",
							'data[Contacts][homeph]': "",
							'data[Contacts][email_primary]': "",
							'data[Contacts][email_secondary]': "",
							'data[Contacts][contact_birthday]': "",
							'data[Contacts][notes]': "",
							'data[Contacts][vendor_id]': vendor_id
						},
						success:function(response,options) {
							this.show();
							this.cascade(function(){this.reset;});
							var data = Ext.decode(response.responseText);
							this.contact_id = data.contact_id; 
							this.editContact(this.contact_id);
						},
						failure: function() {},
						scope: this
					});
				},
				
				editContact : function(contact_id) {
					this.cascade(function(){this.reset;});
					
					if(contact_id) {
						Ext.Ajax.request({
							url: 'http://' + host + '/contacts/getContact/' + contact_id,
							method: 'POST',
							success: function(response,options) {
								var data = Ext.decode(response.responseText);
							
								Ext.getCmp('contactDetailsCard').layout.setActiveItem(1);
								this.syncSize();	
							
								Ext.getCmp('lbl_firstname_value_edit').setValue(data.contacts[0].first_name, false);
								Ext.getCmp('lbl_lastname_value_edit').setValue(data.contacts[0].last_name, false);
						
								var fnameSizeObj = Ext.getCmp('lbl_firstname_value_edit').getSize();	
								Ext.getCmp('lbl_lastname_value_edit').setPosition(fnameSizeObj.width + 26);

								Ext.getCmp('lbl_workph_value_edit').setValue(data.contacts[0].workph);
								Ext.getCmp('lbl_workext_value_edit').setValue(data.contacts[0].workext);
								Ext.getCmp('lbl_cellph_value_edit').setValue(data.contacts[0].cellph);
								Ext.getCmp('lbl_fax_value_edit').setValue(data.contacts[0].fax);
								Ext.getCmp('lbl_homeph_value_edit').setValue(data.contacts[0].homeph);
								Ext.getCmp('lbl_primaryemail_value_edit').setValue(data.contacts[0].email_primary);
								Ext.getCmp('lbl_secondaryemail_value_edit').setValue(data.contacts[0].email_secondary);
								Ext.getCmp('lbl_notes_value_edit').setValue(data.contacts[0].notes);
								if(data.contacts[0].contact_birthday){
									var bday = new Date();
									bday = Date.parseDate(data.contacts[0].contact_birthday, "Y-m-d");
									Ext.getCmp('lbl_birthday_value_edit').setValue(bday, 'm/d/Y');
								}
								else{
									Ext.getCmp('lbl_birthday_value_edit').setValue("");
								}	
							},
							failure: function() {},
							scope: this
						});
					}
				}
			}); // end of extend

			Ext.ComponentMgr.registerType('contact-details-win', Ext.ux.contactDetails);
		}
	}

}();