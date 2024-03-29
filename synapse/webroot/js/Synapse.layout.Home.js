Synapse.Home = function(){	
	vendor_id = 0;
	contact_id = 0;
	
    return {
        init : function() {

			function setVendor(v_id){
				vendor_id = v_id;
			}

			function getVendor(){
				return vendor_id;
			}

			var calendar = new Ext.FormPanel({
		        region: 'north',
				border: false,
				height: 322,
				items: [{
					xtype: 'datepickerplus',
					fillupRows: false,
					allowMouseWheel:true,
					showWeekNumber: false,
					showActiveDate:true,
					renderTodayButton:false,
					summarizeHeader:true
				}]		
		    });

		    var contactListDS = new Ext.data.Store({	
		        proxy: new Ext.data.HttpProxy({url: 'http://' + host + '/contacts/getContactsForVendor'}),
		        reader: new Ext.data.JsonReader({
			        root: 'contacts',
					fields: [{name: 'id'},{name: 'first_name'}]
				})
		    });


			var contactActions = new Ext.ux.grid.RowActions({
				 header:'Actions'
	//			,autoWidth:false
				,actions:[{
					 iconCls:'icon-details',
					tooltip:'Details'
				},{
					iconCls:'icon-mail',
					tooltip:'Mail'
				}]
				,callbacks:{
					'icon-details':function(grid, record, action, rowindex, col) {
						contactDetailsWin.showContact(grid.getStore().getAt(rowindex).data.id);
					},
					scope: this
				}
			});


			var contactGrid = new Ext.grid.GridPanel({
			    xtype: 'grid',
				id: 'contactListGrid',
				cm: new Ext.grid.ColumnModel([
					{header: "fname", dataIndex: 'first_name', width: 260},
					contactActions
			    ]),
				ds: contactListDS,
				stripeRows: true,
				hideHeaders: true,
				cls: 'homeQuickList',
				autoHeight: true,
				width: 320,
				layout:'fit',
				anchor: '100%',
				border: false,
				plugins: contactActions,
				listeners: {
					rowdblclick: function(grid, rowindex, e) {
						contactDetailsWin.showContact(grid.getStore().getAt(rowindex).data.id);
					}
				}
			});


		    var vendorListDS = new Ext.data.Store({	
		        proxy: new Ext.data.HttpProxy({url: 'http://' + host + '/vendors/getVendors'}),
		        reader: new Ext.data.JsonReader({
			        root: 'vendors',
					fields: [{name: 'id'},{name: 'vendor_name'},{name: 'vendor_icon'}]
				})
		    });
		
			vendorListDS.load();
			
			function dateSearch(){
				var startdate = Ext.util.Format.date(Ext.getCmp('startdate').getValue(), 'Y-m-d');
				var enddate = Ext.util.Format.date(Ext.getCmp('enddate').getValue(), 'Y-m-d');
				Ext.getCmp('quoteGrid').getStore().load({
					params:{
						'vendor_id':getVendor(),
						'date_start':startdate,
						'date_end':enddate,
					}
				});
			}

			var quoteFinder = new Ext.Panel({
				    xtype: 'form',
					id: 'quoteFinderContainer',
					title: '&raquo; Find Quotes By:',
					cls: 'quotefinder',
					height: '100%',
					width: '100%',
					border: false,
					items: [{
						id: 'quoteFinderForm',
						xtype: 'panel',
						layout: 'anchor',
						border: false,
						width: '100%',
						height: '100%',
						border: false,	
			        	items: [{
							xtype: 'panel',
							layout: 'absolute',
							x: 0, y: 0,
							width: '100%', height: 60,
							cls: 'darkpanel',
							border: false,
							items: [{
								xtype: 'label',
								text: "Products:",
								style: 'font-size: 16px;',
								x: 12, y: 8
							},{
								xtype:'textfield',
								x: 100, y:8,
							//	id: 'searchterms',
								enableKeyEvents: true,
								hideLabel: true,
								value: "Type product name here.",
								width: 256, height: 22,
								style: "font-size: 12px; padding-top: 2px;padding-left: 6px; padding-right: 6px; color: #555555",
								listeners: {
									keyup: function(thisfield, e) { 
										if(this.getValue ().length > 2) {
										//	prodDS.proxy.conn.url = 'http://' + host + '/products/getProductSearch/';
											Ext.getCmp('quoteGrid').getStore().load({
												params:{
													'product_name_search':this.getValue(),
													'vendor_id':getVendor(),
												}
											});		
										}
										else
											Ext.getCmp('quoteGrid').getStore().removeAll();
									},
									focus: function(thisfield) { 
										if(this.getValue () == "Type product name here.")
											this.setValue("");
									}
								}
							},{
								xtype: 'checkboxgroup',
								x: 100, y: 32, width: 310,
				               	hideLabel: true,
				                vertical: false,
								defaults:{height: 20},
				                items: [
									{boxLabel: 'Item No', name: 'cb-search-itemno', checked: true},
				                    {boxLabel: 'Vendor Item No', name: 'cb-search-vendoritemno', checked: true},
									{boxLabel: 'Name', name: 'cb-search-name', checked: true}		
				                ]
							}]
						},{
							xtype: 'panel',
							layout: 'absolute',
							x: 0, y: 60,
							width: '100%', height: 40,
							border: false,
						 	style: 'border-bottom:1px dotted #B5B8C8; border-top:1px dotted #B5B8C8; margin-left: 4px; margin-right:4px;border-left: 0px none; border-right: 0px none; background-color: #E8E8E8; margin:0px none; padding-top: 4px;padding-left: 0px none;padding-bottom: 8px',
							items: [{
								xtype: 'label',
								text: "Contacts:",
								style: 'font-size: 16px;',
								x: 8, y: 4
							},{
								xtype: 'combo',
								x: 96, y: 4,
								width: 240,	height: 22,
								store: contactListDS,
								displayField:'first_name',
								emptyText: 'Choose Contact ...',
								mode: 'local',
								lazyInit: true,
								//forceSelection: true,
								editable: false,
								typeAhead: false,
								style: 'background: #fff;',
								//disabled: true,
								listeners: {
									select: function(cmb, rec, ind) {
										Ext.getCmp('quoteGrid').getStore().load({
											params:{
												'contact_id':rec.data.id,
												'vendor_id':getVendor(),
											}
										});
										cmb.clearValue();
									}
								}
							}]
						},{
							xtype: 'panel',
							layout: 'absolute',
							x: 0, y: 100,
							width: '100%', height: 40,
							cls: 'darkpanel',
							border: false,
							items: [{
								xtype: 'label',
								text: "Date:",
								style: 'font-size: 16px;',
								x: 12, y: 8
							},{
								xtype: 'datefieldplus',
								id: 'startdate',
								emptyText: "From",
								width: 108,
								x: 100, y: 8,
								showWeekNumber: false,
								listeners:{
									'select':dateSearch,
								}
							},{
								xtype: 'datefieldplus',
								id: 'enddate',
								emptyText: "To",
								width: 108,
								x: 232, y: 8,
								showWeekNumber: false,
								listeners:{
									'select':dateSearch,
								}
							}]
						},{
						    xtype: 'grid',
							id: 'quoteGrid',
							x: 0, y: 140,
							style: 'border-top:1px solid #939599;border-bottom:1px solid #939599;',
							cm: new Ext.grid.ColumnModel([
								{header: "Quote Name", dataIndex: 'quote_name', width: 300},
								{header: "Date", dataIndex: 'quote_sent_date', width: 125},
								{header: "Attachments", dataIndex: 'attach_location', width: 80,
									renderer: function(value) {
										if(value)
											return '<a href="' + wwwroot + value + '" target="_blank">Download</a>';
									}},
								{header: "No. Prod(s)", dataIndex: 'no_prods', width: 75},
								{header: "Contact(s)", dataIndex: 'contact_name', width: 225}
						    ]),
							ds: new Ext.data.Store({	
						        proxy: new Ext.data.HttpProxy({url: 'http://' + host + '/quotes/getQuotesByVendor'}),
						        reader: new Ext.data.JsonReader({
							        root: 'quotes',
									fields: [{name: 'id'},{name: 'quote_sent_date'},{name: 'quote_name'},{name: 'contact_name'},{name: 'no_prods'},{name: 'attach_location'}]
								})
						    }),
							stripeRows: true,
							cls: 'quoteGrid',
							autoHeight: true,
							width: '100%',
							layout:'fit',
							border: false
						}]
					}]
				});			

			var vendorGrid = new Ext.grid.GridPanel({
			    xtype: 'grid',
				id: 'vendorListGrid',
				cm: new Ext.grid.ColumnModel([
					{header: "Vendor", dataIndex: 'vendor_name', width: 265},
					{header: "pix", dataIndex: 'vendor_icon', width: 54}
			    ]),
				ds: vendorListDS,
				stripeRows: true,
				hideHeaders: true,
				cls: 'homeQuickList',
				autoHeight: true,
				width: 320,
				layout:'fit',
				anchor: '100%',
				border: false,
				listeners: {
					rowclick: function(grid, rowindex, e) {
						contactListDS.load({
							params:{'vendor_id':grid.getStore().getAt(rowindex).data.id},
							callback: function(){
								quickListPanel.layout.setActiveItem(1);
								Ext.getCmp('vclback').show();
								Ext.getCmp('addcontact').show();
								contactGrid.getEl().slideIn('r', { duration: .35 });
								
								setVendor(grid.getStore().getAt(rowindex).data.id);
								Ext.getCmp('quoteGrid').getStore().load({params:{'vendor_id':getVendor()}});
							}
						});
						
						contentPanel.layout.setActiveItem(1);
						
			//			contentPanel.doLayout();		
			//			quoteFinder.doLayout();
			//			quoteFinder.syncSize();
						
						quoteFinder.getEl().slideIn('b', { duration: .25 });
				  	}
				}
			});
			
			var quickListPanel = new Ext.Panel({
				bodyStyle: 'background: #fff;border-bottom:0 none; border-top:0 none; padding:0px;',
				title: 'Vendors and Contacts Quick List',
				id:'qlpanel',
				layout: 'card',
				activeItem: 0,
				cls:'homeHeaders',
		        region: 'center',
				border:false,
				items: [vendorGrid, contactGrid]
			});
			
			var westPanel = new Ext.Panel({
				bodyStyle: 'border-bottom:0 none; border-top:0 none;',
			 	region:"west",
				layout:'border', 
			    width:320,
			    split:false,
			    collapsible:false,
				border: false,
				items: [calendar, quickListPanel,
				{
				    xtype: 'box',
				    id: 'vclback',
					hidden: true,
				    width: 32, height: 21,
					x: 13, y: 331,
				    autoEl: {
						tag: 'img',
						src: 'http://' + host + '/img/back.png'
				    },
					style: 'cursor:pointer;',
					listeners: {
						render: function(c) {
							c.getEl().on('click', function() {
								quickListPanel.layout.setActiveItem(0);
								Ext.getCmp('vclback').hide();
								Ext.getCmp('addcontact').hide();
								vendorGrid.getEl().slideIn('l', { duration: .25 });
								
								quoteFinder.getEl().slideOut('b', { 
									duration: .25, 
									easing: 'easeOut', 
									callback: function(){
										contentPanel.layout.setActiveItem(0);									
									}
								});
																
							})
						}
					}
				},{
				    xtype: 'box',
				    id: 'addcontact',
					hidden: true,
				    width: 32, height: 21,
					x: 276, y: 331,
				    autoEl: {
						tag: 'img',
						src: 'http://' + host + '/img/add.png'
				    },
					style: 'cursor:pointer;',
					listeners: {
						render: function(c) {
							c.getEl().on('click', function() {
								contactDetailsWin.addContact(getVendor());
								contactDetailsWin.on({
									hide:function(){
										contactListDS.load({
											params:{'vendor_id':getVendor()}
										});
									}
								});
	
							})
						}
					}
				}]
			});
			
			
			var contentPanel = new Ext.Panel({
				id: 'contentPanelContainer',
				activeItem: 0,
				border: false,
				layout: 'card',
				items: [{
					xtype: 'panel',
					border: false,
					bodyStyle: 'border-bottom:0 none; border-top:0 none; padding: 10px; padding-left: 18px; font-size: 14px; color: #383838;',
					html: "<span style='font-size:16px; font-weight: bold;'>Wednesday, November 5th</span><br>Order #1536 has shipped and its estimated landing date is November 6th.<br>You have 34 messages marked for follow up.<br>Flight to Sacramento, CA, USA has been confirmed for 10/23/08.<br>Nullam enim. Nam neque nulla, ullamcorper et.<br>Pellentesque id tortor.  Suspendisse varius pulvinar.",
					x: 20, y: 14
				}, quoteFinder]
			});

			//* Load Base Module
			Synapse.Base.init();

			Ext.getCmp('moduletext').hide();
			Ext.getCmp('headerPanel').setHeight(97);
		
			Synapse.Base.addComponent("mainview-west", westPanel, {width:320, split:true, collapsible:false, border: false});
			Synapse.Base.addComponent("mainview-center", contentPanel, {split:false, collapsible:false, border: false});
			Ext.getCmp('moduletext').getEl().update("<span style='background: transparent; color: #383838;font-size:14px; text-align: left; padding-right: 16px; padding-left: 16px;'>Home</span>");


			//* Load Contacts Module
//			Load ('http://' + host + '/js/contactDialog.js');			
			Synapse.Contacts.init();
			
			var contactDetailsWin = new Ext.ux.contactDetails({xtype: 'contact-details-win', id:'contactDialog'});
	}
}
	
}();

Ext.onReady(Synapse.Home.init, Synapse.Home);


